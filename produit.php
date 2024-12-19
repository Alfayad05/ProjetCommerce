<?php
require_once 'db.php'; // Fichier contenant la connexion à la base de données

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
<header>
    <h1><?= htmlspecialchars($produit['nom']) ?></h1>
    <nav>
        <a href="index.php">Accueil</a>
        <a href="panier.php">Panier</a>
    </nav>
</header>

<main>
    <section class="produit-details">
        <div class="image-container">
        <img src="<?= IMG_PATH . htmlspecialchars($produit['image']) ?>" alt="Chaussure">
        </div>
        <h2><?= htmlspecialchars($produit['nom']) ?></h2>
        <p><?= htmlspecialchars($produit['description']) ?></p>
        <p class="prix">Prix : <?= htmlspecialchars($produit['prix']) ?> €</p>
        <form action="favoris.php" method="POST">
            <input type="hidden" name="id" value="<?= $produit['id'] ?>">
            <button type="submit" class="btn">Mettre en favoris</button>
        </form>
        <form action="panier.php" method="POST">
            <input type="hidden" name="id" value="<?= $produit['id'] ?>">
            <button type="submit" class="btn">Ajouter au panier</button>
        </form>
    </section>
</main>
</body>
</html>
<?php include 'includes/footer.php'; ?>