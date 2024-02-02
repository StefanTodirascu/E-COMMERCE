<?php
require_once "../models/User.php";
require_once "../models/Cart.php";
require_once "../models/Cart_Products.php";
session_start();
if (!isset($_SESSION['current_user'])) {
    header("Location:../views/login.php");
}

$productId = $_POST['product_id'];

$user = $_SESSION['current_user'];
$cart = Cart::Find($user->getId());
$cartId = $cart->getId();
$cart_product = Cart_Products::Find($cartId, $productId);

if ($cart_product->delete()) {
    header("Location: http://localhost:63342/E-COMMERCE/views/cart.php");
    exit();
}