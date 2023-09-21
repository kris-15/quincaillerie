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
    <?= $form->input_field('text', 'lastName', "Le nom du gestionnaire", valueDefined: $managerToUpdate->nom ??'')?>
    <?= $form->input_field('text', 'firstName', "Le prenom du gestionnaire", valueDefined: $managerToUpdate->prenom ??'')?>
    <?= $form->input_field('text', 'email', "L'adresse email du gestionnaire", valueDefined: $managerToUpdate->email ??'')?>
    <button type="submit" class="btn btn-primary w-100 my-2" name="<?= isset($update) ?'modifier_manager':'manager'?>"><?= isset($update) ?'Modifier':'Ajouter'?></button>
</form>