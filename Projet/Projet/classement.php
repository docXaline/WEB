<?php
// Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Requête pour récupérer les données des joueurs et leurs scores
$query = "
    SELECT 
        Joueur.nom AS joueur_nom,
        Joueur.prenom AS joueur_prenom,
        Difficulté.niveau,
        Difficulté.temps_react,
        Difficulté.difficulte
    FROM Joueur
    JOIN Difficulté ON Joueur.id_Joueur = Difficulté.id_Joueur
    ORDER BY Difficulté.niveau DESC, CAST(Difficulté.temps_react AS UNSIGNED) ASC
";

try {
    $stmt = $pdo->query($query);

    // Vérifier si des résultats ont été trouvés
    if ($stmt->rowCount() > 0) {
        echo "<h1>Classement</h1>";
        echo "<table border='1'>";
        echo "<tr><th>Position</th><th>Nom</th><th>Prénom</th><th>Niveau</th><th>Temps de Réaction</th><th>Difficulté</th></tr>";

        $position = 1;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $position++ . "</td>";
            echo "<td>" . htmlspecialchars($row['joueur_nom']) . "</td>";
            echo "<td>" . htmlspecialchars($row['joueur_prenom']) . "</td>";
            echo "<td>" . htmlspecialchars($row['niveau']) . "</td>";
            echo "<td>" . htmlspecialchars($row['temps_react']) . "</td>";
            echo "<td>" . htmlspecialchars($row['difficulte']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Aucun enregistrement trouvé.";
    }
} catch (PDOException $e) {
    die("Erreur lors de l'exécution de la requête : " . $e->getMessage());
}

// Fermer la connexion
$pdo = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classement</title>
    <link rel="stylesheet" href="css/classement.css"> <!-- Lien vers le fichier CSS pour le style -->
</head>
<body>
    <button onclick="window.location.href='log.php'" id="logout-button" style="padding: 10px 20px; font-size: 16px; cursor: pointer; border: solid, rebeccapurple; color: #white;">
        Se déconnecter
    </button>
</body>
</html>