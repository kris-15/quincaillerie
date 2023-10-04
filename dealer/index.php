<?php
session_start();
if($_SESSION['dealer']==null){
    header("Location: ../login.php");
}
ob_start();
require '../model/Dealer.php';
require_once '../partials/Components.php';
$dealer = new Dealer($_SESSION['dealer'],'', '', '', 0);
$components = new Components();
$dealer->find_dealer_by_matricule($dealer->matricule);
$update;
$inc = 1;
$products = $dealer->get_products();
if(isset($_GET['to']) AND $_GET["to"] == "deal"){
    require 'controller/category.php';
}
if(isset($_GET['to']) AND $_GET["to"] == "product"){
    require 'controller/product.php';
}
require 'view/index_view.php';
$content = ob_get_clean();
require '../partials/app.php';