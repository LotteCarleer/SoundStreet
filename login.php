<?php

session_start();
include_once(__DIR__ . "/classes/database.php");

$db = new Database();
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST"){

    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

   if ($user) {

    if (password_verify($password, $user["password"])){

        $_SESSION["Logged_in"] = true;
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["Email"] = $user["email"];
        $_SESSION["wallet"] = $user["wallet"];
        $_SESSION["is_admin"] = $user["is_admin"];

        header("Location: index.php");
        exit;
    }
   }
   $error = "Foute email of wachtwoord"
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login
    </title>
</head>
<body>
    <h2>Inloggen</h2>

    <?php if (!empty($error)) : ?>
      <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label for="email">Email:</label> <br>
        <input type="email" name="email" required>
        <br><br>

        <label for="wachtwoord">Wachtwoord:</label> <br>
        <input type="password" name="password" required>

       <br><br>
        <button type="submit">Log in</button>
    </form>
</body>
</html>