<?php
session_start();
if($_SESSION['manager']==null){
    header("Location: ../login.php");
}
ob_start();
require '../model/Manager.php';
require_once '../partials/Components.php';
$manager = new Manager("", "", $_SESSION['manager'], '', '');
$components = new Components();
$manager->find_manager_by_email($manager->email);
$update;
$inc = 1;
$products = $manager->get_products();
$categories = $manager->get_categories();
if(isset($_GET['to']) AND $_GET["to"] == "category"){
    require 'controller/category.php';
}
if(isset($_GET['to']) AND $_GET["to"] == "product"){
    require 'controller/product.php';
}
require 'view/index_view.php';
$content = ob_get_clean();
require '../partials/app.php';