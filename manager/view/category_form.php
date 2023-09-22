<?php
    require '../partials/Form.php';
    require_once '../partials/Components.php';
    $form = new Form();
    $components = new Components();
?>
<h2 class="h4 text-center card-title my-2"><?= isset($update) ? 'Modifier la catégorie':'Ajouter une nouvelle catégorie' ?></h2>
<?php 
    if(isset($success)){
        echo $components->alert($success, 'check-circle');
    } 
?>
<form action="" method="post">
    <?= $form->input_field('text', 'type', "Le type de la catégorie", valueDefined: $categoryToUpdate->type ??'')?>
    <?= $form->textarea_field('description', "La description de la catégorie", valueDefined: $categoryToUpdate->description ??'')?>
    <button type="submit" class="btn btn-primary w-100 my-2" name="<?= isset($update) ?'update_category':'category'?>"><?= isset($update) ?'Modifier':'Ajouter'?></button>
</form>