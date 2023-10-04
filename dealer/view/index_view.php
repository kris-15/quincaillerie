<?php
    require_once '../partials/Components.php';
    $component = new Components();
?>
<div class="row">
    <section class="section dashboard">
        <div class="col-lg-12">
            <div class="row">
                <?= $component->bloc_dashboard("Rapport", 'Team', 'bi-stack', ["?to=deal&action=list", "?to=deal"])?>
                <?= $component->bloc_dashboard("Produits", 'Team', 'bi-cart-check', ["?to=product&action=list", "?to=product"], count($products))?>
            </div>
        </div>
    </section>
</div>