<?php 

session_start();
include_once "classes/database.php";

if (!isset($_SESSION["logged_in"])){
    header("Location: login.php");
    exit;
  }

  $db = new Database();

  $user_id = $_SESSION["user_id"];
  $product_id = $_POST["product_id"];
  $comment = $_POST["comment"];

  $stmt = $db->prepare("INSERT INTO comments (user_id, product_id, comment) VALUES (?, ?, ?)");

  $stmt->execute([$user_id, $product_id, $comment]);




?>