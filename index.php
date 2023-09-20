<?php
    session_start();
    if($_SESSION['admin']==null AND $_SESSION['manager']==null AND $_SESSION['dealer']==null){
        header("Location: login.php");
    }else{
        if(isset($_SESSION['admin'])){
            header("Location: admin/index.php");
        }
        if(isset($_SESSION['manager'])){
            header("Location: manager/index.php");
        }
        if(isset($_SESSION['dealer'])){
            header("Location: dealer/index.php");
        }
    }
?>