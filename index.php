<?php
include 'includes/header.php';

// Connexion à la base de données
$dsn = 'mysql:host=localhost;dbname=site_chaussures;charset=utf8';
$user = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

// Récupération des produits
define('IMG_PATH', 'assets/images/chaussures/'); // Dossier contenant les images
$query = $pdo->query("SELECT * FROM produits");
$produits = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Chaussures</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>


<main>
    <section class="produits">
        <?php foreach ($produits as $produit): ?>
            <article class="produit">
                <img src="<?= IMG_PATH . htmlspecialchars($produit['image']) ?>" alt="Chaussure">
                <h2><?= htmlspecialchars($produit['nom']) ?></h2>
                <p><?= htmlspecialchars($produit['description']) ?></p>
                <p class="prix">Prix : <?= htmlspecialchars($produit['prix']) ?> €</p>
                <a href="produit.php?id=<?= $produit['id'] ?>" class="btn">Voir le produit</a>
            </article>
        <?php endforeach; ?>
    </section>
</main>


</body>
</html>
<?php include 'includes/footer.php'; ?>



