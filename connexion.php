<?php
require_once 'db.php'; // Fichier contenant la connexion à la base de données
include 'includes/header.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $mot_de_passe = $_POST['mdp'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Adresse email invalide !");
    }

    try {
        $sql = "SELECT * FROM utilisateurs WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $utilisateur = $stmt->fetch();

        if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
            // Connexion réussie
            $_SESSION['utilisateur_id'] = $utilisateur['id'];
            $_SESSION['utilisateur_nom'] = $utilisateur['nom'];
            $_SESSION['utilisateur_prenom'] = $utilisateur['prenom'];

            // Redirection vers la page d'accueil
            header("Location: index.php");
            exit();
        } else {
            echo "Adresse email ou mot de passe incorrect.";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

print("test");
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="assets/css/styles.css">

</head>
<body>
<div class="form-container">
    <h2>Connexion</h2>
    <form action="connexion.php" method="post">
        <input type="email" name="email" placeholder="Adresse email" required>
        <input type="password" name="mdp" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
    </form>
    <div class="signup-section">
        <span>Vous n'avez pas encore de compte ?</span>
        <a href="inscription.php">S'inscrire</a>
    </div>
</div>
</body>
</html>
