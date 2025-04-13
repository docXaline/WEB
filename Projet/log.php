<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=projetweb', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['nom']) && !empty($_POST['prenom'])) {
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);

            // Insertion des données dans la base de données
            $stmt = $pdo->prepare("INSERT INTO joueur (nom, prenom) VALUES (:nom, :prenom)");
            $stmt->execute(['nom' => $nom, 'prenom' => $prenom]);

            // Redirection vers pagedebut.php avec le nom dans l'URL
            header("Location: pagedebut.php?nom=" . urlencode($nom));
            exit;
        } else {
            echo "Veuillez remplir tous les champs.";
        }
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    exit;
}
?>
<?php
try {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=localhost;dbname=projetweb', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Affichage des données GET pour débogage
    var_dump($_GET);

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['nom'], $_GET['difficulty'], $_GET['reactionTime'], $_GET['gamelevel'])) {
            // Récupération des données passées en GET
            $nom = htmlspecialchars($_GET['nom']);
            $difficulty = htmlspecialchars($_GET['difficulty']);
            $reactionTime = strval(htmlspecialchars($_GET['reactionTime'])); // Conversion en chaîne
            $gamelevel = htmlspecialchars($_GET['gamelevel']);

            // Récupération de l'ID du joueur à partir de son nom d'utilisateur
            $stmt = $pdo->prepare("SELECT id_Joueur FROM Joueur WHERE nom = :nom");
            $stmt->execute(['nom' => $nom]);
            $joueur = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($joueur) {
                $id_joueur = $joueur['id_Joueur'];

                // Insertion des données dans la table Difficulté
                try {
                    $stmt = $pdo->prepare("INSERT INTO Difficulté (niveau, temps_react, difficulte, id_Joueur) 
                                           VALUES (:niveau, :temps_react, :difficulte, :id_Joueur)");
                    $stmt->execute([
                        'niveau' => $gamelevel,
                        'temps_react' => $reactionTime,
                        'difficulte' => $difficulty,
                        'id_Joueur' => $id_joueur
                    ]);
                    echo "Score enregistré avec succès.";
                    header("Location: log.php"); // Redirection vers la page d'accueil
                } catch (PDOException $e) {
                    echo "Erreur lors de l'insertion : " . $e->getMessage();
                }
            } else {
                echo "Joueur introuvable : " . $nom;
            }
        } elseif(isset($_GET['nom'])) {
            echo "Nom d'utilisateur manquant.";
            $nom = htmlspecialchars($_GET['nom']);
            echo "<input type='hidden' id='nom' value='$nom'>"; // Ajout d'un champ caché pour le nom
            
        }
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMON</title>
    <link rel="stylesheet" href="pagedebut.css"> <!-- Lien vers la feuille de style CSS -->
</head>
<body>
    <header>
            <h1>Bienvenue dans le jeu de Simon</h1> <!-- Titre principal de la page -->
    </header>
    <h2>Veuillez entrer votre nom et prénom pour commencer :</h2>
            <form method="POST" action="log.php" id="user-form">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>
                <br><br>
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required>
                <br><br>
                <button type="submit">Valider</button> <!-- Bouton pour soumettre le formulaire -->
            </form>
        
    <button onclick="window.location.href='classement.php'" id="show-ranking" style="padding: 10px 20px; font-size: 16px; cursor: pointer;">
        Voir le classement
    </button>
</body>
<script>src="logout.js"</script>
</html>
