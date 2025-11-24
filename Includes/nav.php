<?php

if (session_status() === PHP_SESSION_NONE){
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigatie</title>

    <style>

        nav{
            padding: 10px;
            background-color: #BD4A7E;
            margin-bottom: 20px;
        }

        .links a {
            font-family: Arial, Helvetica, sans-serif;
           text-decoration: none;
           color: black;
           font-weight: bold;
           font-size: large;
        }
        
    </style>
</head>
<body>
<nav>

<div class="links">
<a href="index.php" style="margin-right: 15px;">Home</a>
<a href="product.php" style="margin-right: 15px;">Products</a>

<a href="" style="margin-right: 15px;">Mijn account</a>

<?php if(!empty($_SESSION["is_admin"]) && $_SESSION["is_admin"] === true): ?>
<a href="/admin/products.php">Admin Panel</a>
<?php endif; ?>


</div>
</nav>
</body>
</html>
