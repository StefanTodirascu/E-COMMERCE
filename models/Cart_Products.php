<?php
require_once "DBManager.php";

class Cart_Products
{
    private $cart_id;
    private $product_id;
    private $quantita;


    public function getCartId()
    {
        return $this->cart_id;
    }

    public function getProductId()
    {
        return $this->product_id;
    }

    public function getQuantita()
    {
        return $this->quantita;
    }

    public static function Find($cartId, $productId)
    {
        $pdo = DBManager::Connect("ecommerce");
        $stm = $pdo->prepare("SELECT * FROM cart_products WHERE cart_id = :cart_id AND product_id = :product_id LIMIT 1");
        $stm->bindParam(":cart_id", $cartId);
        $stm->bindParam(":product_id", $productId);
        $stm->execute();
        return $stm->fetchObject("Cart_Products");
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

    public static function getProducts($cartId)
    {
        $pdo = DBManager::Connect("ecommerce");
        $stmt = $pdo->prepare("SELECT product_id, SUM(quantita) AS quantita FROM ecommerce.cart_products WHERE cart_id = :cart_id GROUP BY product_id");
        $stmt->bindParam(':cart_id', $cartId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Cart_Products');
    }

    public function updateCart($quantita)
    {
        $pdo = DBManager::Connect("ecommerce");
        $stmt = $pdo->prepare("UPDATE ecommerce.cart_products SET quantita = :quantita WHERE cart_id = :cart_id AND product_id = :product_id");
        $stmt->bindParam(':quantita', $quantita);
        $stmt->bindParam(':cart_id', $this->cart_id);
        $stmt->bindParam(':product_id', $this -> product_id);
        return $stmt->execute();

    }

    public function delete()
    {
        $pdo = DBManager::Connect("ecommerce");
        $stmt = $pdo->prepare("DELETE FROM ecommerce.cart_products WHERE cart_id = :cart_id AND product_id = :product_id");
        $stmt->bindParam(':cart_id', $this->cart_id);
        $stmt->bindParam(':product_id', $this -> product_id);
        return $stmt->execute();
    }


}