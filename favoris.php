<?php
require_once 'db.php'; // Fichier contenant la connexion à la base de données

session_start();

// Initialisation du panier
if (!isset($_SESSION['favoris'])) {
    $_SESSION['favoris'] = [];
}

// Gestion des ajouts au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) $_POST['id'];
    if (!in_array($id, $_SESSION['favoris'])) {
        $_SESSION['favoris'][] = $id;
    }
    header('Location: favoris.php');
    exit;
}

// Récupération des produits dans le panier
$produits = [];
if (!empty($_SESSION['favoris'])) {
    $ids = implode(',', array_map('intval', $_SESSION['favoris']));
    $query = $pdo->query("SELECT * FROM produits WHERE id IN ($ids)");
    $produits = $query->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vos produits favoris</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<header>
    <h1>Vos produits favoris</h1>
    <nav>
        <a href="index.php">Accueil</a>
    </nav>
</header>

<main>
    <section class="panier">
        <?php if (empty($produits)): ?>
            <p>Aucun article favoris.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($produits as $produit): ?>
                    <li>
                        <h2><?= htmlspecialchars($produit['nom']) ?></h2>
                        <p>Prix : <?= htmlspecialchars($produit['prix']) ?> €</p>
                        <div class="image-container">
                            <img src="<?= IMG_PATH . htmlspecialchars($produit['image']) ?>" alt="Chaussure">
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </section>

</main>

</body>
</html>
<?php include 'includes/footer.php'; ?>
