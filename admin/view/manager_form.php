<?php
    require '../partials/Form.php';
    require_once '../partials/Components.php';
    $form = new Form();
    $components = new Components();
?>
<h2 class="h4 text-center card-title my-2"><?= isset($update) ? 'Modifier les informations':'Enregistrez un nouveau gestionnaire' ?></h2>
<?php 
    if(isset($success)){
        echo $components->alert($success, 'check-circle');
    } 
?>
<form action="" method="post">
    <?= $form->input_field('text', 'lastName', "Le nom du gestionnaire")?>
    <?= $form->input_field('text', 'firstName', "Le prenom du gestionnaire")?>
    <?= $form->input_field('text', 'email', "L'adresse email du gestionnaire")?>
    <button type="submit" class="btn btn-primary w-100 my-2" name="manager"><?= isset($update) ?'Modifier':'Ajouter'?></button>
</form>