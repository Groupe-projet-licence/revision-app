CAHIER DE CHARGES D'UNE APPLICATION DE CRÉATION DE FICHES DE RÉVISION


---

1 - PAGE DE TITRE :

Titre du projet : Application de création de fiches de révision

Porteur du projet : WebTitans

Date de réalisation : 16 avril 2025

Version du document : 1.0



---

2 - CONTEXTE ET PRÉSENTATION DU PROJET :

En milieu scolaire et académique, on constate que les apprenants n'arrivent pas souvent à réviser efficacement les leçons.
Cette application vient donc résoudre ce problème en permettant à ceux-ci de se créer des fiches de révision qu'ils pourront consulter et sur lesquelles ils pourront s’évaluer grâce à des quiz associés.

Cette application est réalisée dans le cadre de l’UV projet, une des UV de fin de cycle licence en informatique ;
et elle cible essentiellement les étudiants universitaires.


---

3 - OBJECTIFS :

A. Objectif général :

Permettre aux étudiants de mieux organiser leurs révisions à travers la création de fiches de révision.

B. Objectifs spécifiques :

Permettre la création de fiches de révision et des quiz pour étudier et s’évaluer soi-même.

Permettre un suivi des performances.

Proposer une interface intuitive permettant la création des fiches.

Permettre une consultation rapide des fiches.



---

4 - DESCRIPTION DES UTILISATEURS CIBLES :

Cibles principales : étudiants universitaires

Niveau technique : application accessible sans aucune formation



---

5 - FONCTIONNALITÉS :

Cette application devra offrir les fonctionnalités suivantes :

Créer une fiche : les utilisateurs doivent y ajouter du texte, des images et des couleurs.

Gérer une fiche : possibilité de mettre à jour les fiches et de les supprimer.

Mode révision : les différentes fiches doivent pouvoir être affichées rapidement, et on doit pouvoir naviguer entre elles rapidement, de manière à ne pas casser l’élan de l’apprenant.

Révision intelligente : l’application doit proposer quelques fiches qui doivent être révisées en utilisant la technique de la répétition espacée.

Créer un quiz : il va s’agir d’un questionnaire lié à une fiche de révision.

Réalisation des évaluations : les apprenants doivent pouvoir passer un quiz enregistré et obtenir une correction automatique à la fin.

Création de flashcards : doivent permettre une révision rapide de certaines notions.

Suivi de performance : affichage d’un graphe présentant les derniers quiz passés et les notes obtenues.

Tableau de bord : une page qui affiche toutes les fiches, des quiz ou des graphiques en fonction de l’onglet sélectionné dans un menu.

Catégorisation des fiches : possibilité de ranger les fiches par matière ou dans des dossiers.

Partage des fiches : possibilité de générer des liens vers des fiches, afin d’inviter des camarades de la plateforme à les explorer.

Personnaliser l’apparence : choix du thème sombre/clair, de la police, etc.



---

6 - EXIGENCES NON-FONCTIONNELLES :

Sécurité : Implémentation d’un système d’inscription et d’authentification.

Responsive design : affichage de l’application sur ordinateur, tablette ou mobile.

Performance : temps de réponse des API < 1 seconde



---

7 - CONTRAINTES TECHNIQUES :

Backend : Laravel 10.x

Frontend : React.js (Quill.js et Chart.js)

Authentification : Laravel Breeze

Base de données : MySQL

Hébergement : InfinityFree / serveur local

Gestionnaire de versions : Git



---

8 - PLANIFICATION ET LIVRABLES :

---

**GUIDE D’UTILISATION :**

1️⃣ Il faut tout d’abord créer un fichier **.env** à la racine du projet, y coller le contenu du fichier **.env.example** et enregistrer. 

2️⃣ **Installer les dépendances PHP en exécutant :**

composer install

Puis générer une clé pour l’application en utilisant la commande :

php artisan key:generate


3️⃣ **Lancer les migrations et les seeders avec :**

php artisan migrate

puis 

php artisan migrate:fresh --seed


4️⃣ **Lancer le serveur de Laravel avec la commande** :

php artisan serve

Ou alors :

php -S localhost:8000 -t public

5️⃣ **Installer les dépendances de React en utilisant :**

npm install

Puis lancer le serveur Vite avec :

npm run dev

6️⃣ Il ne reste plus qu’à vous rendre à l’adresse http://localhost:8000 dans le navigateur pour voir la page d’accueil de l’application s’afficher.

**NB:** 
- les étapes en gras devront etre systématiquement realisées à chaque mise a jour d'une branche local !
- N'oublier pas de créer une nouvelle branche sur laquelle vous allez travailler. Le nom de cette branche doit commencer par feature/ ou bien amelioration/.
- Dans le cas ou le fichier **postcss.config.js** serait vide (lorsque les interfaces s'affichent bizzarement) veuillez ajouter dans ce fichier les lignes de codes suivantes: 
    export default {
        plugins: {
            tailwindcss: {},
            autoprefixer: {},
        },
    };

