const couleur = ["vert", "rouge", "jaune", "bleu", "orange", "violet"];
let sequence = [];
let sequenceJouer = [];
let level = 0;
let gameOver = false;
let startTime; // Variable pour enregistrer le temps de début
let endTime; // Variable pour enregistrer le temps de fin
let reactionTime; // Variable pour garder une trace du temps de réaction

const startButton = document.getElementById("commencer");
const couleurElement = couleur.map(couleur => document.getElementById(couleur));
const popup = document.getElementById("popup");
const popupMessage = document.getElementById("popupMessage");
const closePopup = document.getElementById("closePopup");
const checkVert = document.getElementById("checkVert");
const niveau = document.getElementById("niveau");

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

function showPopup(message) {
    popupMessage.textContent = message;
    const music = new Audio("audio/emotioDfin.mp3");
    music.play();
    popup.style.display = "flex";
}

function resetCheck() {
    checkVert.style.opacity = 0.5;
}

function updateNiveau(level) {
    niveau.textContent = "Niveau: " + level;
}