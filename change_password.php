<?php 

session_start();
include_once(__DIR__ . "/classes/database.php");

if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true ){
    header("Location: login.php");
    exit;
}

$db = new Database();
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST"){

    $current_password = $_POST["current_password"];
    $new_password = $_POST["new_password"];

    $stmt = $db->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->execute([$_SESSION["user_id"]]);
    $user = $stmt->fetch();

    if (!user){
        $error = "Gebruiker niet gevonden;";
    }
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wachtwoord wijzigen</title>
</head>
<body>

<h2>Wachtwoord wijzigen</h2>

<a href="account.php">Ga terug</a>

<form method="POST">
    <label for="current_password">Huidig wachtwoord:</label>
    <input type="password" id="current_password" name="current_password"><br><br>

    <label for="new_password">Nieuw wachtwoord:</label>
    <input type="password" id="new_password" name="new_password"><br><br>

    <button type="submit" >Wachtwoord wijzigen</button>




</form>
    
</body>
</html>