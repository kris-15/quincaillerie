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
    }