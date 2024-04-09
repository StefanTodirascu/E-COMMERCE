<?php
require_once "../models/Session.php";
session_start();
if (isset($_SESSION['current_user'])) {
    $session = $_SESSION['session'];
    $session->delete();
    session_unset();
    session_destroy();
    header('location:../views/products/index.php');
    exit;
}