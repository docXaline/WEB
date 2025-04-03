const keys = ["do", "re", "mi", "fa", "sol", "la", "si", "do-sharp", "re-sharp", "fa-sharp", "sol-sharp", "si-flat"];
let sequence = [];
let sequenceJouer = [];
let level = 0;
let gameOver = false;
let startTime;
let endTime;
let reactionTime;

const startButton = document.getElementById("commencer");
const keyElements = keys.map(key => document.getElementById(key));
const popup = document.getElementById("popup");
const popupMessage = document.getElementById("popupMessage");
const closePopup = document.getElementById("closePopup");
const checkVert = document.getElementById("checkVert");
const niveau = document.getElementById("niveau");

startButton.addEventListener("click", startGame);

keyElements.forEach(keyElement => {
    if (keyElement) {
        keyElement.addEventListener("click", () => toucheKeyClick(keyElement.id));
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
    const nextKey = keys[Math.floor(Math.random() * keys.length)];
    sequence.push(nextKey);
    Jouer();
}

function Jouer() {
    sequence.forEach((key, index) => {
        setTimeout(() => {
            flashKey(key);
        }, (index + 1) * 600);
    });
}

function flashKey(key) {
    const keyElement = document.getElementById(key);
    if (keyElement) {
        keyElement.style.opacity = 1;
        startTime = new Date().getTime(); // Enregistre le temps de début
        setTimeout(() => {
            keyElement.style.opacity = 0.5;
        }, 300);
    }
    let audio;
    switch (key) {
        case "do":
            audio = new Audio("audio/Do.mp4");
            break;
        case "re":
            audio = new Audio("audio/Ré.mp4");
            break;
        case "mi":
            audio = new Audio("audio/Mi.mp4");
            break;
        case "fa":
            audio = new Audio("audio/Fa.mp4");
            break;
        case "sol":
            audio = new Audio("audio/sol.mp3");
            break;
        case "la":
            audio = new Audio("audio/La.mp4");
            break;
        case "si":
            audio = new Audio("audio/Si.mp4");
            break;
        case "do-sharp":
            audio = new Audio("audio/do-sharp.mp3");
            break;
        case "re-sharp":
            audio = new Audio("audio/Ré-sharp.mp3");
            break;
        case "fa-sharp":
            audio = new Audio("audio/Fa-sharp.mp3");
            break;
        case "sol-sharp":
            audio = new Audio("audio/Sol-sharp.mp3");
            break;
        case "si-flat":
            audio = new Audio("audio/la-sharp.mp3");
            break;
    }
    if (audio) {
        audio.play();
    }
}

function toucheKeyClick(key) {
    endTime = new Date().getTime(); // Enregistre le temps de fin
    reactionTime = endTime - startTime; // Calcule le temps de réaction
    sequenceJouer.push(key);
    flashKey(key);
    
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
    //const music = new Audio("audio/emotioDfin.mp3");
    //music.play();
    popup.style.display = "flex";
}

function resetCheck() {
    checkVert.style.opacity = 0.5;
}

function updateNiveau(level) {
    niveau.textContent = "Niveau: " + level;
}