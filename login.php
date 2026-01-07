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

        $_SESSION["logged_in"] = true;
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["email"] = $user["email"];
        $_SESSION["wallet"] = $user["wallet"];
        $_SESSION["is_admin"] = $user["is_admin"];

        header("Location: index.php");
        exit;
    }
   }
   $error = "Foute email of wachtwoord";
}


?>


<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login
    </title>

    <style>
       
       body{
        font-family: Arial, Helvetica, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #D1C2A7;
        min-height: 100vh;
       }

       .login{
        background: #FAFAF9;
        border-radius: 20px;
        padding: 30px;
       }

       .login input{
        width: 100%;
        margin-top: 5px;
       }

       .login button{
        width: 100px;
        margin-top: 10px;
        margin-bottom: 10px;
        background-color: #B2AB9F;
        color: black;
        border: none;
        border-radius: 5px;
        padding-top: 5px;
        padding-bottom: 5px;
        font-size: 15px;font-weight: bold;
         }

         .login form a{
            color: #9A8570;
            font-weight: bold;
         }

    </style>

</head>
<body>

<div class="login">
    <h2>Inloggen</h2>

    <?php if ($error != "" ): ?>
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
        <p>Heb je nog geen account? <a href="register.php">registreer hier</a></p>
    </form>
</div>
</body>
</html>