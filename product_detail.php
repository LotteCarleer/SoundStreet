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

$bought = false;

$stmt = $db->prepare("SELECT id FROM orders WHERE user_id = ?");
$stmt->execute([$_SESSION["user_id"]]);
$orders = $stmt->fetchAll();

foreach ($orders as $order){
    $stmt = $db->prepare("SELECT id FROM order_items WHERE order_id = ? AND product_id = ?");
    $stmt->execute([$order["id"], $product["id"]]);

    if ($stmt->fetch()){
        $bought = true;
        break;
    }
}

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

<style>

body{
    font-family: Arial, Helvetica, sans-serif;  
}

.products{
   
   margin: 60px ;
}

.product-container{
    display: flex;
    gap: 60px;
    align-items: flex-start;
}

.product-image{
    border: 3px solid #9A8570;
    border-radius: 10px;
    padding: 20px;
}

.product-image img{
    width: 350px;
    display: block;
}

.product-info h2{
    margin-top: 0;
}

.product-info p {
    line-height: 1.5;
}

.koop{
    margin-top: 15px;
}

.koop button {
    padding: 10px 20px;
    background-color: #D1C2A7;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
}

.terug{
    text-decoration: none;
    font-weight: bold;
    color: white;
    font-size: 20px;
    background-color: #9A8570;
    padding: 10px 20px;
    border-radius: 10px;
    cursor: pointer;
    
}

@media (max-width: 768px){
    .product-container{
        flex-direction: column;
        align-items: center;
    }

    .product-image img {
        width: 100%;
        max-width: 300px;
    }

    .product-info{
        text-align: center;
    }
}

</style>
</head>
<body>

<div class="products">

<a class="terug" href="product.php">Ga terug</a> <br><br>

<h1>Product pagina</h1>


<div class="product-container">

<div class= "product-image">
<?php if (!empty($product["image"])): ?>
  <img src="<?= $product["image"] ?>" alt="Product picture">
<?php endif; ?>
</div>

<div class="product-info">

<h2><?= htmlspecialchars($product["title"]) ?></h2>

<p><?= htmlspecialchars($product["description"]) ?></p>

<?php if(!empty($product["artist"])): ?>
<p><strong>Artiest:</strong> <?=  htmlspecialchars($product["artist"])?></p>
<?php endif; ?>

<?php if(!empty($product["release_year"])): ?>
<p><strong>Release:</strong> <?=  $product["release_year"] ?></p>
<?php endif; ?>

<?php if(!empty($product["genre"])): ?>
<p><strong>Genre:</strong><?= htmlspecialchars($product["genre"])?></p>
<?php endif; ?>

<h3><strong>Prijs: </strong><?= $product["price"] ?> SoundCoins</h3>

<p>Binnen 2 werkdagen bezorgd</p>

 
<form action="cart.php" method="POST" class="koop">
    <input type="hidden" name="product_id" value="<?= $product['id'] ?>" >
    <button type="submit">Voeg toe aan winkelwagen</button>
</form>


</div>

</div>

</div>

<h3>Beoordelingen</h3>

<div id="comments">
    <textarea name="CommentText" class="commentText" placeholder="Schrijf een reactie"></textarea><br>
    <button id="sendComment" >Plaats reactie</button>

    <p>Je kan alleen reageren als je dit product gekocht hebt!</p>

</div>

<?php include 'includes/footer.php'; ?>

<script>

    function loadComments(){
        fetch("load_comments.php?product_id=<?= $product['id'] ?>")
        .then(function(response) {
            return response.text();

        })
        .then(function(html) {

            document.getElementById("comments").innerHTML = html;
        });
    }

    var button = document.getElementById("sendComment");

    if (button){
        button.addEventListener("click", function (){

            var text = document.getElementById("commentText").value;

            if (text == ""){
                return;
            } 

        

        });
    }


</script>
    
</body>
</html>