<?php
    require_once '../partials/Components.php';
    $component = new Components();
?>
<div class="row">
    <section class="section dashboard">
        <div class="col-lg-12">
            <div class="row">
                <?= $component->bloc_dashboard("Catégories", 'Team', 'bi-stack', ["?to=category&action=list", "?to=category"])?>
                <?= $component->bloc_dashboard("Produits", 'Team', 'bi-ui-radios-grid', ["?to=product&action=list", "?to=product"])?>
            </div>
        </div>
    </section>
</div>