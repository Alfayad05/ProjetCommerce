<?php
// index.php
session_start();
require_once 'db.php'; // Connexion à la base de données
include 'includes/header.php';

?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accueil - Choisissez une catégorie</title>
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>
    <body>

    <main>
        <h2>Choisissez une catégorie :</h2>
        <div class="categories">
            <a href="categorie.php?marque=Nike" class="categorie nike">Nike</a>
            <a href="categorie.php?marque=Adidas" class="categorie adidas">Adidas</a>
            <a href="categorie.php?marque=New Balance" class="categorie newbalance">New Balance</a>
            <a href="categorie.php?marque=Asics" class="categorie asics">Asics</a>
        </div>
    </main>
    </body>
    </html>
<?php include 'includes/footer.php'; ?>