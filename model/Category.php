<?php 
    require_once 'Model.php';
    class Category extends Model{
        public int $id;
        public string $type;
        public string $description;
        public int $managerId;

        public function __construct($type, $description, $managerId)
        {
            $this->description = $description;
            $this->type = $type;
            $this->managerId = $managerId;
        }

        /**
         * Stocker les informations d'une catégorie dans la base des données
         */
        public function store_category(){
            return $this->prepare_sql(
                "INSERT INTO categories VALUE (null,?,?,?)",
                [$this->type, $this->description, $this->managerId ]
            );
        }
        /**
         * Récupère toutes les categories d'un gestionnaire
         * @return Category
         */
        public function all_categories(){
            return $this->prepare_sql("SELECT * FROM categories WHERE id_gestionnaire=?",[$this->managerId], fetch:true, fetchMode:PDO::FETCH_OBJ);
        }
        /**
         * Récupérer les infos d'une categorie
         * @param int $id L'id de la categorie
         */
        public function find_category_by_id($id){
            $data = $this->prepare_sql("SELECT * FROM categories WHERE id_gestionnaire=? AND id=?",
                [$this->managerId, $id], fetchOne:true, fetchMode:PDO::FETCH_OBJ
            );
            if($data)$this->id = $data->id;
            return $data;
        }

        /**
         * Permet de modifier les informations d'une catégorie
         */
        public function update_category(){
            return $this->prepare_sql(
                "UPDATE categories SET type=?, description=? WHERE id=? AND id_gestionnaire=?",
                [$this->type, $this->description, $this->id, $this->managerId]
            );
        }

        /**
         * Permet de supprimer une catégorie
         */
        public function delete($id){
            return $this->find_category_by_id($id) ? 
                $this->prepare_sql("DELETE FROM categories WHERE id=? AND id_gestionnaire=?",[$this->id, $this->managerId])
                :false
            ;
        }
    }