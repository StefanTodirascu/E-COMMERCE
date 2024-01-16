<?php
require_once "DBManager.php";

class Cart
{
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    private $user_id;

    public static function Create($idUser)
    {
        $pdo = DBManager::Connect("ecommerce");
        $stm = $pdo->prepare("INSERT INTO carts (user_id) values (:user_id)");
        $stm->bindParam(':user_id', $idUser);
        if ($stm->execute()) {
            return self::getLastInsert();
        } else {
            return false;
        }
    }

    public static function Find($idUser)
    {
        $pdo = DBManager::Connect("ecommerce");
        $stm = $pdo->prepare("SELECT * FROM carts WHERE user_id = :idUser LIMIT 1");
        $stm->bindParam(":idUser", $idUser);
        $stm->execute();
        return $stm->fetchObject("Cart");
    }

    private static function getLastInsert()
    {
        $pdo = DBManager::Connect("ecommerce");
        $stm = $pdo->prepare("SELECT * FROM carts ORDER BY id DESC LIMIT 1");
        $stm->execute();
        return $stm->fetchObject("Cart");
    }

    public function addProduct($params)
    {
        $pdo = DBManager::Connect("ecommerce");
        $stm = $pdo->prepare("INSERT INTO cart_products (cart_id, product_id, quantita) VALUES (:cart_id, :product_id, :quantita)");
        $stm->bindParam(":cart_id", $params['cart_id']);
        $stm->bindParam(":product_id", $params['product_id']);
        $stm->bindParam(":quantita", $params['quantita']);
        if ($stm->execute())
            return true;
        else
            return false;
    }

    public static function getProducts($idUser)
    {
        $card = self::Find($idUser);
        $idCard = $card->getId();

        $pdo = DBManager::Connect("ecommerce");
        //$stm = $pdo->prepare("SELECT * FROM carts WHERE user_id = :idUser LIMIT 1");

        $stmt = $pdo->prepare("SELECT product_id, quantita FROM ecommerce.cart_products WHERE cart_id = :cart_id");
        $stmt->bindParam(':cart_id', $idCard);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function resetCart($idUser)
    {
        $card = self::Find($idUser);
        $idCard = $card->getId();
        $pdo = DBManager::Connect("ecommerce");
        $stmt = $pdo->prepare("DELETE FROM ecommerce.cart_products WHERE cart_id = :cart_id");
        $stmt->bindParam(':cart_id', $idCard);
        $stmt->execute();
    }

}