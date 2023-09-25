<section class="section dashboard">
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
                <h5 class="card-title">Produits <span>| Liste</span></h5>
                <?= isset($success) ?  $components->alert($success, 'check-circle') : ""?>
                <?= isset($error) ?  $components->alert($error, 'exclamation-triangle', 'danger m-2') : ""?>
                <table class="table table-borderless datatable">
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
                                    <a href="?to=product&update=<?= $product->produit_id?>" class="btn btn-sm btn-outline-primary" title="Modifier"><i class="bi bi-pencil"></i></a>
                                    <a href="?to=product&delete=<?= $product->produit_id?>" class="btn btn-sm btn-outline-danger" title="Supprimer"><i class="bi bi-trash"></i></a>
                                    
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</section>