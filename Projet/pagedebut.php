<?php
$nom = isset($_GET['nom']) ? htmlspecialchars($_GET['nom']) : null;
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(isset($_GET['nom'])) {
        echo "Nom d'utilisateur manquant.";
        $nom = htmlspecialchars($_GET['nom']);
        echo "<input type='hidden' id='nom' value='$nom'>"; // Ajout d'un champ caché pour le nom
        
    }}
?>
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
    <!-- Contenu principal de la page (choix des jeux) -->
    <div id="main-content"> <!-- Masqué par défaut -->
        <div class="button-container">
            <h2>Dans ce jeu, vous jouerez aux jeu de simon classique à 4 couleurs, <br>
                le but est de mémoriser une suite de couleur qui augmentera à chaque niveau <br>
                (jeu facile)</h2>
            <button type="button" onclick="openGame('simonbase')" class="boutgros">
                <img src="images/jeusimonlogo.png"> <!-- Bouton pour lancer le jeu facile -->
            </button>
        </div>
        <br><br>
        <div class="button-container">
            <h2>Dans ce jeu, vous jouerez aux jeu de simon classique à 6 couleurs, <br>
                le but est de mémoriser une suite de couleur qui augmentera à chaque niveau <br>
                (jeu moyen)</h2>
            <button type="button" onclick="openGame('simonmoy')" class="boutgros">
                <img src="images/jeusimonlogo2.png"> <!-- Bouton pour lancer le jeu moyen -->
            </button>
        </div>
        <br><br>
        <div class="button-container">
            <h2>Dans ce jeu, vous jouerez aux jeu de simon en format piano à 12 touches, <br>
                le but est de mémoriser une suite de couleur qui augmentera à chaque niveau. <br>
                Attention c'est en noir et blanc (jeu difficile)</h2>
            <button type="button" onclick="openGame('simondiff')" class="boutgros">
                <img src="images/pianologo.png"> <!-- Bouton pour lancer le jeu difficile -->
            </button>
        </div>
    </div>
    <!-- Bouton pour se déconnecter -->
    <button onclick="window.location.href='log.php'" id="logout-button" style="padding: 10px 20px; font-size: 16px; cursor: pointer;">
        Se déconnecter
    </button>
</body>
<script src="logout.js"></script> <!-- Inclusion du fichier JavaScript pour la déconnexion -->
<script src="pagedebut.js"></script> <!-- Inclusion du fichier JavaScript -->
</html>