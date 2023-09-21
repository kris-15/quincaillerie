<?php 
    require_once 'Model.php';
    class Manager extends Model{
        public int $id;
        public string $lastName;
        public string $firstName;
        public string $email;
        public string $password;
        public int $adminId;

        public function __construct($lastName, $firstName, $email, $password, $adminId)
        {
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->email = $email;
            $this->password = $password;
            $this->adminId = $adminId;
        }

        /**
         * Stocker les informations d'un gestionnaire dans la base des données
         */
        public function store_manager(){
            return $this->prepare_sql(
                "INSERT INTO gestionnaires VALUE (null,?,?,?,?,?)",
                [$this->lastName, $this->firstName, $this->email, password_hash($this->password, PASSWORD_DEFAULT), $this->adminId ]
            );
        }
        /**
         * Récupère tous les gestionnaires d'un admin
         * @return Manager
         */
        public function all_manager(){
            return $this->prepare_sql("SELECT * FROM gestionnaires WHERE admin_id=?",[$this->adminId], fetch:true, fetchMode:PDO::FETCH_OBJ);
        }
        /**
         * Récupérer les infos d'un manager
         * @param int $id L'id du manager
         */
        public function find_manager_by_id($id){
            $data = $this->prepare_sql("SELECT * FROM gestionnaires WHERE admin_id=? AND id=?",
                [$this->adminId, $id], fetchOne:true, fetchMode:PDO::FETCH_OBJ
            );
            if($data)$this->id = $data->id;
            return $data;
        }

        /**
         * Permet de modifier les informations d'un gestionnaire
         */
        public function update_manager(){
            return $this->prepare_sql(
                "UPDATE gestionnaires SET nom=?, prenom=?, email=? WHERE id=? AND admin_id=?",
                [$this->lastName, $this->firstName, $this->email, $this->id, $this->adminId]
            );
        }

        /**
         * Permet de supprimer un gestionnaire
         */
        public function delete($id){
            return $this->find_manager_by_id($id) ? 
                $this->prepare_sql("DELETE FROM gestionnaires WHERE id=? AND admin_id=?",[$this->id, $this->adminId])
                :false
            ;
        }
    }