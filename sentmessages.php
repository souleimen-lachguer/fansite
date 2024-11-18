<?php
require 'config.php';

session_start();

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

$userEmail = $_SESSION['email'];


$query = "SELECT * FROM contact WHERE email = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $userEmail);
$stmt->execute();
$result = $stmt->get_result();

?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vos Messages</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
    <header>
        <h1>Vos Messages</h1>
        <nav>
            <div class="menu"><!--div pour la partie navigation-->
                <ul>
                    <li>
                        <a href="#">Mes messages au support</a>
                    </li>
                    <li>
                        <a href="userdashboard.php#contact">Contacter le support</a>
                    </li>
                    <li>
                        <a href="logout.php">Déconnexion</a>
                    </li>
                </ul>
            </div>
            <img src="./image index/burgermenu.png" alt="image burger menu" class="burgermenu" width="50px">
        </nav>
    </header>

    <main>
        <?php if ($result->num_rows > 0): ?>
            <h2>Voici les messages que vous avez envoyés :</h2>
            <table>
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Question</th>
                    <th>Date d'envoi</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nom']); ?></td>
                        <td><?php echo htmlspecialchars($row['prenom']); ?></td>
                        <td><?php echo nl2br(htmlspecialchars($row['question'])); ?></td>
                        <td><?php echo date('d-m-Y H:i', strtotime($row['created_at'])); ?></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucun message envoyé.</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>© 2024 Fansite - Souleimen - Bilal - Benjamin</p>
    </footer>
    </body>
    </html>

<?php
$stmt->close();
$conn->close();
?>