<?php
require 'config.php';

$nom = htmlspecialchars($_POST['nom']);
$prenom  = htmlspecialchars($_POST['prenom']);
$email  = htmlspecialchars($_POST['email']);
$question  = htmlspecialchars($_POST['question']);
$date_envoi = date("Y-m-d H:i:s");
$receive =  "fansitec@gmail.com";
$subject = "Fansite - Question de $prenom $nom";
$body = "$question";
$sender= "From:fansitec@gmail.com";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if (empty($nom) || empty($prenom) || empty($question)) {
        echo "Tous les champs doivent être remplis.";
        exit();
    }


    $query = "INSERT INTO contact (email, nom, prenom, question, created_at) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("sssss", $email, $nom, $prenom, $question, $date_envoi);

        if ($stmt->execute()) {
            echo "Message envoyé avec succès!";
            header("Location: contactsuccess.html");
            exit;
        } else {
            echo "Erreur lors de l'envoi du message.";
        }

        $stmt->close();
    } else {
        echo "Erreur dans la préparation de la requête.";
    }

    if (mail($receive, $subject, $body, $sender)) {
        header("Location: contactsuccess.html");

    } else {
        echo "Erreur d'envoi";
    }

    $conn->close();
} else {
    echo "Méthode de requête invalide.";
}
?>
