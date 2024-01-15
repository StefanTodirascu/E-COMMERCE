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

    public static function Create($params){
        $pdo=DBManager::connect("ecommerce" );
        $stm = $pdo->prepare("insert into sessions(ip, data_login, user_id) values (:ip, :data_login, :user_id)");
        $stm->bindParam(':ip', $params["ip"]);
        $stm->bindParam(':data_login', $params["data"]);
        $stm->bindParam(':user_id', $params["user_id"]);
        if ($stm->execute()) {
            $stm = $pdo->prepare("select * from sessions order by id desc limit 1");
            $stm->execute();
            $session = $stm->fetchObject('Session');
        }
    }

    public static function Find($id)
    {
        $pdo = DBManager::Connect("ecommerce");
        $stmt = $pdo->prepare("select * from sessions where id = :id");
        $stmt->bindParam(":id", $id);
        if ($stmt->execute()) {
            return $stmt->fetchObject("Session");
        } else {
            throw new PDOException("sessione non trovata");
        }
    }
}
