<?php 
class Category{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function all(){
        $stmt = $this->db->query("SSELECT * FROM categories");
        return $stmt->fetchAll();
        
    }
}


?>