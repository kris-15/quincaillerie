<?php
session_start();
if($_SESSION['admin']==null AND $_SESSION['manager']==null AND $_SESSION['dealer']==null){
    header("Location: ../login.php");
}
ob_start();
if(isset($_GET['actor']) AND $_GET["actor"] == "manager"){
    require 'controller/manager.php';
}
if(isset($_GET['actor']) AND $_GET["actor"] == "dealer"){
    require 'controller/dealer.php';
}
require 'view/index_view.php';
$content = ob_get_clean();
require '../partials/app.php';