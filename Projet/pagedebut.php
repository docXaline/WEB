
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeux de Simon</title>
    <!--<link rel="stylesheet" href="pagedebut.css">-->
</head>
<body>
    <header>
        <h1>Bienvenue dans le jeu de Simon</h1>
    </header>
    <!-- Formulaire pour saisir le nom et le prénom -->
    <div id="form-container">
        <h2>Veuillez entrer votre nom et prénom pour commencer :</h2>
        <form method="POST" action="pagedebut.php" id="user-form">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>
            <br><br>
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>
            <br><br>
            <button type="submit">Valider</button>
        </form>
    </div>

    <!-- Contenu principal de la page -->
    <div id="main-content" style="display:none;">
        <div>
            <h2>Dans ce jeu, vous jouerez aux jeu de simon classique à 4 couleurs, <br>
                le but est de mémoriser une suite de couleur qui augmentera à chaque niveau <br>
                (jeu facile)</h2>
            <button type="button" onclick="openGame('simonbase')" data-difficulte = "1" class = "boutgros">
                <img src="images/jeusimonlogo.png">
            </button>
        </div>
        <br><br>
        <div>
            <h2>Dans ce jeu, vous jouerez aux jeu de simon classique à 6 couleurs, <br>
                le but est de mémoriser une suite de couleur qui augmentera à chaque niveau <br>
                (jeu moyen)</h2>
            <button type="button" onclick="openGame('simonmoy')" data-difficulte = "2" class = "boutgros">
                <img src="images/jeusimonlogo2.png">
            </button>
        </div>
        <br><br>
        <div>
            <h2>Dans ce jeu, vous jouerez aux jeu de simon en format piano à 12 touches, <br>
                le but est de mémoriser une suite de couleur qui augmentera à chaque niveau. <br>
                Attention c'est en noir et blanc (jeu difficile)</h2>
            <button type="button" onclick="openGame('simondiff')" data-difficulte = "3" class = "boutgros">
                <img src="images/pianologo.png">
            </button>
        </div>
    </div>
    <!-- Bouton pour afficher le classement -->
    <button id="show-ranking" style="padding: 10px 20px; font-size: 16px; cursor: pointer;">
        Voir le classement
    </button>

    <!-- Fenêtre modale pour afficher le classement -->
    <div id="ranking-modal" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); z-index: 1000;">
        <h2>Classement des joueurs</h2>
        <table border="1" style="width: 100%; text-align: left; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Temps de réaction</th>
                    <th>Niveau</th>
                </tr>
            </thead>
            <tbody id="ranking-table">
                <!-- Les données du classement seront insérées ici -->
            </tbody>
        </table>
        <button id="close-ranking" style="margin-top: 10px; padding: 10px 20px; cursor: pointer;">Fermer</button>
    </div>
    <br><br>
    <!-- Bouton pour se déconnecter -->
    <button id="logout-button" style="padding: 10px 20px; font-size: 16px; cursor: pointer;">
        Se déconnecter
    </button>
</body>
<script src="pagedebut.js"></script>
<?php 
    try {
        // Connexion à la base de données
        $pdo = new PDO('mysql:host=localhost;dbname=projetweb', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérification si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération des données du formulaire
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            echo $nom . $prenom;
            // Insertion des données dans la base de données
            $stmt = $pdo->prepare("INSERT INTO joueur (nom, prenom) VALUES (:nom, :prenom)");
            $stmt->execute(["nom"=> $nom,":prenom"=> $prenom]);

            $pseudo = $nom;
            echo '<input type="hidden" id="pseudo" value="' . $pseudo . '">';       
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
    ?>
</html>
