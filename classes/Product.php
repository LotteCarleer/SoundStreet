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

    public function add($title, $description, $price, $category_id, $image, $artist, $genre, $release_year){
        $stmt = $this->db->prepare("
         INSERT INTO products (title, description, price, category_id, image, artist, genre, release_year)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");
    return $stmt->execute([$title, $description, $price, $category_id, $image, $artist, $genre, $release_year]);
    }

    public function find($id){
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id= ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function update($id, $title, $description, $price, $artist, $genre, $release_year){
        $stmt = $this->db->prepare("UPDATE products SET title = ?, description = ?, price = ?, artist = ?, genre = ?, release_year = ? WHERE id = ?");

        return $stmt->execute([ $title, $description, $price, $artist, $genre, $release_year, $id ]);
    }
    
    public function delete($id){
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }
}


?>