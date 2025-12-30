<?php

class Database {
    private $pdo;

    public function __construct(){

        $host = $_ENV["DB_HOST"] ?? "localhost";
        $db = $_ENV["DB_NAME"] ?? "SoundStreet";
        $user = $_ENV["DB_USER"] ?? "root";
        $pass = $_ENV["DB_PASS"] ?? "";



        $this->pdo = new PDO ("mysql:host=$host;dbname=$db; charset=utf8", $user , $pass);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function query ($sql){
        return $this->pdo->query($sql);
    }

    public function prepare($sql){
        return $this->pdo->prepare($sql);
    }

    public function lastInsertId(){
        return $this->pdo->lastInsertId();
    }
}


?>