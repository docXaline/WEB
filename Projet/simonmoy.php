<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeu de Simon moyen</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <header>
        <h1>Jeu de Simon de niveau moyen</h1>
    </header>
    <div class="jeu-container">>
        <div class="jeu_simon">
            <div id="vert" class="couleur vert"></div>
            <div id="rouge" class="couleur rouge"></div>
            <div id="jaune" class="couleur jaune"></div>
            <div id="bleu" class="couleur bleu"></div>
            <div id="orange" class="couleur orange"></div>
            <div id="violet" class="couleur violet"></div>
        </div>
    </div>
    <button id="commencer"><img src="images/start1.png" alt="Start"></button>
    <div class="bonFaux">
        <h2 id="niveau">Niveau: 0</h2>
        <div id="checkVert" class="rougeVert checkVert"></div>
    </div>
    <div id="popup" class="popup">
        <div class="popup-content">
            <span id="closePopup" class="close">&times;</span>
            <p id="popupMessage"></p>
        </div>
    </div>
    <div>
        <button onclick="window.location.href='pagedebut.php'" id="retour">
            Retour à la page d'accueil
        </button>
    </div>
</body>
<script src="script2.js"></script>
</html>
