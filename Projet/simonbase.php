<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeu de Simon basique</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Jeu de Simon classique</h1>
    </header>
    <div class="jeu-container">
        <div class="jeu_simon">
            <div id="vert" class="couleur vert"></div>
            <div id="rouge" class="couleur rouge"></div>
            <div id="jaune" class="couleur jaune"></div>
            <div id="bleu" class="couleur bleu"></div>
            <button id="comm">
                <img src="images/start0.png" alt="Start">
            </button>
        </div>
    </div>
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
<script src="script3.js"></script>
</html>