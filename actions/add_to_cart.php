<?php
require_once "../models/User.php";
require_once "../models/Cart.php";
session_start();
$idProduct = $_POST['idProduct'];
$quantita = $_POST['quantita'];

$user = $_SESSION['current_user'];
$cart = Cart::Find($user->getId());
$idCart = $cart->getId();
$params = array("cart_id" => $idCart, "product_id" => $idProduct, "quantita" => $quantita);

if ($cart->addProduct($params)) {
    header("Location:../views/products/index.php");
    exit();
}
