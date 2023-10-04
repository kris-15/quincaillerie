<?php
    require '../partials/Form.php';
    require_once '../partials/Components.php';
    $form = new Form();
    $components = new Components();
?>
<h2 class="h4 text-center card-title my-2"><?= isset($update) ? 'Modifier les informations':'Enregistrez un nouveau produit' ?></h2>
<?php 
    if(isset($success)){
        echo $components->alert($success, 'check-circle');
    } 
    if(isset($error)){
        echo $components->alert($error, 'exclamation-triangle', 'danger');
    }
?>
<form action="" method="post">
    <?= $form->input_field('text', 'libelle', "Le libellé du produit", valueDefined: $productToUpdate->libelle ??'')?>
    <?= $form->input_field('number', 'price', "Le prix unitaire du produit en FC", valueDefined: $productToUpdate->prix_unitaire ??'', min:50)?>
    <?= $form->input_field('number', 'quantity', "La quantité à ajouter dans le stock", valueDefined: $productToUpdate->quantite ??'', min:01)?>
    <button type="submit" class="btn btn-primary w-100 my-2" name="<?= isset($update) ?'update_product':'product'?>"><?= isset($update) ?'Modifier':'Ajouter'?></button>
</form>