<?php
session_start();
require_once 'db.php'; // Connexion à la base de données
define('IMG_PATH', 'assets/images/chaussures/'); // Dossier contenant les images
include 'includes/header.php';


// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id'])) {
    header("Location: connexion.php");
    exit();
}

// Récupère les favoris de l'utilisateur
$utilisateur_id = $_SESSION['utilisateur_id'];
$query = $pdo->prepare("
    SELECT p.id, p.nom, p.description, p.prix, p.image
    FROM favoris f
    JOIN produits p ON f.produit_id = p.id
    WHERE f.utilisateur_id = :utilisateur_id
");
$query->execute(['utilisateur_id' => $utilisateur_id]);
$favoris = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Favoris</title>
    <link rel="stylesheet" href="assets/css/styles.css">

</head>
<body>
<h1>Vos Favoris</h1>
<?php if (empty($favoris)): ?>
    <p>Vous n'avez aucun favori pour le moment.</p>
<?php else: ?>
    <ul>
        <?php foreach ($favoris as $produit): ?>
        <section class="produit-details">
            <div class="image-container">
                <img src="<?= IMG_PATH . htmlspecialchars($produit['image']) ?>" alt="Chaussure">
            </div>
            <h2><?= htmlspecialchars($produit['nom']) ?></h2>
            <p><?= htmlspecialchars($produit['description']) ?></p>
            <p class="prix">Prix : <?= htmlspecialchars($produit['prix']) ?> €</p>
        </section>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<a href="index.php">Retour à l'accueil</a>
</body>
</html>
