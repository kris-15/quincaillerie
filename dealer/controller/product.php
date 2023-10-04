<?php
    require 'Panier.php';
    
    $panierSession = new Panier();
    $toSale = [];
    $_SESSION['panier']=array();
    $panier = [];
    // Enregistré un produit
    if(isset($_POST['deal'])){
        extract($_POST);
        var_dump($_POST);
        $thisProduct = array('id'=>$product, 'quantité'=>$quantity,'total'=>$quantity*$prix);
        $_SESSION['panier'] = $thisProduct;
        header("Location:?to=product&add=$produit");
    }
    
    
    //Lister les produits
    if(isset($_GET['action']) && $_GET['action'] == "list"){
        require 'view/product_list.php';
    }elseif(isset($_GET['add'])){ // Partie modification du produit
        
        $idProduct = (int) $_GET['add'];
        $productToUpdate = $dealer->get_product($idProduct);
        $panierSession->add($productToUpdate->id);
        $toSale = $_SESSION['panier'];
        require 'view/product_list.php';
    }else{
        require 'view/product_form.php';
    }
    if(isset($_POST['update_product'])){
        extract($_POST);
        $updated = $dealer->update_product($productToUpdate->id, $libelle, $price, "", $category_id, (int)$quantity);
        if($updated){
            $success = "Modification des informations du produit avec succès";
        }else{
            $error = "Echec de modification";
        }
        unset($_POST);
    }
    if(isset($update)){
        require 'view/product_form.php';
    }
    var_dump($_SESSION);