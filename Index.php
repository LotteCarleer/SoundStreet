
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
      
 
        .intro{
            display: flex;
            align-items: center;
            gap: 200px;
            background-color: #B2AB9F;
            padding: 10px;
            padding-left: 20px;
            padding-bottom: 30px;
            margin-left: 50px;
            margin-right: 50px;
            border-radius: 20px;
            

        }

        .intro a{
            text-decoration: none;
            color: black;
            background-color: #FAFAF9;
            padding: 10px;
            border-radius: 10px;
            font-weight: bolder;
           
            
            
        }

        .intro p{
            
            font-size: 20px;
            margin-bottom: 30px;
        }

        .image{
            padding-top: 15px;
            padding-right: 40px;
            padding-left: 0px;
        }
       
       .text{
        margin-left: 40px;
       } 

       @media (max-width: 768px) {
        .intro{
            flex-direction: column;
            text-align:left;
            gap: 40px;

        }
        
        .image{
            padding-left: 30px;
        }
        
        .text{
            margin-left: 20px;
            margin-right: 30px;
        }
       }
        
    </style>
</head>
<body>

<p><a href="logout.php">uitloggen</a></p>

    <div class="intro">

    <div class="text">
    <h1>Welkom bij SoundStreet!</h1>
    <p>Bij SoundStreet vind je alles voor de echte muziekliefhebber: van vinyl LP’s en cd’s tot toffe merchandise en hoogwaardige platenspelers. Duik in een wereld van muziek, ontdek nieuwe artiesten, herontdek tijdloze klassiekers en geef je collectie een welverdiende upgrade. Of je nu op zoek bent naar dat zeldzame album, een unieke gadget of gewoon inspiratie voor je volgende luisterervaring, bij SoundStreet vind je altijd iets dat je hart sneller laat kloppen. Laat je meeslepen door de passie voor muziek en maak van elke luisterbeurt een belevenis.</p>
    <a href="product.php">Alle Producten</a>
    </div>

    <div class="image" >
    <img src="Images_index/MusicShop.png" alt="MuziekShop">
    </div>

    </div>

    

    <h2>Uitgelichte Categorieën</h2>
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