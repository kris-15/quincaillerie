<?php
    require '../partials/Form.php';
    require_once '../partials/Components.php';
    $form = new Form();
    $components = new Components();
?>
<h2 class="h4 text-center card-title my-2"><?= isset($update) ? 'Modifier les informations':'Enregistrez un nouveau vendeur' ?></h2>
<?php 
    if(isset($success)){
        echo $components->alert($success, 'check-circle');
    } 
    if(isset($error)){
        echo $components->alert($error, 'exclamation-triangle', 'danger');
    }
?>
<form action="" method="post">
    <?= $form->input_field('text', 'firstName', "Le prenom du vendeur", valueDefined: $dealerToUpdate->prenom ??'')?>
    <?= $form->input_field('text', 'phone', "Le numéro de téléphone du vendeur", valueDefined: $dealerToUpdate->telephone ??'', min:10)?>
    <button type="submit" class="btn btn-primary w-100 my-2" name="<?= isset($update) ?'update_dealer':'dealer'?>"><?= isset($update) ?'Modifier':'Ajouter'?></button>
</form>