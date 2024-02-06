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

$product = Product::getProduct($_POST['product_id']);

if ($product->delete()) {
    header("Location: ../../views/products/index.php");
    exit();
}
