document.addEventListener('DOMContentLoaded', () => {
    const userForm = document.getElementById('user-form');

    if (userForm) {
        userForm.addEventListener('submit', (event) => {
            //event.preventDefault(); // Empêche le rechargement de la page

            const nomInput = document.getElementById('nom');
            const prenomInput = document.getElementById('prenom');

            const nom = nomInput ? nomInput.value.trim() : '';
            const prenom = prenomInput ? prenomInput.value.trim() : '';

            if (nom && prenom) {
                console.log(`Nom : ${nom}, Prénom : ${prenom}`);

                // Redirection vers pagedebut.php
                window.location.href = 'pagedebut.php';
            } else {
                alert('Veuillez remplir tous les champs.');
            }
        });
    }
});