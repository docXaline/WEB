
let username = "";
document.addEventListener('DOMContentLoaded', ()=> {
    const inputusername = document.querySelector("#pseudo");
    if (inputusername) {
        username = inputusername.value;
        console.log("Username:", username);
    }
})
// filepath: c:\xampp\htdocs\ProjetWebL1\Projet\pagedebut.js
function openGame(gameName) {
    // Exemple : redirection vers une autre page
    window.location.href = gameName + ".php";
    let difff = document.querySelectorAll("button").dataset.difficulte;
}

/*// Gestion du formulaire
document.addEventListener('DOMContentLoaded', function () {
    const showRankingButton = document.getElementById('show-ranking');
    const closeRankingButton = document.getElementById('close-ranking');
    const rankingModal = document.getElementById('ranking-modal');

    // Afficher la fenêtre modale
    showRankingButton.addEventListener('click', function () {
        rankingModal.style.display = 'block';
    });

    // Fermer la fenêtre modale
    closeRankingButton.addEventListener('click', function () {
        rankingModal.style.display = 'none';
    });

    // Optionnel : Fermer la fenêtre modale en cliquant en dehors
    window.addEventListener('click', function (event) {
        if (event.target === rankingModal) {
            rankingModal.style.display = 'none';
        }
    });
});

document.getElementById('user-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Empêche le rechargement de la page

    // Récupère les valeurs des champs
    const nom = document.getElementById('nom').value.trim();
    const prenom = document.getElementById('prenom').value.trim();

    // Vérifie que les champs ne sont pas vides
    if (nom && prenom) {
        // Cache le formulaire
        document.getElementById('form-container').style.display = 'none';

        // Affiche le contenu principal
        document.getElementById('main-content').style.display = 'block';
    } else {
        alert('Veuillez remplir tous les champs.');
    }    // Afficher la fenêtre modale du classement
    document.getElementById('show-ranking').addEventListener('click', function () {
        fetch('get_ranking.php') // Appelle un script PHP pour récupérer le classement
            .then(response => response.json())
            .then(data => {
                const rankingTable = document.getElementById('ranking-table');
                rankingTable.innerHTML = ''; // Vide le tableau avant d'ajouter les nouvelles données
    
                // Ajoute chaque joueur au tableau
                data.forEach(player => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${player.nom}</td>
                        <td>${player.prenom}</td>
                        <td>${player.score}</td>
                        <td>${player.temps_reaction}</td>
                        <td>${player.niveau}</td>
                    `;
                    rankingTable.appendChild(row);
                });
    
                // Affiche la fenêtre modale
                document.getElementById('ranking-modal').style.display = 'block';
            })
            .catch(error => console.error('Erreur lors de la récupération du classement :', error));
    });
    
    // Fermer la fenêtre modale
    document.getElementById('close-ranking').addEventListener('click', function () {
        document.getElementById('ranking-modal').style.display = 'none';
    });
});*/

// Gestion du bouton "Se déconnecter"
document.getElementById('user-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Empêche le rechargement de la page

    // Récupère les valeurs des champs
    const nom = document.getElementById('nom').value.trim();
    const prenom = document.getElementById('prenom').value.trim();

    // Vérifie que les champs ne sont pas vides
    if (nom && prenom) {
        // Cache le formulaire
        document.getElementById('form-container').style.display = 'none';

        // Affiche le contenu principal et le bouton de déconnexion
        document.getElementById('main-content').style.display = 'block';
        document.getElementById('logout-button').style.display = 'block';
    } else {
        alert('Veuillez remplir tous les champs.');
    }
});
