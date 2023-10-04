<?php
    
    $update;
    if(isset($_POST['dealer'])){
        extract($_POST);
        $matricule = strtoupper(substr(uniqid(), 7));
        $created = $admin->create_dealer($matricule, $firstName, $phone, "1111");
        if($created){
            $success = "Nouveau vendeur ajouté avec succès";
            unset($_POST);
        }
    }

    

    if(isset($_GET['action']) && $_GET['action'] == "list"){
        require 'view/dealer_list.php';
    }elseif(isset($_GET['update'])){
        $iddealer = (int) $_GET['update'];
        $dealerToUpdate = $admin->get_dealer($iddealer);
        $update = true;
        
    }elseif(isset($_GET['delete'])){
        $iddealer = (int) $_GET['delete'];
        $deleted = $admin->delete_dealer($iddealer);
        if($deleted)$success = "Le vendeur supprimé avec succès"; 
        else $error = "Echec de suppression";
        require 'view/dealer_list.php';
    }
    else{
        require 'view/dealer_form.php';
    }
    if(isset($_POST['update_dealer'])){
        extract($_POST);
        $updated = $admin->update_dealer($dealerToUpdate->id, $firstName, $phone);
        if($updated){
            $success = "Modification des informations du vendeur avec succès";
        }else{
            $error = "Echec de modification";
        }
        unset($_POST);
    }
    if(isset($update)){
        require 'view/dealer_form.php';
    }
    