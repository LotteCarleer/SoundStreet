<?php

if (session_status() === PHP_SESSION_NONE){
    session_start();
}

?>

<nav style="padding: 10px; background:#eee; margin-bottom:20px;">

<a href="index.php">Home</a>
<a href="product.php">Products</a>

<a href="">Mijn account</a>

<a href="/admin/products.php">Admin Panel</a>

<form action="/search.php" method="GET">
    <input type="text" name="q" placeholder="Zoek" required>
    <button type="submit">Zoeken</button> 
</form>
</nav>