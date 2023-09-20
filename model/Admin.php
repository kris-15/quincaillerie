<?php
    require 'Model.php';
    class Admin extends Model{
        public string $name;
        public string $email;
        public string $username;
        public string $password;
        public int $id;

        /**
         * Permet de créer le constructeur de la classe
         * @param string $name Le nom de l'admin
         * @param string $email L'adresse e-mail
         * @param string $username Le username
         * @param string $password Le mot de passe
         */
        public function __construct($name, $email, $username, $password)
        {
            $this->name = $name;
            $this->email = $email;
            $this->username = $username;
            $this->password = $password;
        }

        /**
         * Permet de connecter un administrateur à partir de son username et password
         * Si les infos entrantes matchent les infos existantes elle renvoit true
         * Sinon false
         */
        public function login(){
            $admin = $this->find_admin_by_username();
            if(!$admin){
                return false;
            }
            if(password_verify($this->password, $admin->password)){
                $this->name = $admin->nom;
                $this->email = $admin->email;
                return true;
            }
            return false;
        }

        /**
         * Cette méthode permet de vérifier si un username a été déjà pris
         * @return int Le nombre de fois
         */
        private function check_username(){
            return $this->prepare_sql("SELECT count(id) FROM admins WHERE username=?", [$this->username],fetchColumn: true);
        }

        /**
         * Cette méthode permet d'enregistrer un nouveau compte administrateur.
         * Il commence par checker si le username a déjà été utilisé.
         * Si oui, il renvoit faux; Sinon il crée le nouveau compte.
         * @return bool La valeur true || false 
         */
        public function save_account(){
            if($this->check_username() > 0){
                return false;
            }
            return $this->prepare_sql("INSERT INTO admins VALUE (null,?,?,?,?)", 
                [$this->name, $this->username, $this->email, password_hash($this->password, PASSWORD_DEFAULT)]
            );
        }

        /**
         * Permet de récupérer tous les informations d'un admin à partir de son username
         */
        private function find_admin_by_username(){
            return $this->prepare_sql(
                "SELECT * FROM admins WHERE username=?",
                [$this->username], fetchOne:true, fetchMode:PDO::FETCH_OBJ
            );
        }
    }