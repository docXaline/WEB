# WEB
SIMON
_______________________________________________________
Dans ce projet, nous avons travailler sur le célèbre jeu de simon. Pour cela nous avons réaliser trois jeux différent un facile ( le jeu de simon classique), un moyen avec plus de boutons et un difficile en format piano (défi personnel). Le but du jeu est de voir une séquence qui démarre à 1 et de la répété à chaque fois qu'une couleur s'allume, à chaque niveau réussi la séquence augmente de 1.

Les instructions d'installation et de configuration:
Nous avons réaliser ce projet sur Visual Studio Code et avons utilisé xampp notre base de données s'appelle "projetweb" et voici notre base de donnée en sql:

CREATE TABLE Joueur(
   id_Joueur INT,
   nom VARCHAR(50),
   prenom VARCHAR(50),
   PRIMARY KEY(id_Joueur)
);

CREATE TABLE Difficulté(
   id_score VARCHAR(50),
   niveau INT,
   temps_react VARCHAR(50),
   difficulte VARCHAR(50),
   id_Joueur INT NOT NULL,
   PRIMARY KEY(id_score),
   FOREIGN KEY(id_Joueur) REFERENCES Joueur(id_Joueur)
);
Attention a avoir toutes les extensions nécéssaire au html, css, JavaScript et php sur VSCode.

Les instructions d'utilisation pour les joueurs:
Pour bien démarrer le jeu il faut commencer par log.php, ensuite une fois le nom et prénom validés, vous serrez redirigé vers pagedebut.php (choix des jeux) et en cliquant sur les boutons vous serez redirigé vers les pages souhaitaient. Le classement affichera le classement voulu seulement si une personne a fini au moins un jeu.

Des informations pour les développeurs souhaitant contribuer au projet:
Nous aurions aimé faire trois classements différents selon la difficulté des jeux et possiblement rajouté d'autre variante du jeu de simon (les couleurs changent, la séquence est accélérée...)

