<?php 

session_start();

if (!isset($_SESSION["logged_in"])){
    header("location: login.php");
    exit;
}

include_once(__DIR__ . "/classes/database.php");
include_once(__DIR__ . "/classes/Product.php");

if (!isset($_GET["search"]) || $_GET["search"] === "" ){
    header("Location: product.php");
    exit;
}

$db = new Database();
$productObj = new Product($db);

$search = "%" . $_GET["search"] . "%";

$stmt = $db->prepare("SELECT * FROM products WHERE title LIKE ? OR artist LIKE ? OR genre LIKE ?");
$stmt->execute([$search, $search, $search]);

$products = $stmt->fetchAll();





?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoeken</title>

    <style>

        body{
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f5f5f5;
        }

        h1{
            margin: 40px;
        }

        .product{
            background-color: #B2AB9F;
            border-radius: 15px;
            padding: 20px;
            margin: 20px 40px;
            max-width: 400px;
        }

        .product h3{
            margin-top: 5px;
        }

        .product p {
            margin: 8px 0;
        }

        .product a{
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #f5f5f5;
            color: black;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }

        a{
            margin: 40px;
            display: inline-block;
            font-weight: bold;
            color: #9A8570;
            text-decoration: none;
        }

        a:hover{
            text-decoration: underline;
        }





    </style>
</head>
<body>

<h1>Zoekresultaten voor "<?= htmlspecialchars($_GET["search"]) ?>"</h1>

<?php if (empty($products)): ?>
<p>Geen producten gevonden</p>
<?php endif; ?>

<?php foreach ($products as $p): ?>
<div class="product">

<h3><?= htmlspecialchars($p["title"]) ?></h3>
<p><?= htmlspecialchars($p["artist"]) ?></p>
<p> <?= $p["price"] ?> SoundCoins</p>

<?php if (!empty($p["image"])): ?>
        <img src="<?= $p["image"] ?>" alt="Product image">
       <?php endif; ?> 

<a href="product_detail.php?id=<?= $p["id"] ?>">Bekijk details</a>

</div>
<?php endforeach; ?>

<a href="product.php">Terug naar producten</a>
    
</body>
</html>