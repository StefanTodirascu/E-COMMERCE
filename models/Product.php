<?php
require_once "DBManager.php";

class Product
{
    private $id;
    private $nome;
    private $prezzo;
    private $marca;


    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getPrezzo()
    {
        return $this->prezzo;
    }

    public function setPrezzo($prezzo)
    {
        $this->prezzo = $prezzo;
    }

    public function getMarca()
    {
        return $this->marca;
    }

    public function setMarca($marca)
    {
        $this->marca = $marca;
    }

    public static function getProducts()
    {
        $pdo = DBManager::Connect("ecommerce");
        $stmt = $pdo->query("SELECT * FROM products");
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Product');
    }

    public static function getProduct($id)
    {
        $pdo = DBManager::Connect("ecommerce");
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id LIMIT 1");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchObject("Product");
    }

    public static function addProduct($params)
    {
        $pdo = DBManager::Connect("ecommerce");
        $stm = $pdo->prepare("INSERT INTO products (nome, marca, prezzo) VALUES (:nome, :marca, :prezzo)");
        $stm->bindParam(":nome", $params['nome']);
        $stm->bindParam(":marca", $params['marca']);
        $stm->bindParam(":prezzo", $params['prezzo']);
        return $stm->execute();
    }

    public function update($params)
    {
        $pdo = DBManager::Connect("ecommerce");
        $stmt = $pdo->prepare("UPDATE ecommerce.products SET nome = :nome, marca = :marca, prezzo = :prezzo  WHERE id = :id");
        $stmt->bindParam(':nome', $params['nome']);
        $stmt->bindParam(':marca', $params['marca']);
        $stmt->bindParam(':prezzo', $params['prezzo']);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    public function delete()
    {
        $pdo = DBManager::Connect("ecommerce");
        $stmt = $pdo->prepare("DELETE FROM ecommerce.products WHERE id = :id");
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }


}