<?php
session_start();
require_once 'db.php'; // Fichier contenant la connexion à la base de données
include 'includes/header.php';


// Vérification de l'ID du produit
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Produit non trouvé.');
}

define('IMG_PATH', 'assets/images/chaussures/'); // Dossier contenant les images
$id = (int) $_GET['id'];
$query = $pdo->prepare("SELECT * FROM produits WHERE id = :id");
$query->execute(['id' => $id]);
$produit = $query->fetch(PDO::FETCH_ASSOC);

if (!$produit) {
    die('Produit non trouvé.');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($produit['nom']) ?></title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

<main>
    <section class="produit-details">
        <div class="image-container">
        <img src="<?= IMG_PATH . htmlspecialchars($produit['image']) ?>" alt="Chaussure">
        </div>
        <h2><?= htmlspecialchars($produit['nom']) ?></h2>
        <p><?= htmlspecialchars($produit['description']) ?></p>
        <p class="prix">Prix : <?= htmlspecialchars($produit['prix']) ?> €</p>
        <?php if (isset($_SESSION['utilisateur_id'])): ?>
            <form action="ajouter_favori.php" method="post">
                <input type="hidden" name="produit_id" value="<?= $produit['id'] ?>">
                <button type="submit" class="btn-favori">Ajouter aux favoris</button>
            </form>
        <?php else: ?>
            <p><a href="connexion.php">Connectez-vous</a> pour ajouter ce produit à vos favoris.</p>
        <?php endif; ?>

        <form action="panier.php" method="POST">
            <input type="hidden" name="id" value="<?= $produit['id'] ?>">
            <button type="submit" class="btn">Ajouter au panier</button>
        </form>
    </section>
</main>
</body>
</html>
<?php include 'includes/footer.php'; ?>