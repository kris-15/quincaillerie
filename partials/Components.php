<?php
    class Components{
        public function bloc_dashboard($title, $sub, $icon, array $links, $count =145){
            $message = $count >1 ?  "enregistrés":"enregistré";
            return <<<HTML
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>Action</h6>
                        </li>
                        <li><a class="dropdown-item" href="{$links[0]}">Gérer</a></li>
                        <li><a class="dropdown-item" href="{$links[1]}">Ajouter</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-success">$title <span>| $sub</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi $icon text-success"></i>
                            </div>
                            <div class="ps-3">
                                <h6 class="text-success">$count</h6>
                                <span class="text-success small pt-1 fw-bold">$message</span> <span class="text-muted small pt-2 ps-1">dans le stock</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
HTML;
        }
        /**
         * Permet d'afficher une alerte
         * @param string $message Le message à afficher
         * @param string $icon L'icone du message
         * @return string
         */
        public function alert($message, $icon, $type="success"){
            return <<<HTML
                <div class="alert alert-$type alert-dismissible fade show" role="alert">
                    <i class="bi bi-$icon me-1"></i>
                    $message
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
HTML;
        }
    }
?>