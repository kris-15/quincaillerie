
<li class="nav-item">
    <a class="nav-link collapsed text-success" href="index.php">
      <i class="bi bi-grid text-success"></i>
      <span>Dashboard</span>
    </a>
</li>
<?php if(isset($_SESSION['dealer'])): ?>
  <li class="nav-item">
    <a class="nav-link collapsed" href="">
      <i class="bi bi-basket text-success"></i>
      <span class="text-success">Produits</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed text-success" href="">
      <i class="bi bi-bar-chart-line text-success"></i>
      <span>Rapport</span>
    </a>
  </li>
<?php endif ?>
<?php if(isset($_SESSION['manager'])): ?>
  <li class="nav-item">
      <a class="nav-link collapsed text-success" href="">
        <i class="bi bi-basket text-success"></i>
        <span>Produits</span>
      </a>
  </li>
  <li class="nav-item">
      <a class="nav-link collapsed   text-success " href="">
        <i class="bi bi-folder text-success"></i>
        <span>Catégories</span>
      </a>
  </li>
<?php endif ?>
<?php if(isset($_SESSION['admin'])): ?>
  <li class="nav-item">
      <a class="nav-link collapsed text-success" href="?actor=manager&action=list">
        <i class="bi bi-people text-success"></i>
        <span>Gestionnaires</span>
      </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed  text-success" href="?actor=dealer&action=list">
      <i class="bi bi-person text-success"></i>
      <span>Vendeur</span>
    </a>
  </li>
  <li class="nav-item">
      <a class="nav-link collapsed  text-success  " href="">
        <i class="bi bi-share text-success"></i>
        <span>Factures</span>
      </a>
  </li>
  <!-- <li class="nav-item">
      <a class="nav-link collapsed text-success    " href="">
        <i class="bi bi-collection text-success"></i>
        <span class="text-success">Stock</span>
      </a>
  </li> -->
  <li class="nav-item">
      <a class="nav-link collapsed text-success" href="?to=product&action=list">
        <i class="bi bi-basket text-success"></i>
        <span>Etat de stock</span>
      </a>
  </li>
  <li class="nav-item">
      <a class="nav-link collapsed  text-success  " href="">
        <i class="bi bi-bar-chart-line text-success"></i>
        <span>Rapport</span>
      </a>
  </li>
  
<?php  endif ?>
<li class="nav-item">
  <a class="nav-link collapsed  text-success  " href="../logout.php">
    <i class="bi bi-box-arrow-right text-success"></i>
    <span>Se déconnecter</span>
  </a>
</li>