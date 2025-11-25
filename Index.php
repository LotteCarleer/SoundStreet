
<?php

session_start();

include 'includes/nav.php';

if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true){
    header("Location: login.php");
    exit;
}

include_once(__DIR__ . '/classes/database.php');
include_once(__DIR__ . '/classes/Category.php');
include_once(__DIR__ . '/classes/Product.php');

$db = new Database();
$category = new Category($db);
$product = new Product($db);

$filter = $_GET['category_id'] ?? null;
$products = $product->all($filter);
$categories = $category->all();


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/normalize.css">

    <style>

        body{
            font-family:Arial, Helvetica, sans-serif;
            
        }
      
        .intro h1{
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            
        }
 
        .intro{
            
            background-color: #D19FB5;
            padding: 10px;
            padding-left: 20px;
            padding-bottom: 20px;
        }

        .intro a{
            text-decoration: none;
            color: black;
            background-color: white;
            padding: 10px;
            border-radius: 10px;
            font-weight: bolder;
            
        }

        .intro p{
            margin-bottom: 40px;
            font-size: large;
        }
        
    </style>
</head>
<body>

<p><a href="logout.php">uitloggen</a></p>
    <div class="intro">
    <h1>Welkom bij SoundStreet!</h1>
    <p>Bij SoundStreet vind je alles voor de echte muziekliefhebber: van vinyl LP’s en cd’s tot toffe merchandise en hoogwaardige platenspelers. Ontdek nieuwe artiesten, herontdek klassiekers en geef je muziekcollectie een upgrade.</p>
    <a href="product.php">Alle Producten</a>
    <img src="" alt="">
    </div>

    

    <h2>Categorieën</h2>
    <?php foreach ($products as $p): ?>
        <div>
         <h3><?= $p["title"] ?></h3>
         <p><?= $p["description"] ?></p>
         <p>Prijs: <?= $p["price"] ?> units</p>
         <?php if ($p["image"]): ?>
            <img src="<?= $p ["image"] ?>" width="120" >
          <?php  endif; ?>  

    
        </div>

    <?php endforeach; ?>    
      <div>
        <h3>
            Vinyls

        </h3>

      </div>
 
    <footer>

    <p>SoundStreet</p>
    </footer>

    
</body>
</html>