<section class="section dashboard">
    <div class="col-12">
        <div class="card recent-sales overflow-auto">

            <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                        <h6>Action</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Manger</a></li>
                    <li><a class="dropdown-item" href="#">Ajouter</a></li>
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
                            <th scope="col">Nom</th>
                            <th scope="col">Prenom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($managers as $manager): ?>
                            <tr>
                                <th scope="row"><a href="#"><?= $inc++ ?></a></th>
                                <td><?= $manager->nom ?></td>
                                <td class="text-primary"><?= $manager->prenom ?></td>
                                <td class="text-primary"><?= $manager->email ?></td>
                                <td>
                                    <a href="?actor=manager&update=<?= $manager->id?>" class="btn btn-sm btn-outline-primary" title="Modifier"><i class="bi bi-pencil"></i></a>
                                    <a href="?actor=manager&delete=<?= $manager->id?>" class="btn btn-sm btn-outline-danger" title="Supprimer"><i class="bi bi-trash"></i></a>
                                    
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</section>