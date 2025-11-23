<?php

if (session_status() === PHP_SESSION_NONE){
    session_start();
}

?>

<nav style="padding: 10px; background:#F2E9E1; margin-bottom:20px;">

<a href="index.php" style="margin-right: 15px;">Home</a>
<a href="product.php" style="margin-right: 15px;">Products</a>

<a href="" style="margin-right: 15px;">Mijn account</a>

<?php if(!empty($_SESSION["is_admin"]) && $_SESSION["is_admin"] === true): ?>
<a href="/admin/products.php">Admin Panel</a>
<?php endif; ?>

<form action="/search.php" method="GET">
    <input type="text" name="q" placeholder="Zoek" required>
    <button type="submit">Zoeken</button> 
</form>
</nav>