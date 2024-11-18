<?php
session_start();
$isLoggedIn = isset($_SESSION['email']);
if (!$isLoggedIn) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="index.css"><!--pour lier au css-->
</head>
<body>
<header><!--partie pour l'entête du site-->
    <h1>Mon dashboard</h1>
    <nav>
        <div class="menu"><!--div pour la partie navigation-->
            <ul>
                <li>
                    <a href="sentmessages.php">Mes messages au support</a>
                </li>
                <li>
                    <a href="#contact">Contacter le support</a>
                </li>
                <li>
                    <a href="logout.php">Déconnexion</a>
                </li>
            </ul>
        </div>
        <img src="./image index/burgermenu.png" alt="image burger menu" class="burgermenu" width="50px">
    </nav>
</header>
<main><!--partie ou il se trouve le contenu principal-->
    <section id="patmahomes" class="patmahomes"><!--partie sur Patrick Mahomes-->
        <h2>Patrick Mahomes</h2>
        <img src="./image index/imagepat.jpg" alt="Photo Patrick Mahomes" width="150px">
        <p>Patrick Mahomes, l'un des quarterbacks les plus talentueux de sa génération, est reconnu pour son jeu exceptionnel et ses performances impressionnantes sur le terrain. Découvrez l’histoire de sa carrière et ses réalisations en cliquant sur le lien pour en savoir plus.</p>
        <a href="./fansite1.html" target="_blank">&#10148; PatrickMahomes</a>
    </section>
    <section id="wakedxy" class="wakedxy"><!--partie sur celebrite2-->
        <h2>Waked XY</h2>
        <img src="./image index/wakedxy.jpg" alt="Photo Wakedxy" width="150px">
        <p>Wakedxy est un vidéaste passionné par l'informatique et plus précisemment le hacking, offrant des vidéos divertissantes et des analyses approfondies de différents univers. Pour en savoir plus, cliquez sur le lien ci-dessous.</p>
        <a href="./fansite2.html" target="_blank">&#10148; WakedXY</a>
    </section>
    <section id="faker" class="faker"><!--partie sur celebrite3-->
        <h2>Faker</h2>
        <img src="./image index/Faker_2020_interview.jpg" alt="Photo faker" width="150px">
        <p>Faker, de son vrai nom Sang-hyeok Lee, est un joueur professionnel de League of Legends, considéré comme l'un des meilleurs d monde, avec plusieurs titres mondiaux à son actif. Pour en savoir plus, cliquez sur le lien ci-dessous.</p>
        <a href="./fansite3.html" target="_blank">&#10148; Faker</a>
    </section>
</main>
<footer id="contact" class="contact"><!--partie pour le pied du site (bas du site)-->
    <h2>Contactez-nous</h2>
    <section><!--partie pour le formulaire de contact-->
        <form action="contact.php" method="POST">
            <label for="Nom">Nom:</label>
            <input type="text" id="Nom" name="nom" placeholder="Entrez votre nom">
            <label for="Prenom">Prénom:</label>
            <input type="text" id="Prenom" name="prenom" placeholder="Entrez votre prénom">
            <br>
            <label for="Email">Email:</label>
            <input type="text" id="Email" name="email" placeholder="votre.email@email.com">
            <br>
            <label for="Question">Question:</label>
            <textarea id="Question" name="question" placeholder="Poser-nous votre Question"></textarea>
            <input type="submit">
        </form>
    </section>
</footer>
</body>
<script>
    const menuHamburger = document.querySelector(".burgermenu")
    const navLinks = document.querySelector(".menu ul")
    const navItems = document.querySelectorAll(".menu ul li a");


    menuHamburger.addEventListener('click',()=>{
        navLinks.classList.toggle('mobile-menu')
    })
    navItems.forEach(item => {
        item.addEventListener('click', () => {
            navLinks.classList.remove('mobile-menu');
        });
    });
</script><!--partie en js pour le burger menu-->
<footer>
    <h2>© 2024 Fansite - Souleimen - Bilal - Benjamin</h2>
</footer>
</html>


