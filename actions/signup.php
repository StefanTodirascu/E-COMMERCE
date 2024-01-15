<?php
require_once "../models/User.php";
require_once "../models/DBManager.php";

$email = $_POST['email'];
$password = hash('sha256', $_POST['password']);
$confirmPassword = hash('sha256', $_POST['confirm-password']);

if($password==$confirmPassword)
{
    $pdo = DBManager::Connect("ecommerce");
    if(!(User::FindByEmail($email))){
        $params = array("email" => $email, "password"=>$password);
        if(User::Create($params)){
            header('Location:http://localhost:63342/E-COMMERCE/views/login.php');
            exit();
        }
    }
    else{
        header('Location:http://localhost:63342/E-COMMERCE/views/login.php');
        exit();
    }
}
else
{
    header('Location:http://localhost:63342/E-COMMERCE/views/sign_up.php');
    exit();
}


