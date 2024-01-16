<?php
session_start();

if ($_SESSION['current_user']) {
    session_unset();
    session_destroy();
    header('location:../views/products/index.php');
    exit;
}