<?php
session_start();
require_once 'db.php'; // Connexion à la base de données

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id'])) {
    header("Location: connexion.php");
    exit();
}

// Récupère l'ID de l'utilisateur et du produit
$utilisateur_id = $_SESSION['utilisateur_id'];
$produit_id = (int) $_POST['produit_id'];

// Vérifie si le produit est déjà dans les favoris
$query = $pdo->prepare("SELECT * FROM favoris WHERE utilisateur_id = :utilisateur_id AND produit_id = :produit_id");
$query->execute([
    'utilisateur_id' => $utilisateur_id,
    'produit_id' => $produit_id
]);

if ($query->rowCount() === 0) {
    // Ajoute le produit aux favoris
    $insert_query = $pdo->prepare("INSERT INTO favoris (utilisateur_id, produit_id) VALUES (:utilisateur_id, :produit_id)");
    $insert_query->execute([
        'utilisateur_id' => $utilisateur_id,
        'produit_id' => $produit_id
    ]);
    echo "Produit ajouté aux favoris.";
} else {
    echo "Ce produit est déjà dans vos favoris.";
}

header("Location: index.php");
exit();
?>
