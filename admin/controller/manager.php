<?php
    
    
    if(isset($_POST['manager'])){
        extract($_POST);
        $created = $admin->create_manager($lastName, $firstName, $email, "0000");
        if($created){
            $success = "Nouveau gestionnaire ajouté avec succès";
            unset($_POST);
        }
    }

    

    if(isset($_GET['action']) && $_GET['action'] == "list"){
        require 'view/manager_list.php';
    }elseif(isset($_GET['update'])){
        $idManager = (int) $_GET['update'];
        $managerToUpdate = $admin->get_manager($idManager);
        $update = true;
        
    }elseif(isset($_GET['delete'])){
        $idManager = (int) $_GET['delete'];
        $deleted = $admin->delete_manager($idManager);
        if($deleted)$success = "Gestionnaire supprimé avec succès"; 
        else $error = "Echec de suppression";
        require 'view/manager_list.php';
    }
    else{
        require 'view/manager_form.php';
    }
    if(isset($_POST['modifier_manager'])){
        extract($_POST);
        $updated = $admin->update_manager($managerToUpdate->id, $lastName, $firstName, $email);
        if($updated){
            $success = "Modification des informations du gestionnaire avec succès";
        }
    }
    if(isset($update)){
        require 'view/manager_form.php';
    }

    