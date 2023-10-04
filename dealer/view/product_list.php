<?php 
    require '../partials/Form.php';
    $form = new Form();
?>
<section class="section dashboard">
    <div class="row">
        <div class="col-8">
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
                    <h5 class="card-title text-success">Produits <span>| Liste</span></h5>
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
                                <th scope="col">Option</th>
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
                                    <td>
                                        <a href="?to=product&add=<?= $product->produit_id?>" class="btn btn-sm btn-outline-success" title="Vendre"><i class="bi bi-cart-plus"></i></a>
                                        
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
        
        <div class="col-4">
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
                    <h5 class="card-title text-success">Vente produit<span>| <?= count($toSale) ?></span></h5>
                    <?= isset($success) ?  $components->alert($success, 'check-circle') : ""?>
                    <?= isset($error) ?  $components->alert($error, 'exclamation-triangle', 'danger m-2') : ""?>
                    <?php if(count($toSale)>0):?>
                        <?php foreach($toSale as $key => $thisProduct): ?>
                            <form action="" method="post">
                                <input type="hidden" name="product<?= $key ?>" value="<?= $thisProduct['id'] ?>">
                                <input type="hidden" name="prix<?= $key ?>" value="<?= $thisProduct['prix'] ?>">
                                <?= $form->input_field('number', 'quantity'.$key, "La quantité pour {$thisProduct['libelle']}", min:01)?>
            
                            
                        <?php endforeach ?>
                            <button type="submit" class="btn btn-success w-100 mt-2" name="deal">Enregistrer</button>
                            </form>
                        <?php else:?>
                        <p class="text-warning">Pas d'articles</p>
                    <?php endif ?>
                </div>

            </div>
        </div>
    </div>
</section>