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

$product = Product::getProduct($_POST['id']);
$params = array("nome" => $_POST['nome'], "marca"=>$_POST['marca'], "prezzo"=>(double)$_POST['prezzo']);

if ($product->update($params)) {
    header("Location: ../../views/products/index.php");
    exit();
}
