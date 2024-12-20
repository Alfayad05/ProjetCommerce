<?php
session_start();
require_once 'db.php'; // Connexion à la base de données
define('IMG_PATH', 'assets/images/chaussures/'); // Dossier contenant les images

// Vérifie que la marque est passée dans l'URL
if (!isset($_GET['marque'])) {
    header("Location: index.php");
    exit();
}

$marque = htmlspecialchars($_GET['marque']);

// Récupère les produits de la marque
$query = $pdo->prepare("SELECT * FROM produits WHERE marque = :marque");
$query->execute(['marque' => $marque]);
$produits = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits - <?= $marque ?></title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<header>
    <h1>Produits - <?= $marque ?></h1>
    <nav>
        <a href="index.php">Accueil</a>
        <?php if (isset($_SESSION['utilisateur_id'])): ?>
            <a href="favoris.php">Mes Favoris</a>
            <a href="profil.php">Profil</a>
            <a href="deconnexion.php">Déconnexion</a>
        <?php else: ?>
            <a href="connexion.php">Connexion</a>
        <?php endif; ?>
    </nav>
</header>

<main>
    <section class="produits">
        <?php if (empty($produits)): ?>
            <p>Aucun produit trouvé pour cette marque.</p>
        <?php else: ?>
            <?php foreach ($produits as $produit): ?>
                <article class="produit">
                    <img src="<?= IMG_PATH . htmlspecialchars($produit['image']) ?>" alt="<?= htmlspecialchars($produit['nom']) ?>">
                    <h2><?= htmlspecialchars($produit['nom']) ?></h2>
                    <p><?= htmlspecialchars($produit['description']) ?></p>
                    <p class="prix">Prix : <?= htmlspecialchars($produit['prix']) ?> €</p>
                    <form action="panier.php" method="POST">
                        <input type="hidden" name="id" value="<?= $produit['id'] ?>">
                        <a href="produit.php?id=<?= $produit['id'] ?>" class="btn">Voir le produit</a>
                        <button type="submit" class="btn">Ajouter au panier</button>
                    </form>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
</main>

<footer>
    <p>&copy; 2024 Boutique de chaussures</p>
</footer>
</body>
</html>
