<?php 
    require '../partials/Form.php';
    $form = new Form();
?>
<section class="section dashboard">
    <div class="row">
        <div class="col-12">
            <div class="card recent-sales overflow-auto">

                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>Action</h6>
                        </li>
                        <li><a class="dropdown-item" href="?to=product">Ajouter</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-success">Etat de stock <span>| Liste produit</span></h5>
                    <?= isset($success) ?  $components->alert($success, 'check-circle') : ""?>
                    <?= isset($error) ?  $components->alert($error, 'exclamation-triangle', 'danger m-2') : ""?>
                    <table class="table table-borderless datatable table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Code</th>
                                <th scope="col">Catégorie</th>
                                <th scope="col">Libellé</th>
                                <th scope="col">Prix unitaire</th>
                                <th scope="col">Stock entré</th>
                                <th scope="col">Etat de stock</th>
                            </tr>
                        </thead>
                    
                        <tbody>
                            <?php foreach($products as $product): ?>
                                <tr>
                                    <th scope="row"><a href="#"><?= $inc++ ?></a></th>
                                    <td class="text-primary fw-bold"><?= $product->code ?></td>
                                    <td class="text-primary"><?= $product->type ?></td>
                                    <td class="text-primary"><?= $product->libelle ?></td>
                                    <td class="text-primary"><?= $product->prix_unitaire ?> FC</td>
                                    <td class="text-primary"><?= $product->quantite ?></td>
                                    <td>
                                        <?php if($product->quantite >=1): ?>    
                                            <small class="badge bg-success">Disponible</small></td>
                                        <?php else: ?>
                                            <small class="badge bg-danger">Epuisé</small></td>
                                        <?php endif ?>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
</section>