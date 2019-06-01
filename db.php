<?php
session_start();


class DB
{
    private static $db = null;

    private static function get()
    {
        if ($this->db === null) {
            $this->db = new \PDO("mysql:host=gondr.asuscomm.com; dbname=yy_10122; charset=utf8mb4;", "yy_10122", "1234");
        }
        return $this->db;
    }

    public static function fetch(string $sql, array $param = [])
    {
        $query = $this->get()->prepare($sql);
        $query->execute($param);
        return $query->fetch(\PDO::FETCH_OBJ);
    }

    public static function fetchAll(string $sql, array $param = [])
    {
        $query = $this->get()->prepare($sql);
        $query->execute($param);
        return $query->fetchAll(\PDO::FETCH_OBJ);
    }

    public static function execute(string $sql, array $param = [])
    {
        $query = $this->get()->prepare($sql);
        return $query->execute($param);
    }
}

// DB::fetch("SELECT * FROM users WHERE email=?", [$email]);

$con = new PDO(
    "mysql:host=gondr.asuscomm.com;
    dbname=yy_10122;
    charset=utf8mb4", "yy_10122", "1234");


function query($con, $sql, $param = []){
    $q = $con->prepare($sql);
    $cnt = $q->execute($param);
    return $cnt;
}

function fetch($con, $sql, $param = []){
    $q = $con->prepare($sql);
    $q->execute($param);
    return $q->fetch(PDO::FETCH_OBJ);
}

function fetchAll($con, $sql, $param = []){
    $q = $con->prepare($sql);
    $q->execute($param);
    return $q->fetchAll(PDO::FETCH_OBJ);
}

function msgAndGo($msg, $link){
    echo "<script>";
    echo "alert('$msg');";
    echo "location.href='$link';";
    echo "</script>";
}

function msgAndBack($msg){
    echo "<script>";
    echo "alert('$msg');";
    echo "history.back();";
    echo "</script>";
}

function dump($var){
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}