<?php 
    require_once 'Model.php';
    class Product extends Model{
        public int $id;
        public string $libelle;
        public string $price;
        public string $code;
        public string $quantity;
        public string $categoryId;
        public int $managerId;

        public function __construct($libelle, $price, $code, $quantity, $categoryId, $managerId)
        {
            $this->libelle = $libelle;
            $this->price = $price;
            $this->code = $code;
            $this->quantity = $quantity;
            $this->categoryId = $categoryId;
            $this->managerId = $managerId;
        }

        /**
         * Stocker les informations d'une catégorie dans la base des données
         */
        public function store_product(){
            $insert = $this->prepare_sql(
                "INSERT INTO produits VALUE (null,?,?,?,?,?)",
                [$this->libelle, $this->price, $this->code, $this->categoryId, $this->managerId ]
            );
            if($insert){
                $product = $this->prepare_sql(
                    "SELECT id FROM produits WHERE libelle=? AND prix_unitaire=? AND code=?",
                    [$this->libelle, $this->price, $this->code],fetchOne:true, fetchMode:PDO::FETCH_OBJ
                );
                if($product){
                    $this->prepare_sql("INSERT INTO stocks VALUE (null,?,?,NOW())", [$product->id, $this->quantity]);
                    return true;
                }
                return false;
            }
            return false;
        }
        /**
         * Récupère tous les produits d'un gestionnaire
         * @return Product
         */
        public function all_products(){
            return $this->prepare_sql(
                "SELECT *, produits.id as produit_id, categories.id as categorie_id, stocks.id as id_stock FROM produits INNER JOIN stocks ON 
                produits.id = stocks.id_produit INNER JOIN categories ON produits.id_categorie = categories.id
                WHERE produits.id_gestionnaire=?",
                [$this->managerId], fetch:true, fetchMode:PDO::FETCH_OBJ
            );
        }
        /**
         * Récupérer les infos d'une categorie
         * @param int $id L'id de la categorie
         */
        public function find_product_by_id($id){
            $data = $this->prepare_sql(
                "SELECT *, produits.id as produit_id, categories.id as categorie_id, stocks.id as id_stock FROM produits INNER JOIN stocks ON 
                produits.id = stocks.id_produit INNER JOIN categories ON produits.id_categorie = categories.id
                WHERE produits.id_gestionnaire=? AND produits.id=?",
                [$this->managerId, $id], fetchOne:true, fetchMode:PDO::FETCH_OBJ
            );
            if($data)$this->id = $data->produit_id;
            return $data;
        }

        /**
         * Permet de modifier les informations d'une catégorie
         */
        public function update_product(){
            $productUpdated = $this->prepare_sql(
                "UPDATE produits SET libelle=?, prix_unitaire=?, id_categorie=? WHERE id=? AND id_gestionnaire=?",
                [$this->libelle, $this->price, $this->categoryId, $this->id, $this->managerId]
            );
            if($productUpdated){
                $this->prepare_sql("UPDATE stocks SET quantite=? WHERE id_produit=?",
                [$this->quantity, $this->id]);
                return true;
            }
            return false;
        }

        /**
         * Permet de supprimer une catégorie
         */
        public function delete($id){
            return $this->find_product_by_id($id) ? 
                $this->prepare_sql("DELETE FROM produits WHERE id=? AND id_gestionnaire=?",[$this->id, $this->managerId])
                :false
            ;
        }
        public function all_products_for_entreprise($adminId){
            return $this->prepare_sql(
                "SELECT *, produits.id as produit_id, categories.id as categorie_id, stocks.id as id_stock 
                FROM produits INNER JOIN stocks ON produits.id = stocks.id_produit 
                INNER JOIN categories ON produits.id_categorie = categories.id
                INNER JOIN gestionnaires ON gestionnaires.id = produits.id_gestionnaire
                INNER JOIN admins ON  admins.id = gestionnaires.admin_id WHERE admins.id=? 
                ",
                [$adminId], fetch:true, fetchMode:PDO::FETCH_OBJ
            );
        }

        public function get_product($id){
            return $this->prepare_sql("SELECT * FROM produits WHERE id=?",[$id],fetchOne:true,fetchMode:PDO::FETCH_OBJ);
        }
    }