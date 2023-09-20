<?php
session_start();
if($_SESSION['admin']==null AND $_SESSION['manager']==null AND $_SESSION['dealer']==null){
    header("Location: login.php");
}
$content = "Hello ". $_SESSION['admin'];
require '../partials/app.php';