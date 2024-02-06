<?php
require_once "../../models/Product.php";
require_once "../../models/User.php";

session_start();
if (!isset($_SESSION['current_user'])) {
    header("Location: ../../views/login.php");
    exit();
}

if(!$_SESSION['current_user']->isAdmin()){
    header("Location: ../../views/login.php");
    exit();
}

$params = array("nome" => $_POST['nome'], "marca"=>$_POST['marca'], "prezzo"=>(double)$_POST['prezzo']);

if (Product::addProduct($params)) {
    header("Location: ../../views/products/index.php");
    exit();
}
