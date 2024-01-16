<?php
session_start();

if (!isset($_SESSION['current_user'])) {
    header('Location: ../views/login.php');
    exit();
} else {
    $id = $_POST['product_id'];
    header("Location: ../views/products/product_details.php?id=$id");
    exit();
}