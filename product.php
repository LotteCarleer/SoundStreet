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

$db = new Database();
$category = new Category($db);
$product = new Product($db);

if(isset($_GET['category_id'])){
  $filter = $_GET['category_id'];
} else {
  $filter = null;
}

$products = $product->all($filter);

$categories = $category->all();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producten</title>
    <link rel="stylesheet" href="css/normalize.css">

    <style>
       
       body{
        font-family: Arial, Helvetica, sans-serif;
        
       }

       section{
        margin-left: 30px;
       }

       .products-grid{
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 20px;
        margin-right: 40px;
       }

       .products{
        
        border: solid 3px;
        border-radius: 10px;
        border-color: #9A8570;
        padding: 20px;
        margin: 30px 0;
        text-align: center;
        
        
       }
       
      .products img{
        width: 200px;
        border-radius: 10px;
        margin: 20px auto;
        
      }

      .categorieën{
        display: flex;
        flex-wrap: wrap;
        gap: 10px;

      }

      .categorieën a{
        
        text-decoration: none;
        color: black;
        font-weight: bold;
        border-radius: 5px;
        background-color: #B2AB9F;
        padding: 10px;


      }

      .categorieën a:hover{
        
        text-decoration: underline;
        
      }

    </style>
    
</head>
<body>
  <section>
  <h1>Producten</h1>  

  <form class="search" action="search.php" method="GET">
    <input type="text" name="search" placeholder="Zoek product">
    <button type="submit">Zoek</button>
  </form>

  <h2>Categorieën</h2>
  <div class="categorieën">

    <a href="product.php">Alle producten</a>

   <?php  foreach($categories as $cat): ?> 
    <a href="product.php?category_id=<?= $cat['id'] ?>">
      <?= htmlspecialchars($cat['name']) ?>
    </a>

    <?php endforeach; ?>
  </div>

  <h2>Resultaten</h2>

  <?php if(empty($products)): ?>
    <p>Geen producten gevonden in deze categorie!</p>
   <?php endif; ?> 
   
   <div class="products-grid" >
   <?php foreach($products as $p): ?>

    <div class="products">
      <h3><?= htmlspecialchars($p["title"]) ?></h3>
      <p><?= htmlspecialchars($p["description"]) ?></p>
      <p><p>Prijs:</p><?= $p["price"] ?> SoundCoins</p>

      <?php if (!empty($p["image"])): ?>
        <img src="<?= $p["image"] ?>" alt="Product image">
       <?php endif; ?> 

       <br><br>


       <a href="product_detail.php?id=<?= $p ['id'] ?>">
       <button>Bekijk details</button>
       </a>

      </div>

    
   <?php endforeach; ?>
   </div>
  </section>
  <?php include 'includes/footer.php'; ?>
</body>
</html>