<?php
require_once "../models/User.php";
session_start();

if (!isset($_SESSION['current_user'])) {
    header('Location: ../views/login.php');
    exit();
}

$user = $_SESSION['current_user'];
$id = $_POST['product_id'];
var_dump($user);
if($user->isAdmin())
{
    header("Location: ../views/products/admin/product.php?id=$id");
    exit();
}

$quantita = $_POST['product_q'];
if ($quantita) {
    header("Location: http://localhost:63342/E-COMMERCE/views/products/product_details.php?id=$id&quantita=$quantita");
    exit();
}

header("Location: ../views/products/product_details.php?id=$id");
exit();
