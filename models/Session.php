<?php
require_once "DBManager.php";

class Session
{
    private $id;
    private $ip;
    private $data;


    public function getId()
    {
        return $this->id;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public static function Create($params)
    {
        $pdo = DBManager::connect("ecommerce");
        $stm = $pdo->prepare("insert into sessions(ip, data_login, user_id) values (:ip, :data_login, :user_id)");
        $stm->bindParam(':ip', $params["ip"]);
        $stm->bindParam(':data_login', $params["data"]);
        $stm->bindParam(':user_id', $params["user_id"]);
        if ($stm->execute()) {
            $stm = $pdo->prepare("select * from sessions order by id desc limit 1");
            $stm->execute();
            return $stm->fetchObject('Session');
        }
        return false;
    }

    public function delete()
    {
        $pdo = DBManager::Connect("ecommerce");
        $stmt = $pdo->prepare("UPDATE ecommerce.sessions SET isActive = false, data_logout = :data_logout WHERE id = :id");
        $data = date('Y-m-d H-i-s');
        $stmt->bindParam(":data_logout", $data);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
    }

    public static function Find($id)
    {
        $pdo = DBManager::Connect("ecommerce");
        $stmt = $pdo->prepare("select * from sessions where id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchObject("Session");
    }
}
