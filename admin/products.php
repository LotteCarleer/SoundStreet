<?php

session_start();



if(!isset($_SESSION["logged_in"])){
    header("Location: ./login.php");
    exit;
}

require './classes/database.php';
require './classes/Category.php';
require './classes/Product.php';

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


$image = "";
if (!empty($_FILES["image"]["name"])){
  $image = "uploads/products/" . $_FILES["image"]["name"];
  move_uploaded_file($_FILES["image"]["tmp_name"], "../" . $image);
}

$product->add($title, $desc, $price, $cat_id, $image);

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

        <select name="category_id">
         <?php foreach ($category->all() as $cat): ?>
          <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
         <?php endforeach;  ?> 

        </select><br>

    <input type="file" name="image" ><br><br>
    <button name="addProduct">Toevoegen</button>
     </form>
</body>
</html>