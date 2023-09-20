<?php
    require '../model/Admin.php';
    $admin = new Admin("", "", $_SESSION['admin'], '');
    if(isset($_POST['manager'])){
        extract($_POST);
        $created = $admin->create_manager($lastName, $firstName, $email, "0000");
        if($created){
            $success = "Nouveau gestionnaire ajouté avec succès";
            unset($_POST);
        }
    }

    require 'view/manager_form.php';