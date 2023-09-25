<?php
    
    if(isset($_POST['category'])){
        extract($_POST);
        $created = $manager->create_category($type, $description);
        if($created){
            $success = "Nouvelle catégorie ajouté avec succès";
            unset($_POST);
        }
    }

    

    if(isset($_GET['action']) && $_GET['action'] == "list"){
        require 'view/category_list.php';
    }elseif(isset($_GET['update'])){
        $idCategory = (int) $_GET['update'];
        $categoryToUpdate = $manager->get_category($idCategory);
        $categoryToUpdate? $update = true : $update=null;
        
        
    }elseif(isset($_GET['delete'])){
        $idCategory = (int) $_GET['delete'];
        $deleted = $manager->delete_category($idCategory);
        if($deleted)$success = "Catégorie supprimée avec succès"; 
        else $error = "Echec de suppression";
        require 'view/category_list.php';
    }
    else{
        require 'view/category_form.php';
    }
    if(isset($_POST['update_category'])){
        extract($_POST);
        $updated = $manager->update_category($categoryToUpdate->id, $type, $description);
        if($updated){
            $success = "Modification des informations du gestionnaire avec succès";
        }
    }
    if(isset($update)){
        require 'view/category_form.php';
    }
    

    