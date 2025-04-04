<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simon Piano</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
    <header>
        <h1>Simon Piano</h1>
    </header>
    <div>
        <div class="piano">
            <div id="do" class="white-key"></div>
            <div id="re" class="white-key"></div>
            <div id="mi" class="white-key"></div>
            <div id="fa" class="white-key"></div>
            <div id="sol" class="white-key"></div>
            <div id="la" class="white-key"></div>
            <div id="si" class="white-key"></div>
            <div id="do-sharp" class="black-key"></div>
            <div id="re-sharp" class="black-key"></div>
            <div id="fa-sharp" class="black-key"></div>
            <div id="sol-sharp" class="black-key"></div>
            <div id="si-flat" class="black-key"></div>
        </div>
        <button id="COMMENCER"><img src="images/start1.png" alt="Start"></button>
        <div class="bonFaux">
            <h2 id="niveau">Niveau: 0</h2>
            <div id="checkVert" class="rougeVert checkVert"></div>
        </div>
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
<script src="pagedebut.js"></script>
<script src="script3.js"></script>
</html>
