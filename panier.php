<?php
session_start();

// Initialisation du panier
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Gestion des ajouts au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) $_POST['id'];
    if (!in_array($id, $_SESSION['panier'])) {
        $_SESSION['panier'][] = $id;
    }
    header('Location: panier.php');
    exit;
}

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

// Récupération des produits dans le panier
$produits = [];
if (!empty($_SESSION['panier'])) {
    $ids = implode(',', array_map('intval', $_SESSION['panier']));
    $query = $pdo->query("SELECT * FROM produits WHERE id IN ($ids)");
    $produits = $query->fetchAll(PDO::FETCH_ASSOC);
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Panier</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<header>
    <h1>Votre Panier</h1>
    <nav>
        <a href="index.php">Accueil</a>
    </nav>
</header>

<main>
    <section class="panier">
        <?php if (empty($produits)): ?>
            <p>Votre panier est vide.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($produits as $produit): ?>
                    <li>
                        <h2><?= htmlspecialchars($produit['nom']) ?></h2>
                        <p>Prix : <?= htmlspecialchars($produit['prix']) ?> €</p>
                    </li>
                <?php endforeach; ?>
            </ul>
            <p>Total : <?= array_sum(array_column($produits, 'prix')) ?> €</p>
        <?php endif; ?>
    </section>

    <?php if (!empty($produits)): ?>
        <form action="validation.php" method="POST">
            <button type="submit" class="btn">Valider le panier</button>
        </form>
    <?php endif; ?>

</main>

</body>
</html>
<?php include 'includes/footer.php'; ?>