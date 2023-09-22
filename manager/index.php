<?php
session_start();
if($_SESSION['manager']==null){
    header("Location: ../login.php");
}
ob_start();
if(isset($_GET['to']) AND $_GET["to"] == "category"){
    require 'controller/category.php';
}
if(isset($_GET['to']) AND $_GET["to"] == "product"){
    require 'controller/product.php';
}
require 'view/index_view.php';
$content = ob_get_clean();
require '../partials/app.php';