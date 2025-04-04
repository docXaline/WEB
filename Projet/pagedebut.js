// Redirection avec username dans l'URL
let username = "";
document.addEventListener('DOMContentLoaded', () => {
    const formContainer = document.getElementById('form-container');
    const mainContent = document.getElementById('main-content');
    const userForm = document.getElementById('user-form');
    const nomInput = document.getElementById('nom');
    const prenomInput = document.getElementById('prenom');

    // Écouteur pour le formulaire
    userForm.addEventListener('submit', (event) => {
        event.preventDefault(); // Empêche le rechargement de la page

        const nom = nomInput.value.trim();
        const prenom = prenomInput.value.trim();

        if (nom && prenom) {
            // Cache le formulaire et affiche le choix des jeux
            formContainer.style.display = 'none';
            mainContent.style.display = 'block';

            console.log(`Nom : ${nom}, Prénom : ${prenom}`);
        } else {
            alert('Veuillez remplir tous les champs.');
        }
    });
});
// filepath: c:\xampp\htdocs\ProjetWebL1\Projet\pagedebut.js
function openGame(gameName) {

    const inputusername = document.querySelector("#pseudo");
    if (username) {
        console.log(username);
    }
    // Exemple : redirection vers une autre page
    
    window.location.href = `${gameName}.php?username=${username}`;
     // 1 seconde de délai avant la redirection
    //let diff = document.querySelectorAll("button").dataset.difficulte;

    
}