<?php
session_start();
if($_SESSION['admin']==null){
    header("Location: ../login.php");
}
ob_start();

require_once '../model/Admin.php';
require_once '../partials/Components.php';
$inc=1;
$admin = new Admin("", "", $_SESSION['admin'], '');
$components = new Components();
$admin->find_admin_by_username();
$products = $admin->get_products();
$managers = $admin->get_managers();
$dealers = $admin->get_dealers();
if(isset($_GET['actor']) AND $_GET["actor"] == "manager"){
    require 'controller/manager.php';
}elseif(isset($_GET['actor']) AND $_GET["actor"] == "dealer"){
    require 'controller/dealer.php';
}elseif(isset($_GET['to']) AND $_GET["to"] == "product"){
    require 'controller/product.php';
}else{
    require 'view/index_view.php';
}
$content = ob_get_clean();
require '../partials/app.php';