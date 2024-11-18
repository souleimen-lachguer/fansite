<?php
require 'config.php';

$message = "";
$colordata = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];
    $password_hash = hash('sha256',$password);

    $credscheck = $conn->prepare("SELECT password FROM users WHERE email=?");
    $credscheck->bind_param("s", $email);
    $credscheck->execute();
    $credscheck->store_result();

    if ($credscheck->num_rows > 0) {
        $credscheck->bind_result($passwordreal);
        $credscheck->fetch();

        if ($password_hash === $password_hash) {
            $message = "Connecté avec succès...";
            $colordata = "#28a745";
            session_start();
            $_SESSION['email'] = $email;
            header("Location: /userdashboard.php");
            exit();
        } else {
            $message = "Mot de passe incorrect";
            $colordata = "#007bff";
        }
    } else {
        $message = "Identifiants incorrect";
        $colordata = "#dc3545";



    $credscheck->close();
}

$conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
<nav>
    <div class="menu"><!--div pour la partie navigation-->
        <ul>
            <li>
                <a href="#"></a>
            </li>
            <li>
                <a href="#"></a>
            </li>
            <li>
                <a href="register.php">Inscription</a>
            </li>
            <li>
                <a href="index.php">Retour au menu</a>
            </li>
            <li>
                <a href="index.php#contact">Signaler un problème</a>
            </li>
        </ul>
    </div>
<section id="register" class="register">
    <form action="login.php" method="POST">
        <h2>Connexion</h2>


        <?php if ($message != ""): ?>
            <div class="alert" style="background-color: <?= $colordata; ?>;">
                <?= $message; ?>
            </div>
        <?php endif; ?>


        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="votre.email@email.com" required>
        <br>
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" minlength="8" placeholder="Entrez votre mot de passe" required>
        <input type="submit" value="Se connecter">
    </form>
</section>
</body>

</html>
