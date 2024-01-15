<?php
require_once "../models/DBManager.php";
require_once "../models/User.php";
require_once "../models/Session.php";

$email = $_POST['email'];
$password = $_POST['password'];
$hashedPassword = hash('sha256', $password);

$pdo=DBManager::connect("ecommerce");
$stm = $pdo->prepare("SELECT * FROM ecommerce.users WHERE email = :email AND password = :password limit 1");
$stm->bindParam(":email", $email);
$stm->bindParam(":password", $hashedPassword);
$stm->execute();
$current_user = $stm->fetchObject("User");

if($current_user){
    session_start();
    $_SESSION['current_user'] = $current_user;
    $params=array("ip" => $_SERVER["REMOTE_ADDR"], "user_id" => $current_user->getId(), "data" => date('Y-m-d H-i-s'));
    Session::Create($params);
    header('Location: http://localhost:63342/views/products/index.php');
    exit;
}
else {
    header('Location: http://localhost:63342/views/login.php');
    exit;
}




