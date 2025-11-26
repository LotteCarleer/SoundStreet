<?php

session_start();

include 'includes/nav.php';

if (!isset($_SESSION["logged_in"])){
  header("Location: login.php");
  exit;
}

include_once(__DIR__ . '/classes/database.php');
include_once(__DIR__ . '/classes/Category.php');
include_once(__DIR__ . '/classes/Product.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producten</title>
    <link rel="stylesheet" href="css/normalize.css">
</head>
<body>
  <h1>Producten</h1>  
</body>
</html>