const chatbotAnswers = [
    // 📂 Fiches de révision
    {
        keywords: ['yo', 'bonjour', 'ça va', 'çava', 'bonsoir', 'salut', 'soir'],
        answer: 'Bonjour comment puis -je t\'aider aujourdhui ? 😎.'
    },

    {
        keywords: ['list'],
        answer: "Voici toutes les question que tu peut me poser. <ul> <li>● Creation d\'une fiche de révision meme la definition </li> <li>● Me saluer 😅</li> <li>● Me demander si on peut ajouter une image dans une fiche</li> <li>● supprimer une ficher</li> <li>● comment catégoriser une fiche</li> <li>● De definir un quiz et comment en créer un ou consulter tes not ou resultat des quiz</li> <li>● Demande meme cette histoire de révision intelligente 😁 et comment elle fonctionne</li> <li>● Savoir comment reintiaiser ton mot de passe en cas de perde</li> <li>● Modifier ton profile</li> <li>● Comment te deconnecter de ton compte et en savoir plus sur EasyLearning bot en tapant <strong>\"En savoir plus\"</strong>.</li></ul> <strong>On me met constament a jour donc d'autres fonctionalites arrive 😎</strong> <br> Par quoi veux tu commencer 😏"
    },


    {
        keywords: ['bonne nuit', 'nuit'],
        answer: 'Merci, a toi aussi rende-vous demain pour des nouvelle adventures 🤗.'
    },

    {
        keywords: ['en savoir plus', 'easylearning bot', ],
        answer: 'Je suis Easy Learning Bot un assistant virtuel concu par 👨‍💻 WAFO AROLD intégré à l\'application EasyLearning. J\'ai été concu pour aider les utilisateurs à comprendre comment utiliser l\'application et ses fonctionnalités. Je suis là pour te guider dans la création de fiches de revision, de quiz, la révision intelligente, et bien plus encore'
    },

    {
        keywords: ['mot de passe'],
        answer: 'Pour reintiliser ton mot de passe au moment de la connection, Clique sur le butoon mot de pas oublie le site envera un lien que tu utilisera pour te connecter a nouveau dans ton compte si jamais tu as un compte dans le site 😄.'
    },

    {
        keywords: ['consulter', 'voir', 'contenu'],
        answer: 'Pour consulter une fiche de revision tu peux te rendre dans la site bar <strong>MY SHEETS</strong> puis sur ASSESSMENT pour pouvoir la consulter 👀, C\'est pareil pour les quizs.'
    },
    
    {
        keywords: ['fiche de révision', 'fiche révision', 'fiche de revision'],
        answer: 'Une fiche de revision est un document contenant les idées clés d’un cours 📚. Elle permet de résumer, mémoriser et réviser plus facilement 🧠.'
    },

    {
        keywords: ['créer une fiche', 'nouvelle fiche', 'ajouter une fiche'],
        answer: 'Clique sur “New Sheet” dans l’onglet “MY SHEETS”. Tu pourras saisir un titre, une description et un contenu personnalisé Amuse toi bien 😊.'
    },
    {
        keywords: ['ajouter une image', 'image dans fiche'],
        answer: 'Oui, tu peux insérer du texte, des images et mettre en forme le contenu de tes fiches via l’éditeur intégré.'
    },
    {
        keywords: ['supprimer une fiche', 'enlever une fiche', 'effacer une fiche'],
        answer: 'Sur chaque fiche, un bouton “Supprimer” te permet de la retirer définitivement 🚮. pour t\'y trouver rend toi dans la nav links et clique sur Mes fiches sur puis sur les 3 petit points(...) puis supprimer'
    },
    {
        keywords: ['catégorie', 'organiser fiche', 'classer', 'catégoriser'],
        answer: 'Tu peux classer tes fiches par matière ou niveau pour mieux t’y retrouver 🎨.'
    },

    // 📂 Quiz & évaluation
    {
        keywords: ['quoi un quiz', 'definir un quiz',],
        answer: 'Un quiz est un test à choix permettant de t’auto-évaluer sur une fiche. Il peut être à choix simple ou multiple 🌚.'
    },
    {
        keywords: ['créer un quiz', 'nouveau quiz'],
        answer: 'Clique sur “Nouveau quiz” pour ajouter une question, des réponses possibles et indiquer les bonnes. va dans onclet quiz tu retrouvera le bouton nouveau quiz'
    },
    {
        keywords: ['résultat quiz', 'note'],
        answer: 'Une fois le quiz terminé, une correction automatique s’affiche avec ta note et les bonnes réponses. Tu pouras les consulter dans l\'onglet historique de la site bar 😎'
    },

    // 📂 Révision intelligente
    {
        keywords: ['révision intelligente', 'répétition espacée'],
        answer: 'La révision intelligente repose sur la répétition espacée : plus tu révises une fiche, plus l’intervalle s’allonge. En utilisant un algorithme complexe veillez vous renseigner aupres des developpeur pour en savoir plus 😌'
    },
    {
        keywords: ['fiches à réviser', 'réviser aujourd’hui'],
        answer: 'Va dans l’onglet “Révision” pour retrouver les fiches que tu dois revoir aujourd’hui.'
    },

    // 📂 Interface & navigation
    {
        keywords: ['tableau de bord', 'dashboard'],
        answer: 'Le tableau de bord affiche un résumé de tes fiches, quiz, et tes progrès sous forme de graphiques.'
    },
    {
        keywords: ['historique', 'resultat'],
        answer: 'Tu peux voir les dernières fiches et quiz que tu as consultés dans “Mon historique”.'
    },
    {
        keywords: ['thème sombre', 'changer thème'],
        answer: 'Tu peux passer en mode sombre ou clair dans les paramètres de ton compte.'
    },

    // 📂 Utilisation générale
    {
        keywords: ['gratuit', 'prix'],
        answer: 'Oui, EasyLearning est une application gratuite pour tous les étudiants.'
    },
    {
        keywords: ['partager'],
        answer: 'Tu peux partager tes quiz via un lien sécurisé que tu envoies à tes camarades. clique juste sur 🔗 Share Quiz dans onglet MY QUIZ'
    },
    {
        keywords: ['téléphone', 'portable'],
        answer: 'Oui, l’application fonctionne parfaitement sur mobile ou tablette. Responsive ameliorer'
    },

    // 📂 Compte utilisateur
    {
        keywords: ['profil'],
        answer: 'Clique sur l\'onglet de la sitebar <strong>MY ACCOUNT</strong> pour modifier tes informations 🛡'
    },
    {
        keywords: ['deconnecte', 'deconnexion'],
        answer: 'En haut a droit clique le button representant ton nom tu vera une option deconnecter pour te deconnecter de ton compte 🏃‍♂️'
    },
    {
        keywords: ['supprimer mon compte', 'supprimer son compte',],
        answer: 'La suppression du compte se fait sur demande via le formulaire de contact. qui de trouve sur votre profil <strong>MY ACCOUNT</strong>'
    },

    // 📂 Tutoriel et aide
    {
        keywords: ['tutoriel', 'guide', 'commencer'],
        answer: 'Un tutoriel t’est proposé à ta première connexion pour t’aider à découvrir les fonctionnalités de base, Je suis la pour t\'ader si tu as dautres question a propos de l\'app 🤭.'
    },

    //Langue de easy learning bot
    {
        keywords: ['langue', 'fran', 'anglais', 'french', 'english'],
        answer: 'Cette fonctionnalite est en cours de developpement, Nos abeilles travaillent dur la dessous 🚧, Elle sera bientot disponibles 👊.'
    },
];

export default chatbotAnswers;

