<?php 

session_start();

include 'includes/nav.php';

if (!isset($_SESSION["logged_in"])){
   header("Location: login.php");
   exit;

}

include_once(__DIR__ . "/classes/database.php");
include_once(__DIR__ . "/classes/Product.php");

if (!isset($_GET["id"])){
    header("Location: product.php");
    exit;
}

$db = new Database();
$productObj = new Product($db);

$product = $productObj->find($_GET["id"]);

if(!$product){
    echo "Product niet gevonden.";
    exit;
}





?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product details</title>
</head>
<body>

<div>

<h1>Product pagina</h1>


<div>

<div>
<?php if (!empty($product["image"])): ?>
  <img src="<?= $product["image"] ?>" alt="Product picture">
<?php endif; ?>
</div>

<div>

<h2><?= htmlspecialchars($product["title"]) ?></h2>

<p><?= htmlspecialchars($product["description"]) ?></p>

<p><strong>Artiest:</strong>onbekend</p>
<p><strong>Release:</strong>onbekend</p>
<p><strong>Genre:</strong>onbekend</p>

<p>Binnen 2 werkdagen bezorgd</p>

<div>
    <button>Koop artikel</button>
</div>


</div>






</div>







</div>

<?php include 'includes/footer.php'; ?>
    
</body>
</html>