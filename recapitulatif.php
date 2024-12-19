<?php
require_once 'db.php'; // Fichier contenant la connexion à la base de données

session_start();

// Vérifie si le formulaire est rempli
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_SESSION['panier'])) {
    header('Location: index.php');
    exit;
}

// Récupération des données utilisateur
$nom = htmlspecialchars($_POST['nom']);
$email = htmlspecialchars($_POST['email']);
$adresse = nl2br(htmlspecialchars($_POST['adresse']));

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
    <title>Récapitulatif de la commande</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<header>
    <h1>Récapitulatif de votre commande</h1>
</header>

<main>
    <section>
        <h2>Vos informations</h2>
        <p><strong>Nom :</strong> <?= $nom ?></p>
        <p><strong>Email :</strong> <?= $email ?></p>
        <p><strong>Adresse :</strong><br><?= $adresse ?></p>
    </section>

    <section>
        <h2>Produits commandés</h2>
        <ul>
            <?php $total = 0; ?>
            <?php foreach ($produits as $produit): ?>
                <li>
                    <?= htmlspecialchars($produit['nom']) ?> -
                    <?= htmlspecialchars($produit['prix']) ?> €
                </li>
                <?php $total += $produit['prix']; ?>
            <?php endforeach; ?>
        </ul>
        <p><strong>Total :</strong> <?= $total ?> €</p>
    </section>

    <form action="confirmation.php" method="POST">
        <button type="submit" class="btn">Confirmer la commande</button>
    </form>
</main>


</body>
</html>
<?php include 'includes/footer.php'; ?>
