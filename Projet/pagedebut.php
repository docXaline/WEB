<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeux de Simon</title>
    <link rel="stylesheet" href="pagedebut.css"> <!-- Lien vers le fichier CSS pour le style -->
</head>
<body>
    <header>
        <h1>Bienvenue dans le jeu de Simon</h1> <!-- Titre principal de la page -->
    </header>

    <!-- Formulaire pour saisir le nom et le prénom -->
    <div id="form-container">
        <h2>Veuillez entrer votre nom et prénom pour commencer :</h2>
        <form method="POST" action="pagedebut.php" id="user-form"> <!-- Formulaire envoyé en méthode POST -->
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="pseudo" required> <!-- Champ pour le nom -->
            <br><br>
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required> <!-- Champ pour le prénom -->
            <br><br>
            <button type="submit">Valider</button> <!-- Bouton pour soumettre le formulaire -->
        </form>
    </div>

    <!-- Contenu principal de la page (choix des jeux) -->
    <div id="main-content" style="display:none;"> <!-- Masqué par défaut -->
        <div>
            <h2>Dans ce jeu, vous jouerez aux jeu de simon classique à 4 couleurs, <br>
                le but est de mémoriser une suite de couleur qui augmentera à chaque niveau <br>
                (jeu facile)</h2>
            <button type="button" onclick="openGame('simonbase')" class="boutgros">
                <img src="images/jeusimonlogo.png"> <!-- Bouton pour lancer le jeu facile -->
            </button>
        </div>
        <br><br>
        <div>
            <h2>Dans ce jeu, vous jouerez aux jeu de simon classique à 6 couleurs, <br>
                le but est de mémoriser une suite de couleur qui augmentera à chaque niveau <br>
                (jeu moyen)</h2>
            <button type="button" onclick="openGame('simonmoy')" class="boutgros">
                <img src="images/jeusimonlogo2.png"> <!-- Bouton pour lancer le jeu moyen -->
            </button>
        </div>
        <br><br>
        <div>
            <h2>Dans ce jeu, vous jouerez aux jeu de simon en format piano à 12 touches, <br>
                le but est de mémoriser une suite de couleur qui augmentera à chaque niveau. <br>
                Attention c'est en noir et blanc (jeu difficile)</h2>
            <button type="button" onclick="openGame('simondiff')" class="boutgros">
                <img src="images/pianologo.png"> <!-- Bouton pour lancer le jeu difficile -->
            </button>
        </div>
    </div>

    <!-- Bouton pour afficher le classement -->
    <button id="show-ranking" style="padding: 10px 20px; font-size: 16px; cursor: pointer;">
        Voir le classement
    </button>

    <br><br>
    <!-- Bouton pour se déconnecter -->
    <button id="logout-button" style="padding: 10px 20px; font-size: 16px; cursor: pointer;">
        Se déconnecter
    </button>
</body>
<script src="pagedebut.js"></script> <!-- Inclusion du fichier JavaScript -->
<?php 
try {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=localhost;dbname=projetweb', 'root', ''); // Connexion à MySQL
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Active les exceptions pour les erreurs PDO

    // Vérification si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Si la méthode est POST
        // Récupération des données du formulaire
        $nom = htmlspecialchars($_POST['nom']); // Sécurise le champ "nom"
        $prenom = htmlspecialchars($_POST['prenom']); // Sécurise le champ "prenom"

        // Insertion des données dans la table Joueur
        $stmt = $pdo->prepare("INSERT INTO Joueur (nom, prenom) VALUES (:nom, :prenom)");
        $stmt->execute(["nom" => $nom, "prenom" => $prenom]); // Exécute la requête avec les données

        // Génération d'un pseudo pour l'utilisateur
        $pseudo = $nom; // Utilise le nom comme pseudo
        echo '<script>document.getElementById("pseudo").value = "' . $pseudo . '";</script>'; // Injecte le pseudo dans le DOM
    }

    // Vérification si des données sont passées en GET
    if ($_SERVER['REQUEST_METHOD'] === 'GET') { // Si la méthode est GET
        if (isset($_GET['username2'], $_GET['difficulty'], $_GET['reactionTime'], $_GET['game_level'])) {
            // Récupération des données passées en GET
            $username = $_GET['username2'];
            $difficulty = $_GET['difficulty'];
            $reactionTime = $_GET['reactionTime'];
            $gamelevel = $_GET['game_level'];

            // Génération d'un ID unique pour la difficulté
            $id_Diff = uniqid();

            // Insertion dans la table Difficulté
            $querySaveScore = "INSERT INTO Difficulté (id_Diff, niveau, temps_react, difficulte)
                               VALUES (:id_Diff, :niveau, :temps_react, :difficulte)";
            $saveScoreStmt = $pdo->prepare($querySaveScore);
            $saveScoreStmt->execute([
                'id_Diff' => $id_Diff, // ID unique pour la difficulté
                'niveau' => $gamelevel, // Niveau du jeu
                'temps_react' => $reactionTime, // Temps de réaction
                'difficulte' => $difficulty // Niveau de difficulté
            ]);

            // Insertion dans la table Jouer
            $queryInsertJouer = "INSERT INTO Jouer (id_Joueur, id_Diff)
                                 VALUES (:id_Joueur, :id_Diff)";
            $insertJouerStmt = $pdo->prepare($queryInsertJouer);
            $insertJouerStmt->execute([
                'id_Joueur' => $pdo->lastInsertId(), // Récupère l'ID du joueur inséré
                'id_Diff' => $id_Diff // ID de la difficulté
            ]);
        }
    }
} catch (PDOException $e) {
    // Gestion des erreurs PDO
    echo "Erreur : " . $e->getMessage(); // Affiche l'erreur
    exit; // Arrête l'exécution du script
}

// Redirection vers la page de début
header("Location: pagedebut.php"); // Redirige vers la même page
exit; // Arrête l'exécution du script après la redirection
?>
</html>