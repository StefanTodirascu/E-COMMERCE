<?php
include '../models/Session.php';
include '../models/Product.php';
include '../models/Cart.php';
include '../models/User.php';
session_start();
if (isset($_SESSION['current_user'])) {
    $idUser = $_SESSION['current_user']->getId();
    Cart::resetCart($idUser);
    header("Location: ../views/products/index.php");
    exit();
} else {
    header("Location: ../views/login.php");
    exit();
}
?>
