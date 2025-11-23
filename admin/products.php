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
     </form>

    <input type="file" name="image" ><br><br>
    <button name="addProduct">Toevoegen</button>
</body>
</html>