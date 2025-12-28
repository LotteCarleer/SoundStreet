<?php 

include_once "classes/database.php";

$db = new Database();

$stmt = $db->prepare("SELECT comments.comment, users.username, comments.created_at FROM comments JOIN users ON comments.user_id = users.id WHERE comments.product_id = ? ORDER BY comments.created_at DESC");

$stmt->execute([$_GET["product_id"]]);
$comments = $stmt->fetchAll();

foreach ($comments as $comment){
    echo "<p><strong>" . htmlspecialchars($comment["username"]) . ":</strong>" . htmlspecialchars($comment["comment"]) . "</p>";
    
}


?>