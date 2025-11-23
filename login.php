<?php

session_start();

$correct_email = "Lotte@SoundStreet.com";
$correct_password = "12345";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST"){

    $email = $_POST["email"];
    $password = $_POST["password"];

    if ($email === $correct_email && $password === $correct_password){
        $_SESSION["logged_in"] = true;
        header("Location: index.php");
        exit;
    } else {
        $error = "Foutieve login.";
    }
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