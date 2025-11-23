<?php

class Product {
    private $db;

    public function __construct($db){
        $this->db = $db; 
    }

    public function all($category_id = null){
        if ($category_id){
            $stmt = $this->db->prepare("SELECT * FROM products WHERE category_id = ?");
            $stmt->execute([$category_id]);
        } else {
            $stmt = $this->db->query("SELECT * FROM products");
        }
        return $stmt->fetchAll();
    }
}


?>