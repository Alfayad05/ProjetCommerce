<?php
session_start();
?>
<header>
    <h1>Bienvenue sur notre boutique de chaussures</h1>
    <nav>
        <a href="index.php">Accueil</a>
        <a href="panier.php">Panier</a>
        <a href="favoris.php">Favoris</a>
        <?php if (isset($_SESSION['utilisateur_id'])): ?>
            <a href="deconnexion.php">Déconnexion</a>
        <?php else: ?>
            <a href="connexion.php">Se Connecter</a>
        <?php endif; ?>
    </nav>
</header>