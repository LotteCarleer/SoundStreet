<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

session_start();



if(!isset($_SESSION["logged_in"])){
    header("Location: ./login.php");
    exit;
}

include_once(__DIR__ . '/../classes/database.php');
include_once(__DIR__ . '/../classes/Category.php');
include_once(__DIR__ . '/../classes/Product.php');

$db = new Database();
$category = new Category($db);
$product = new Product($db);

if (isset($_POST['add_category'])){
    $name = $_POST['category_name'];
    $category->add($name);
}

if (isset($_POST['add_product'])){
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $cat_id = $_POST['category_id'];
    $artist = $_POST['artist'];
    $genre = $_POST['genre'];
    $release_year = $_POST['release_year'];

    if ($title == ""){
      $error = "Titel mag niet leeg zijn.";
    } elseif ($desc == ""){
      $error = "Beschrijving mag niet leeg zijn.";
    } elseif ($price == "" || $price <= 0){
      $error = "Prijs moet een positief getal zijn.";
    } elseif ($cat_id == ""){
      $error = "Je moet een categorie kiezen.";
    } else{
     
      $image = "";
if (!empty($_FILES["image"]["name"])){
  $image = "uploads/products/" . $_FILES["image"]["name"];
  move_uploaded_file($_FILES["image"]["tmp_name"], "../" . $image);
}

$product->add($title, $desc, $price, $cat_id, $image, $artist, $genre, $release_year);
$error = "Product toegevoegd!";

    }

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorie toevoegen</title>

    <style>
      
    </style>
</head>
<body>

<?php if (!empty($error)): ?>
  <p style="color:red;" ><?= $error ?></p>
 <?php endif; ?> 

    <h2>Categorie toevoegen</h2>
    <form method="POST">

      <input type="text" name="category_name" placeholder="Naam nieuwe categorie"><br><br>
      <button name="add_category">Toevoegen</button>

    </form>
     <h2>Product toevoegen</h2>
     <form method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Titel"><br><br>
        <textarea name="description" placeholder="Beschrijving"></textarea><br><br>
        <input type="number" name="price" placeholder="Prijs" ><br><br>
        <input type="text" name="artist" placeholder="Artiest"><br><br>
        <input type="text" name="genre" placeholder="Genre"><br><br>
        <input type="number" name="release_year" placeholder="Release Jaar"><br><br>

        <?php 
        $cats = $category->all();
        if (empty($cats)){
          $cats = [];
        }
        
        ?>

        <select name="category_id" required>
         <?php if (!empty($cats)): ?>
           <?php foreach ($cats as $cat): ?>
            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
           <?php endforeach; ?>
          <?php else: ?>
           <option value="">Maak een categorie aan!</option>
          <?php endif; ?> 
        </select><br>

    <input type="file" name="image" ><br><br>
    <button name="add_product">Toevoegen</button>
     </form>
</body>
</html>