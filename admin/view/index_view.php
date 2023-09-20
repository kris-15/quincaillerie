<?php
    require_once '../partials/Components.php';
    $component = new Components();
?>
<div class="row">
    <section class="section dashboard">
        <div class="col-lg-12">
            <div class="row">
                <?= $component->bloc_dashboard("Gestionnaire", 'Team', 'bi-people', ["#", "?actor=manager"])?>
                <?= $component->bloc_dashboard("Vendeur", 'Team', 'bi-people', ["#", "#"])?>
                <?= $component->bloc_dashboard("Stock", 'Team', 'bi-collection', ["#", "#"])?>
                <?= $component->bloc_dashboard("Rapport", 'Team', 'bi-cart', ["#", "#"])?>
            </div>
        </div>
    </section>
</div>