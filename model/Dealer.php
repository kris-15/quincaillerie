<?php 
    require_once 'Model.php';
    require_once 'Product.php';
    class Dealer extends Model{
        public int $id;
        public string $matricule;
        public string $firstName;
        public string $phone;
        public string $password;
        public int $adminId;

        public function __construct($matricule, $firstName, $phone, $password, $adminId)
        {
            $this->firstName = $firstName;
            $this->matricule = $matricule;
            $this->phone = $phone;
            $this->password = $password;
            $this->adminId = $adminId;
        }

        /**
         * Stocker les informations d'un vendeur dans la base des données
         */
        public function store_dealer(){
            return $this->prepare_sql(
                "INSERT INTO vendeurs VALUE (null,?,?,?,?,?)",
                [$this->firstName, $this->phone, $this->matricule, password_hash($this->password, PASSWORD_DEFAULT), $this->adminId ]
            );
        }
        /**
         * Récupère tous les vendeurs d'un admin
         * @return Dealer
         */
        public function all_dealer(){
            return $this->prepare_sql("SELECT * FROM vendeurs WHERE id_admin=?",[$this->adminId], fetch:true, fetchMode:PDO::FETCH_OBJ);
        }
        /**
         * Récupérer les infos d'un dealer
         * @param int $id L'id du dealer
         */
        public function find_dealer_by_id($id){
            $data = $this->prepare_sql("SELECT * FROM vendeurs WHERE id_admin=? AND id=?",
                [$this->adminId, $id], fetchOne:true, fetchMode:PDO::FETCH_OBJ
            );
            if($data)$this->id = $data->id;
            return $data;
        }

        /**
         * Permet de modifier les informations d'un vendeur
         */
        public function update_dealer(){
            return $this->prepare_sql(
                "UPDATE vendeurs SET prenom=?, telephone=? WHERE id=? AND id_admin=?",
                [$this->firstName, $this->phone, $this->id, $this->adminId]
            );
        }

        /**
         * Permet de supprimer un vendeur
         */
        public function delete($id){
            return $this->find_dealer_by_id($id) ? 
                $this->prepare_sql("DELETE FROM vendeurs WHERE id=? AND id_admin=?",[$this->id, $this->adminId])
                :false
            ;
        }
        public function find_dealer_by_matricule(){
            $data = $this->prepare_sql("SELECT * FROM vendeurs WHERE matricule=?",
                [$this->matricule], fetchOne:true, fetchMode:PDO::FETCH_OBJ
            ); 
            if($data){$this->id = $data->id;$this->firstName=$data->prenom;$this->adminId=$data->id_admin;}
            return $data;
        }

        public function login(){
            $dealer = $this->find_dealer_by_matricule($this->matricule);
            if(!$dealer){
                return false;
            }
            if(password_verify($this->password, $dealer->mot_de_passe)){
                return true;
            }
            return false;
        }
        public function get_products(){
            $product = new Product("","","","","",$this->id);
            return $product->all_products_for_entreprise($this->adminId);
        }
        public function get_product($idProduct){
            $product = new Product("","","","","",$this->id);
            return $product->get_product($idProduct);
        }
    }