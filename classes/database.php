<?php

class Database {
    private $pdo;

    public function __construct(){
        $this->pdo = new PDO ('mysql:host=localhost;dbname=SoundStreet', "root", "");
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