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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        main {
            text-align: center;
            padding: 20px;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
        }

        .categories {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .categorie {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 200px;
            border-radius: 15px;
            overflow: hidden;
            text-decoration: none;
            font-size: 1.5rem;
            color: #fff;
            text-transform: uppercase;
            font-weight: bold;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .categorie:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .categorie.nike {
            background: url('assets/images/chaussures/logonike.jpg') center/cover no-repeat;
        }

        .categorie.adidas {
            background: url('assets/images/chaussures/adidaslogo.jpg') center/cover no-repeat;
        }

        .categorie.newbalance {
            background: url('assets/images/chaussures/nblogo.jpg') center/cover no-repeat;
        }

        .categorie.asics {
            background: url('assets/images/chaussures/AsicsLogo.jpg') center/cover no-repeat;
        }

        /* Overlay effect for better readability */
        .categorie::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }

        .categorie span {
            position: relative;
            z-index: 2;
        }

        footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.9rem;
            color: #666;
        }
    </style>
</head>
<body>
<main>
    <h2>Choisissez une catégorie :</h2>
    <div class="categories">
        <a href="categorie.php?marque=Nike" class="categorie nike">
            <span>Nike</span>
        </a>
        <a href="categorie.php?marque=Adidas" class="categorie adidas">
            <span>Adidas</span>
        </a>
        <a href="categorie.php?marque=New Balance" class="categorie newbalance">
            <span>New Balance</span>
        </a>
        <a href="categorie.php?marque=Asics" class="categorie asics">
            <span>Asics</span>
        </a>
    </div>
</main>
</body>
</html>
<?php include 'includes/footer.php'; ?>
