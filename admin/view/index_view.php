<?php
    require_once '../partials/Components.php';
    $component = new Components();
?>
<div class="d-flex justify-content-end">
    <button onclick="window.print()" class="btn btn-success mb-2" type="submit">Imprimer</button>
</div>
<div class="row">
    <section class="section dashboard">
        <div class="col-lg-12">
            <div class="row">
                <?= $component->bloc_dashboard("Gestionnaire", 'Team', 'bi-people', ["?actor=manager&action=list", "?actor=manager"], count:count($managers))?>
                <?= $component->bloc_dashboard("Vendeur", 'Team', 'bi-people', ["?actor=dealer&action=list", "?actor=dealer"], count:count($dealers))?>
                <?= $component->bloc_dashboard("Stock", 'Team', 'bi-collection', ["?to=product", "#"], count:count($managers))?>
                <?= $component->bloc_dashboard("Rapport", 'Team', 'bi-cart', ["#", "#"], count:0)?>
            </div>
        </div>
    </section>
</div>