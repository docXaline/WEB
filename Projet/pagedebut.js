// Fonction pour ouvrir un jeu
function openGame(gameName) {
    let nomInput = document.getElementById('nom');
    let nom = nomInput ? nomInput.value.trim() : ''; // Récupérer la valeur du champ "nom"
    // Redirection directe vers la page du jeu
    window.location.href = `${gameName}.php?nom=${nom}`;
}

