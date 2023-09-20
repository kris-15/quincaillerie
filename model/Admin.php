<?php
    require 'Model.php';
    class Admin extends Model{
        public string $name;
        public string $email;
        public string $username;
        public string $password;

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
    }