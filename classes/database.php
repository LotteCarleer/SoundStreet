<?php

class Database {
    private $pdo;

    public function __construct(){

        $host = getenv("DB_HOST") ?: "localhost";
        $db = getenv("DB_NAME") ?: "SoundStreet";
        $user = getenv("DB_USER") ?: "root";
        $pass = getenv("DB_PASS") ?: "";



        $this->pdo = new PDO ("mysql:host=$host;dbname=$db;charset=utf8mb4", $user , $pass);
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