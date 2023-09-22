<?php
    require_once 'Model.php';
    require 'Manager.php';
    require 'Dealer.php';
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
        public function find_admin_by_username(){
            $data = $this->prepare_sql(
                "SELECT * FROM admins WHERE username=?",
                [$this->username], fetchOne:true, fetchMode:PDO::FETCH_OBJ
            );
            if($data){
                $this->name=$data->nom;
                $this->email=$data->email;
                $this->id=$data->id;
            }
            return $data;
        }
        /*************************************      PARTIE GESTIONNNAIRE      ************************************/

        /**
         * Cette méthode permet d'enregistrer un nouveau gestionnaire par un admin
         * @param string $lastName Le nom du gestionnaire
         * @param string $firstName Le prenom du gestionnaire
         * @param string $email L'adresse email du gestionnaire
         * @param string $password Le mot de passe du gestionnaire
         * @return bool true||false
         */
        public function create_manager($lastName, $firstName, $email, $password){
            if(!$this->find_admin_by_username()){
                return false;
            }
            $manager = new Manager($lastName, $firstName, $email, $password, $this->id);
            $created = $manager->store_manager();
            return $created;
        }

        public function get_managers(){
            $manager = new Manager("","","","",$this->id);
            return $manager->all_manager();
        }
        /**
         * Permet à l'administrateur de récupérer les infos d'un manager
         * @param int $id L'identifiant du manager
         * @return array
         */
        public function get_manager($idManager){
            $manager = new Manager("","","","",$this->id);
            return $manager->find_manager_by_id($idManager);
        }

        /**
         * Permet de modifier les informations d'un manager
         * @param int $idManager L'id du manager
         * @param string $lastName Le nom du manager
         * @param string $firstName Le prenom du manager
         * @param string $email L'email du manager
         */
        public function update_manager($idManager,$lastName,$firstName,$email){
            $manager = new Manager($lastName,$firstName,$email,"",$this->id);
            $manager->find_manager_by_id($idManager);
            return $manager->update_manager();
        }

        /**
         * Permet à l'admin de supprimer un gestionnaire
         * @param int $idManager L'id du manager à supprimer
         */
        public function delete_manager($idManager){
            $manager = new Manager("","","","", $this->id);
            return $manager->delete($idManager); 
        }
        /***********************************      FIN PARTIE GESTIONNNAIRE      *********************************/

        /***************************************      PARTIE VENDEUR      ***************************************/

        /**
         * Cette méthode permet d'enregistrer un nouveau vendeur par un admin
         * @param string $matricule Le matricule du vendeur
         * @param string $firstName Le prenom du vendeur
         * @param string $phone Le numéro de téléphone du vendeur
         * @param string $password Le mot de passe du vendeur
         * @return bool true||false
         */
        public function create_dealer($matricule, $firstName, $phone, $password){
            if(!$this->find_admin_by_username()){
                return false;
            }
            $dealer = new Dealer($matricule, $firstName, $phone, $password, $this->id);
            $created = $dealer->store_dealer();
            return $created;
        }

        public function get_dealers(){
            $dealer = new Dealer("","","","",$this->id);
            return $dealer->all_dealer();
        }
        /**
         * Permet à l'administrateur de récupérer les infos d'un dealer
         * @param int $id L'identifiant du dealer
         * @return array
         */
        public function get_dealer($idDealer){
            $dealer = new Dealer("","","","",$this->id);
            return $dealer->find_dealer_by_id($idDealer);
        }

        /**
         * Permet de modifier les informations d'un dealer
         * @param int $iddealer L'id du dealer
         * @param string $matricule Le nom du dealer
         * @param string $firstName Le prenom du dealer
         * @param string $phone L'phone du dealer
         */
        public function update_dealer($idDealer,$firstName,$phone){
            $dealer = new Dealer("",$firstName,$phone,"",$this->id);
            $dealer->find_dealer_by_id($idDealer);
            return $dealer->update_dealer();
        }

        /**
         * Permet à l'admin de supprimer un gestionnaire
         * @param int $idDealer L'id du dealer à supprimer
         */
        public function delete_dealer($idDealer){
            $dealer = new Dealer("","","","", $this->id);
            return $dealer->delete($idDealer); 
        }
    }