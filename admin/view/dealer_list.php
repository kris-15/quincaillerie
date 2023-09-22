<section class="section dashboard">
    <div class="col-12">
        <div class="card recent-sales overflow-auto">

            <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                        <h6>Action</h6>
                    </li>
                    <li><a class="dropdown-item" href="?actor=dealer">Ajouter</a></li>
                </ul>
            </div>
            
            <div class="card-body">
                <h5 class="card-title">Gestionnaires <span>| Liste</span></h5>
                <?= isset($success) ?  $components->alert($success, 'check-circle') : ""?>
                <?= isset($error) ?  $components->alert($error, 'exclamation-triangle', 'danger m-2') : ""?>
                <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Matricule</th>
                            <th scope="col">Prenom</th>
                            <th scope="col">Téléphone</th>
                            <th scope="col">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($dealers as $dealer): ?>
                            <tr>
                                <th scope="row"><a href="#"><?= $inc++ ?></a></th>
                                <td class="text-primary fw-bold"><?= $dealer->matricule ?></td>
                                <td class="text-primary"><?= $dealer->prenom ?></td>
                                <td class="text-primary"><?= $dealer->telephone ?></td>
                                <td>
                                    <a href="?actor=dealer&update=<?= $dealer->id?>" class="btn btn-sm btn-outline-primary" title="Modifier"><i class="bi bi-pencil"></i></a>
                                    <a href="?actor=dealer&delete=<?= $dealer->id?>" class="btn btn-sm btn-outline-danger" title="Supprimer"><i class="bi bi-trash"></i></a>
                                    
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</section>