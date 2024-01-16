<?php
require_once "DBManager.php";

class User
{
    private $id;
    private $email;
    private $password;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */


    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public static function Create($params)
    {
        $email = $params["email"];
        $password = $params["password"];
        $pdo = DBManager::Connect("ecommerce");
        $stm = $pdo->prepare("INSERT INTO users (email, password) values (:email, :password)");
        $stm->bindParam(':email', $params["email"]);
        $stm->bindParam(':password', $params["password"]);
        if ($stm->execute()) {
            return self::getLastInsert();
        } else {
            return false;
        }


    }

    public static function FindByEmail($email)
    {
        $pdo = DBManager::Connect("ecommerce");
        $stm = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stm->bindParam(":email", $email);
        $stm->execute();
        return $stm->fetchObject("User");
    }

    public static function getUser($id)
    {
        $pdo = DBManager::Connect("ecommerce");
        $stm = $pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stm->bindParam(":id", $id);
        $stm->execute();
        return $stm->fetchObject("User");
    }

    public static function getLastInsert()
    {
        $pdo = DBManager::Connect("ecommerce");
        $stm = $pdo->prepare("SELECT * FROM users ORDER BY id DESC LIMIT 1");
        $stm->execute();
        return $stm->fetchObject("User");
    }
}