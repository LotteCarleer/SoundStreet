<?php

session_start();
include_once(__DIR__ . "/classes/database.php");

$db = new Database();
$error = "";


if($_SERVER["REQUEST_METHOD"] === "POST"){

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if ($username === "" || $email === "" || $password === ""){
          
        $error = "alle velden zijn verplicht.";
    } else {

        $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user){
            $error = "Dit e-mailadres bestaat al.";
        }else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $db->prepare("INSERT INTO users (username, email, password, wallet, is_admin) VALUES (?, ?, ?, 1000, 0)");
            $stmt->execute([$username, $email, $hashed]);

            $_SESSION["logged_in"] = true;
            $_SESSION["username"] = $username;
            $_SESSION["email"] = $email;
            $_SESSION["wallet"] = 100;
            $_SESSION["is_admin"] = 0;

            header("Location: index.php");
            exit;
        }
    }

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>

    <style>
       
       body{
        font-family: Arial, Helvetica, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #D1C2A7;
        min-height: 100vh;
       }

       .registreren{
        background: #FAFAF9;
        border-radius: 20px;
        padding: 30px;
       }

       .registreren input{
        width: 100%;
        margin-top: 5px;
       }

       .registreren button{
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

         .registreren a{
            color: #9A8570;
            font-weight: bold;
         }

    </style>

</head>
<body>

<div class="registreren">
<h2>Registreren</h2>

<?php if ($error != ""): ?>
    <p style="color:red;" ><?= $error ?></p>
<?php endif; ?>    

   



<form method="POST">
<label for="username">Username:</label>
<input type="text" name="username" ><br><br>

<label for="email">Email:</label>
<input type="email" name="email" ><br><br>

<label for="password">Password:</label>
<input type="password" name="password" ><br><br>
    
<button type="submit">Registreren</button>
</form>

<p>Heb je al een account? <a href="login.php">Log in</a></p>
</div>
</body>
</html>