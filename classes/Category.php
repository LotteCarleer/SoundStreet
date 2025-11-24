<?php 
class Category{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function all(){
        $stmt = $this->db->query("SELECT * FROM categories");
        return $stmt->fetchAll();
    }

    public function add($name){
        $stmt = $this->db->prepare("INSERT INTO categories (name) VALUES (?)");
        return $stmt->execute([$name]);
    }

}


?>