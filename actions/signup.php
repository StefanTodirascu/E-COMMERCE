<?php
require_once "../models/User.php";
require_once "../models/Cart.php";
require_once "../models/DBManager.php";

$email = $_POST['email'];
$password = hash('sha256', $_POST['password']);
$confirmPassword = hash('sha256', $_POST['confirm-password']);

if($password==$confirmPassword)
{
    $pdo = DBManager::Connect("ecommerce");
    if(!(User::FindByEmail($email))){
        $params = array("email" => $email, "password"=>$password);
        $user = User::Create($params);
        if($user){
            if(Cart::Create($user->getId())){
                header('Location:../views/login.php');
                exit();
            }

        }
    }
    else{
        header('../views/login.php');
        exit();
    }
}
else
{
    header('../views/sign_up.php');
    exit();
}


