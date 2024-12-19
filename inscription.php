<?php
require_once 'db.php'; // Fichier contenant la connexion à la base de données
include 'includes/header.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $mot_de_passe = $_POST['mdp'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Adresse email invalide !");
    }


    // Hachage du mot de passe
    $mot_de_passe_hache = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    try {
        $sql = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe) VALUES (:nom, :prenom, :email, :mot_de_passe)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'mot_de_passe' => $mot_de_passe_hache
        ]);

        // Redirection vers la page d'accueil après inscription
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo "Cette adresse email est déjà utilisée.";
        } else {
            echo "Erreur : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="assets/css/styles.css">

</head>
<body>
<h1>Inscription</h1>
<form action="inscription.php" method="POST">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom" required><br>

    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" id="prenom" required><br>

    <label for="email">Adresse email :</label>
    <input type="email" name="email" id="email" required><br>

    <label for="mot_de_passe">Mot de passe :</label>
    <input type="password" name="mdp" id="mot_de_passe" required><br>

    <button type="submit">S'inscrire</button>
</form>
</body>
</html>
