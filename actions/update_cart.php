<?php
require_once "../models/User.php";
require_once "../models/Cart.php";
require_once "../models/Cart_Products.php";
session_start();
if (!isset($_SESSION['current_user'])) {
    header("Location:../views/login.php");
}

$idProduct = $_POST['idProduct'];
$quantita = (int)$_POST['quantita'];

$user = $_SESSION['current_user'];
$cart = Cart::Find($user->getId());
$idCart = $cart->getId();
$cart_product = Cart_Products::Find($idCart, $idProduct);

if ($cart_product->updateCart($quantita)) {
    header("Location: ../views/cart.php");
    exit();
}