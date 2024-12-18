<?php
session_start();

// Vérifie si le panier existe
if (!empty($_SESSION['panier'])) {
    unset($_SESSION['panier']); // Vide le panier
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande validée</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<header>
    <h1>Commande validée avec succès</h1>
</header>

<main>
    <p>Merci pour votre commande ! Votre commande a été validée avec succès.</p>
    <a href="index.php" class="btn">Retour à l'accueil</a>
</main>


</body>
</html>
<?php include 'includes/footer.php'; ?>
