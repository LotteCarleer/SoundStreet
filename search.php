<?php 

session_start();

if (!isset($_SESSION["logged_in"])){
    header("location: login.php");
    exit;
}

include_once(__DIR__ . "/classes/database.php");
include_once(__DIR__ . "/classes/Product.php");

if (!isset($_GET["search"]) || $_GET["search"] === "" ){
    header("Location: product.php");
    exit;
}

$db = new Database();
$productObj = new Product($db);

$search = "%" . $_GET["search"] . "%";

$stmt = $db->prepare("SELECT * FROM products WHERE title LIKE ? OR artist LIKE ? OR genre LIKE ?");
$stmt->execute([$search, $search, $search]);

$products = $stmt->fetchAll();





?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoeken</title>
</head>
<body>

<h1>Zoekresultaten voor ...</h1>

<p>Geen producten gevonden</p>

<div class="product">

<h3>title</h3>
<p>artist</p>
<p> ... SoundCoins</p>
<a href="">Bekijk details</a>

</div>

<a href="product.php">Terug naar producten</a>
    
</body>
</html>