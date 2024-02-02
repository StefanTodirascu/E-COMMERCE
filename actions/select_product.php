<?php
session_start();

if (!isset($_SESSION['current_user'])) {
    header('Location: ../views/login.php');
    exit();
} else {
    $id = $_POST['product_id'];
    $quantita = $_POST['product_q'];

    if ($quantita) {
        header("Location: http://localhost:63342/E-COMMERCE/views/products/product_details.php?id=$id&quantita=$quantita");
        exit();
    }
    else{
        header("Location: ../views/products/product_details.php?id=$id");
        exit();
    }
}