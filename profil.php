<?php
session_start();
require_once 'db.php'; // Connexion à la base de données

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id'])) {
    header("Location: connexion.php");
    exit();
}

// Récupération des informations de l'utilisateur
$id_utilisateur = $_SESSION['utilisateur_id'];
$query = $pdo->prepare("SELECT nom, prenom, email FROM utilisateurs WHERE id = :id");
$query->execute(['id' => $id_utilisateur]);
$utilisateur = $query->fetch(PDO::FETCH_ASSOC);

// Traitement pour changer le mot de passe
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['modifier_mot_de_passe'])) {
        $ancien_mot_de_passe = $_POST['ancien_mot_de_passe'];
        $nouveau_mot_de_passe = $_POST['nouveau_mot_de_passe'];
        $confirmer_mot_de_passe = $_POST['confirmer_mot_de_passe'];

        // Vérifie si l'ancien mot de passe est correct
        $query = $pdo->prepare("SELECT mot_de_passe FROM utilisateurs WHERE id = :id");
        $query->execute(['id' => $id_utilisateur]);
        $resultat = $query->fetch(PDO::FETCH_ASSOC);

        if (password_verify($ancien_mot_de_passe, $resultat['mot_de_passe'])) {
            if ($nouveau_mot_de_passe === $confirmer_mot_de_passe) {
                // Hash du nouveau mot de passe
                $nouveau_mot_de_passe_hash = password_hash($nouveau_mot_de_passe, PASSWORD_DEFAULT);

                // Mise à jour du mot de passe dans la base
                $update_query = $pdo->prepare("UPDATE utilisateurs SET mot_de_passe = :mot_de_passe WHERE id = :id");
                $update_query->execute([
                    'mot_de_passe' => $nouveau_mot_de_passe_hash,
                    'id' => $id_utilisateur
                ]);

                echo "Mot de passe modifié avec succès !";
            } else {
                echo "Les nouveaux mots de passe ne correspondent pas.";
            }
        } else {
            echo "L'ancien mot de passe est incorrect.";
        }
    } elseif (isset($_POST['supprimer_compte'])) {
        // Suppression du compte utilisateur
        $delete_query = $pdo->prepare("DELETE FROM utilisateurs WHERE id = :id");
        $delete_query->execute(['id' => $id_utilisateur]);

        // Déconnexion après suppression
        session_destroy();
        header("Location: index.php?message=compte_supprime");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <script>
        function confirmerSuppression() {
            return confirm("Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.");
        }
    </script>
</head>
<body>
<h1>Profil de <?php echo htmlspecialchars($utilisateur['prenom'] . ' ' . $utilisateur['nom']); ?></h1>
<p><strong>Nom :</strong> <?php echo htmlspecialchars($utilisateur['nom']); ?></p>
<p><strong>Prénom :</strong> <?php echo htmlspecialchars($utilisateur['prenom']); ?></p>
<p><strong>Email :</strong> <?php echo htmlspecialchars($utilisateur['email']); ?></p>

<h2>Modifier votre mot de passe</h2>
<form method="post">
    <input type="hidden" name="modifier_mot_de_passe" value="1">
    <label for="ancien_mot_de_passe">Ancien mot de passe :</label>
    <input type="password" name="ancien_mot_de_passe" id="ancien_mot_de_passe" required>
    <br>

    <label for="nouveau_mot_de_passe">Nouveau mot de passe :</label>
    <input type="password" name="nouveau_mot_de_passe" id="nouveau_mot_de_passe" required>
    <br>

    <label for="confirmer_mot_de_passe">Confirmer le nouveau mot de passe :</label>
    <input type="password" name="confirmer_mot_de_passe" id="confirmer_mot_de_passe" required>
    <br>

    <button type="submit">Modifier le mot de passe</button>
</form>

<h2>Supprimer votre compte</h2>
<form method="post" onsubmit="return confirmerSuppression();">
    <input type="hidden" name="supprimer_compte" value="1">
    <button type="submit" style="background-color: red; color: white;">Supprimer mon compte</button>
</form>

<a href="deconnexion.php">Se déconnecter</a>
</body>
</html>
