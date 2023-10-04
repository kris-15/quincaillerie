<?php
class Panier{
    public function __construct()
    {
        if(!isset($_SESSION)){
            session_start();
        }
        if(!isset($_SESSION['panier'])){
            $_SESSION['panier']=array();
        }
    }
    public function add($product_id,){
        array_push($_SESSION['panier'], [$product_id => 100]);
    }
}