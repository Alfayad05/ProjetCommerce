<?php
session_start();

// Vérifie si le panier existe et contient des produits
if (empty($_SESSION['panier'])) {
    header('Location: panier.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation de la commande</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<header>
    <h1>Informations de commande</h1>
    <nav>
        <a href="index.php">Accueil</a>
    </nav>
</header>

<main>
    <form action="recapitulatif.php" method="POST" class="commande-form">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="adresse">Adresse :</label>
        <textarea id="adresse" name="adresse" required></textarea>

        <button type="submit" class="btn">Valider la commande</button>
    </form>
</main>


</body>
</html>
<?php include 'includes/footer.php'; ?>
