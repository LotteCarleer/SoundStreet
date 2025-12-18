<?php

session_start();
include_once(__DIR__ . "/classes/database.php");

$db = new Database();
$error = "";
$succes = "";

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if ($username === "" || $email === "" || $password === ""){
          
        $error = "alle velden zijn verplicht.";
    } elseif ($password !== $password_confirm) {
        $error = "Wachtwoorden komen niet overeen.";
    }
    
    else {

        $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user){
            $error = "Dit e-mailadres bestaat al.";
        }else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $db->prepare("INSERT INTO users (username, email, password, wallet, is_admin) VALUES (?, ?, ?, 1000, 0)");
            $stmt->execute([$username, $email, $hashed]);

            $succes = "Account aangemaakt! Je kan nu inloggen.";
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
</head>
<body>

<h2>Registreren</h2>

<?php if ($error != ""): ?>
    <p style="color:red;" ><?= $error ?></p>
<?php endif; ?>    

<?php if ($success != ""): ?>
    <p style="color:green;" ><?= $succes ?></p>
<?php endif; ?>    



<form method="POST">
    <input type="text" name="username" placeholder="Gebruikersnaam"><br>
    <input type="email" name="email" placeholder="Email" ><br>
    <input type="password" name="password" placeholder="Wachtwoord"><br>
    <button type="submit">Registreren</button>
</form>

<p>Heb je al een account? <a href="login.php">Log in</a></p>
</body>
</html>