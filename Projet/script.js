const couleur = ["vert", "rouge", "jaune", "bleu"];
let sequence = [];
let sequenceJouer = [];
let level = 0;
let gameOver = false;
let startTime;
let endTime; 
let reactionTime;

const startButton = document.getElementById("commencer");
const couleurElement = couleur.map(couleur => document.getElementById(couleur));
const popup = document.getElementById("popup");
const popupMessage = document.getElementById("popupMessage");
const closePopup = document.getElementById("closePopup");
const checkVert = document.getElementById("checkVert");


startButton.addEventListener("click", startGame);

couleurElement.forEach(couleurElement => {
    if (couleurElement) {
        couleurElement.addEventListener("click", () => toucheCouleurClick(couleurElement.id));
    }
});

closePopup.addEventListener("click", () => {
    popup.style.display = "none";
});

function startGame() {
    sequence = [];
    sequenceJouer = [];
    level = 0;
    gameOver = false;
    resetCheck();
    nextLevel();
}

function nextLevel() {
    level++;
    sequenceJouer = [];
    updateNiveau(level);
    const nextCouleur = couleur[Math.floor(Math.random() * couleur.length)];
    sequence.push(nextCouleur);
    Jouer();
}

function Jouer() {
    sequence.forEach((couleur, index) => {
        setTimeout(() => {
            flashCouleur(couleur);
        }, (index + 1) * 600);
    });
}

function flashCouleur(couleur) {
    const couleurElement = document.getElementById(couleur);
    if (couleurElement) {
        couleurElement.style.opacity = 1;
        startTime = new Date().getTime(); // Enregistre le temps de début
        setTimeout(() => {
            couleurElement.style.opacity = 0.5;
        }, 300);
    }
}

function toucheCouleurClick(couleur) {
    endTime = new Date().getTime(); // Enregistre le temps de fin
    reactionTime = endTime - startTime; // Calcule le temps de réaction
    sequenceJouer.push(couleur);
    flashCouleur(couleur);

    if (!checkSequence()) {
        showPopup("Perdu! Vous êtes au niveau " + level + ". Temps de jeu: " + reactionTime + " s");
        gameOver = true;
        checkVert.style.opacity = 1;
    } else if (sequenceJouer.length === sequence.length) {
        checkVert.style.opacity = 1;
        setTimeout(() => {
            nextLevel();
            resetCheck();
        }, 1000);
    }
}

function checkSequence() {
    for (let i = 0; i < sequenceJouer.length; i++) {
        if (sequenceJouer[i] !== sequence[i]) {
            return false;
        }
    }
    return true;
}

function saveGameResult(level, reactionTime) {
    if (!playerData.name || !playerData.surname || !playerData.difficulty) {
        console.error('Les données du joueur sont manquantes.');
        return;
    }

    // Crée un formulaire HTML simulé
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'save_result.php';

    // Ajoute les données du joueur et du jeu au formulaire
    const inputs = [
        { name: 'name', value: playerData.name },
        { name: 'surname', value: playerData.surname },
        { name: 'difficulty', value: playerData.difficulty },
        { name: 'level', value: level },
        { name: 'reactionTime', value: reactionTime }
    ];

    inputs.forEach(inputData => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = inputData.name;
        input.value = inputData.value;
        form.appendChild(input);
    });

    // Ajoute le formulaire au document et le soumet
    document.body.appendChild(form);
    form.submit();
}

// Appelle cette fonction en fin de partie
function showPopup(message) {
    popupMessage.textContent = message;
    const music = new Audio("audio/emotioDfin.mp3");
    music.play();
    popup.style.display = "flex";

    // Enregistre les résultats en fin de partie
    saveGameResult(level, reactionTime);
}

function resetCheck() {
    checkVert.style.opacity = 0.5;
}

function updateNiveau(level) {
    niveau.textContent = "Niveau: " + level;
}

document.addEventListener('DOMContentLoaded', function () {
    const logoutButton = document.getElementById('logout-button');

    if (logoutButton) {
        logoutButton.addEventListener('click', function () {
            // Appelle un script PHP pour détruire la session
            fetch('logout.php', { method: 'POST' })
                .then(response => {
                    if (response.ok) {
                        // Redirige l'utilisateur vers la page d'accueil ou de connexion
                        window.location.href = 'pagedebut.php';
                    } else {
                        alert('Erreur lors de la déconnexion.');
                    }
                })
                .catch(error => console.error('Erreur lors de la déconnexion :', error));
        });
    }
});