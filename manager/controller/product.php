<?php
    $listIndexed=[];
    $categories = $manager->get_categories();
    foreach($categories as $category){
        $categoryListIndexed[$category->id] = $category->type;
    }
    // Enregistré un produit
    if(isset($_POST['product'])){
        extract($_POST);
        $code = strtoupper(substr(uniqid(), 7));
        $added = $manager->add_product($libelle, $price, $code, $category_id, $quantity);
        if($added){
            $success = "Nouveau produit enregistré avec succès";
            $products = $manager->get_products();
            unset($_POST);
        }
    }

    
    //Lister les produits
    if(isset($_GET['action']) && $_GET['action'] == "list"){
        require 'view/product_list.php';
    }elseif(isset($_GET['update'])){ // Partie modification du produit
        $idProduct = (int) $_GET['update'];
        $productToUpdate = $manager->get_product($idProduct);
        $update = true;
        
    }elseif(isset($_GET['delete'])){//Partie suppression
        $idProduct = (int) $_GET['delete'];
        $deleted = $manager->delete_product($idProduct);
        var_dump($deleted);
        if($deleted)$success = "Le produit retiré avec succès"; 
        else $error = "Echec de suppression";
        $products = $manager->get_products();
        require 'view/product_list.php';
    }
    else{
        require 'view/product_form.php';
    }
    if(isset($_POST['update_product'])){
        extract($_POST);
        $updated = $manager->update_product($productToUpdate->id, $libelle, $price, "", $category_id, (int)$quantity);
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

    