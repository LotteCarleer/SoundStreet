<?php 

session_start();

if (!isset($_SESSION["logged_in"])){
    header("Location: login.php");
    exit;
}


?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winkelmandje</title>
</head>
<body>

<h2>Winkelmandje</h2>

<p>Je winkelmandje is voorlopig leeg</p>

<a href="product.php">Verder winkelen</a>
    
</body>
</html>