<?php 
    require_once 'Model.php';
    require_once 'Category.php';
    require_once 'Product.php';
    class Manager extends Model{
        public int $id;
        public string $lastName;
        public string $firstName;
        public string $email;
        public string $password;
        public $adminId;

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
        public function login(){
            $manager = $this->find_manager_by_email($this->email);
            if(!$manager){
                return false;
            }
            if(password_verify($this->password, $manager->mot_de_passe)){
                return true;
            }
            return false;
        }
        public function find_manager_by_email($email){
            $data = $this->prepare_sql("SELECT * FROM gestionnaires WHERE email=?",
                [$this->email], fetchOne:true, fetchMode:PDO::FETCH_OBJ
            ); 
            if($data){$this->id = $data->id;$this->lastName=$data->nom;$this->firstName=$data->prenom;}
            return $data;
        }

        /*************************************      PARTIE CATEGORIE      ***************************************/

        /**
         * Cette méthode permet d'enregistrer un nouveau vendeur par un admin
         * @param string $type Le type du vendeur
         * @param string $description Le prenom du vendeur
         * @return bool true||false
         */
        public function create_category($type, $description){
            if(!$this->find_manager_by_email($this->email)){
                return false;
            }
            $category = new Category($type, $description, $this->id);
            $created = $category->store_category();
            return $created;
        }

        public function get_categories(){
            $category = new Category("","",$this->id);
            return $category->all_categories();
        }
        /**
         * Permet à l'administrateur de récupérer les infos d'un category
         * @param int $id L'identifiant du category
         * @return array
         */
        public function get_category($idCategory){
            $category = new Category("","",$this->id);
            return $category->find_category_by_id($idCategory);
        }

        /**
         * Permet de modifier les informations d'un category
         * @param int $idcategory L'id du category
         * @param string $type Le nom du category
         * @param string $description Le prenom du category
         * @param string $type L'type du category
         */
        public function update_category($idCategory,$type,$description){
            $category = new Category($type,$description,$this->id);
            $category->find_category_by_id($idCategory);
            return $category->update_category();
        }

        /**
         * Permet à l'admin de supprimer un gestionnaire
         * @param int $idCategory L'id du category à supprimer
         */
        public function delete_category($idCategory){
            $category = new Category("","", $this->id);
            return $category->delete($idCategory); 
        }
        /*************************************      PARTIE PRODUIT      ***************************************/

        /**
         * Cette méthode permet d'enregistrer un nouveau vendeur par un admin
         * @param string $type Le type du vendeur
         * @param string $description Le prenom du vendeur
         * @return bool true||false
         */
        public function add_product($libelle, $price, $code, $idCategory, $quantity){
            if(!$this->find_manager_by_email($this->email)){
                return false;
            }
            $product = new Product($libelle, $price, $code, $quantity, $idCategory, $this->id);
            $created = $product->store_product();
            return $created;
        }

        public function get_products(){
            $product = new Product("","","","","",$this->id);
            return $product->all_products();
        }
        /**
         * Permet à l'administrateur de récupérer les infos d'un product
         * @param int $id L'identifiant du product
         * @return array
         */
        public function get_product($idProduct){
            $product = new Product("","","","","",$this->id);
            return $product->find_product_by_id($idProduct);
        }

        /**
         * Permet de modifier les informations d'un product
         * @param int $idProduct L'id du product
         * @param string $type Le nom du product
         * @param string $description Le prenom du product
         * @param string $type L'type du product
         */
        public function update_product($idProduct,$libelle, $price, $code, $idCategory, $quantity){
            $product = new Product($libelle,$price,$code,$quantity,$idCategory,$this->id);
            $product->find_product_by_id($idProduct);
            return $product->update_product();
        }

        /**
         * Permet à l'admin de supprimer un gestionnaire
         * @param int $idProduct L'id du product à supprimer
         */
        public function delete_product($idProduct){
            $product = new Product("","","","","", $this->id);
            return $product->delete($idProduct); 
        }
    }