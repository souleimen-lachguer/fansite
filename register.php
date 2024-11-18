<?php
require 'config.php';

$message = "";
$colordata = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];
    $password_hash = hash('sha256',$password);

    $mailcheck = $conn->prepare("SELECT * FROM users WHERE email=?");
    $mailcheck->bind_param("s", $email);
    $mailcheck->execute();
    $mailcheck->store_result();

    $usercheck = $conn->prepare("SELECT * FROM users WHERE username=?");
    $usercheck->bind_param("s", $username);
    $usercheck->execute();
    $usercheck->store_result();

    if ($mailcheck->num_rows > 0) {
        $message = "L'email existe déjà";
        $colordata = "#007bff";
    }
    elseif ($usercheck->num_rows > 0) {
        $message = "Le nom d'utilisateur existe déjà";
        $colordata = "#007bff";
    }
    else {
        $datainsert = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $datainsert->bind_param("sss", $username, $email, $password_hash);
        if ($datainsert->execute()) {
            $message = "Le compte a bien été créé";
            $colordata = "#28a745";
            header("Location: signupsuccess.html");
            exit;
        } else {
            $message = "Erreur inconnue";
            $colordata = "#dc3545";
        }
        $datainsert->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
<section id="register" class="register">
    <header><!--partie pour l'entête du site-->
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
                        <a href="login.php">Connexion</a>
                    </li>
                    <li>
                        <a href="index.php">Retour au menu</a>
                    </li>
                    <li>
                        <a href="index.php#contact">Signaler un problème</a>
                    </li>
                </ul>
            </div>
    <form action="register.php" method="POST">
        <h2>Inscription</h2>

        <?php if ($message != ""): ?>
            <div class="alert" style="background-color: <?= $colordata; ?>;">
                <?= $message; ?>
            </div>
        <?php endif; ?>


        <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username" placeholder="Entrez un nom d'utilisateur" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="votre.email@email.com" required>
        <br>
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" minlength="8" placeholder="Entrez votre mot de passe" required>
        <input type="submit" value="S'inscrire">
    </form>
</section>
</body>

</html>
