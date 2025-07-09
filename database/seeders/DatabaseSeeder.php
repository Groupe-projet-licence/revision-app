<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Sheet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        /*------------------------------------------------------------------------------------
         *                               Users
         *------------------------------------------------------------------------------------*/

        $user = User::factory()->create([
            "name" => "darlin",
            "email" => "donfackdarlin@gmail.com",
            "password" => Hash::make("670748873")
        ]);
        $user1 = User::factory()->create([
            "name" => "rochelin",
            "email" => "anoumedemrochelin6@gmail.com",
            "password" => Hash::make("698112522")
        ]);
        \App\Models\User::factory(count: 5)->create();


        /*------------------------------------------------------------------------------------
         *                               Categories pour les categories
         *------------------------------------------------------------------------------------*/

        $categoriesSubjects = [
            'Software Engineering',
            'Networking',
            'Databases',
            'Mobile Programming',
            'Algorithms',
            'Computer Security',
            'Operating Systems',
            'Web Programming',
            'Artificial Intelligence',
            'Data Analysis',
            'Big Data',
            'Cloud Computing',
            'Internet of Things',
            'Cybersecurity',
            'DevOps',
            'Project Management',
            'Java',
            'Software Architecture',
            'Virtualization',
            'Data Mining',
            'Statistics',
            'System Administration',
            'UX/UI Design',
            'Object-Oriented Programming',
            'Docker & Kubernetes',
            'Blockchain',
            'Virtual Reality',
            'Network Security'
        ];
        foreach ($categoriesSubjects as $subject) {
            for ($level = 1; $level <= 8; $level++) {
                Category::create([
                    'subject' => $subject,
                    'level' => $level,
                ]);
            }
        }

        /*------------------------------------------------------------------------------------
         *                               Sheets
         *------------------------------------------------------------------------------------*/

        $sheets = [
            [
                'title' => 'Les Bases de Données Relationnelles',
                'category_id' => 19,
                'content' => '
                    <h1><strong>Les Bases de Données Relationnelles</strong></h1>
                    <p>Une <strong>base de données relationnelle</strong> permet de stocker des données sous forme de tables reliées entre elles.</p>
                    <h2><strong>Éléments Fondamentaux</strong></h2>
                    <ul>
                        <li><strong>Clé primaire :</strong> identifiant unique.</li>
                        <li><strong>Clé étrangère :</strong> référence externe.</li>
                        <li><strong>Index :</strong> accélération des requêtes.</li>
                    </ul>
                    <h2><strong>Langage SQL</strong></h2>
                    <pre>CREATE TABLE users ( id INT PRIMARY KEY, name VARCHAR(50) );</pre>
                    <h2><strong>Transactions</strong></h2>
                    <ul>
                        <li><strong>Atomicité</strong></li>
                        <li><strong>Cohérence</strong></li>
                        <li><strong>Isolation</strong></li>
                        <li><strong>Durabilité</strong></li>
                    </ul>
                    <blockquote>ACID est un concept fondamental des bases transactionnelles.</blockquote>
                    <hr>
                    <h2><strong>Modèles NoSQL</strong></h2>
                    <p>Pour les données non structurées ou volumineuses : <strong>MongoDB, Redis…</strong></p>
                ',
            ],
            [
                'title' => 'Le Cycle de Vie du Logiciel',
                'category_id' => 2,
                'content' => '
                    <h1><strong>Le Cycle de Vie d’un Logiciel</strong></h1>
                    <p>Inclut plusieurs phases garantissant la qualité du logiciel.</p>
                    <h2><strong>Phases</strong></h2>
                    <ul>
                        <li>Analyse des besoins</li>
                        <li>Conception (UML)</li>
                        <li>Implémentation</li>
                        <li>Tests</li>
                        <li>Déploiement</li>
                        <li>Maintenance</li>
                    </ul>
                    <h2><strong>Modèles de Développement</strong></h2>
                    <ul>
                        <li>Cascade</li>
                        <li>Cycle en V</li>
                        <li>Agile (Scrum)</li>
                        <li>Itératif</li>
                    </ul>
                    <h2><strong>UML</strong></h2>
                    <ul>
                        <li>Diagrammes de classes</li>
                        <li>Cas d’utilisation</li>
                        <li>Séquences</li>
                    </ul>
                    <blockquote>Les diagrammes facilitent la compréhension du système.</blockquote>
                    <hr>
                    <p>Appliquer les principes <strong>DRY</strong> et <strong>KISS</strong>.</p>
                ',
            ],
            [
                'title' => 'Programmation Mobile : Concepts Clés',
                'category_id' => 27,
                'content' => '
                    <h1><strong>Programmation Mobile</strong></h1>
                    <p>Développement d’applications mobiles prenant en compte : autonomie, connectivité, tailles d’écran…</p>
                    <h2><strong>Plateformes</strong></h2>
                    <ul>
                        <li>Android : Java / Kotlin</li>
                        <li>iOS : Swift</li>
                        <li>Cross-Platform : Flutter, React Native</li>
                    </ul>
                    <h2><strong>Architecture MVC</strong></h2>
                    <ul>
                        <li>Modèle : données</li>
                        <li>Vue : interface</li>
                        <li>Contrôleur : logique métier</li>
                    </ul>
                    <h2><strong>Exemple Code Android</strong></h2>
                    <pre>
Button button = findViewById(R.id.myButton);
button.setOnClickListener(v -> {
  Toast.makeText(this, "Hello!", Toast.LENGTH_SHORT).show();
});
                    </pre>
                    <hr>
                    <p>Utiliser des <strong>API REST</strong> pour les services distants.</p>
                ',
            ],
            [
                'title' => 'Réseaux Informatiques : Bases',
                'category_id' =>11,
                'content' => '
                    <h1><strong>Réseaux Informatiques</strong></h1>
                    <p>Permet d’interconnecter des équipements pour échanger des données.</p>
                    <h2><strong>Types</strong></h2>
                    <ul>
                        <li>LAN</li>
                        <li>MAN</li>
                        <li>WAN (Internet)</li>
                    </ul>
                    <h2><strong>Matériel</strong></h2>
                    <ul>
                        <li>Switch</li>
                        <li>Routeur</li>
                        <li>Point d’accès</li>
                    </ul>
                    <h2><strong>Adresses IP</strong></h2>
                    <ul>
                        <li>IPv4 : 192.168.0.1</li>
                        <li>IPv6 : 2001:db8::1</li>
                    </ul>
                    <h2><strong>Protocoles</strong></h2>
                    <ul>
                        <li>TCP/IP</li>
                        <li>HTTP</li>
                        <li>DNS</li>
                    </ul>
                    <pre>ping www.google.com</pre>
                    <hr>
                    <blockquote>La sécurité réseau protège les ressources des utilisateurs.</blockquote>
                ',
            ],
        ];

        foreach ($sheets as $sheet) {
            Sheet::create([
                'user_id' => 1,
                'category_id' => $sheet['category_id'],
                'title' => $sheet['title'],
                'content' => $sheet['content'],
            ]);
        }


        /*------------------------------------------------------------------------------------
         *                               Quizs
         *------------------------------------------------------------------------------------*/

        $user1->quizzes()->createMany([
            ['title' => 'Laravel', 'description' => 'Ma superbe description du framework Laravel',],
            ['title' => 'Angular', 'description' => 'Ma superbe description du framework Angular',],
            ['title' => 'ReactJs', 'description' => 'Ma superbe description de la librairie ReactJs',]
        ]);
        Quiz::find(1)->questions()->createMany([
            ['question_text' => "Qu'est ce que Laravel", 'type' => 'single'],
            ['question_text' => "Que peut-on faire avec Laravel", 'type' => 'multiple'],
            ['question_text' => "Quels sont les élements semblable a Laravel", 'type' => 'multiple'],
            ['question_text' => "Pourquoi laravel utilise le moteur de template Blade", 'type' => 'single'],
            ['question_text' => "Quel fichier d'un projet laravel est utilise pour gerer les variables de configuration specifiques a l'environnement ", 'type' => 'single'],
        ]);
        Question::find(1)->answers()->createMany([
            ['answer_text' => 'Un framework', 'is_correct' => true],
            ['answer_text' => 'Une librairie', 'is_correct' => false],
            ['answer_text' => 'Un autre nom pour parler de React', 'is_correct' => false],
        ]);
        Question::find(2)->answers()->createMany([
            ['answer_text' => "Developer des applications web", 'is_correct' => true],
            ['answer_text' => 'Créer des API pour gerer la logique backend dans un projet', 'is_correct' => true],
            ['answer_text' => 'Versionner du code', 'is_correct' => false],
            ['answer_text' => "Mettre en place un systeme d'authentification", 'is_correct' => true],
        ]);
        Question::find(3)->answers()->createMany([
            ['answer_text' => 'Angular', 'is_correct' => true],
            ['answer_text' => 'Spring Boot', 'is_correct' => true],
            ['answer_text' => 'React', 'is_correct' => false],
        ]);
        Question::find(4)->answers()->createMany([
            ['answer_text' => 'Pour simplifier la programmation', 'is_correct' => false],
            ['answer_text' => 'Comme modele', 'is_correct' => false],
            ['answer_text' => 'Pour faciliter la creation des controlleurs', 'is_correct' => false],
            ['answer_text' => 'Pour la vue dans le MVC', 'is_correct' => true],
        ]);
        Question::find(5)->answers()->createMany([
            ['answer_text' => '.env.example', 'is_correct' => false],
            ['answer_text' => '.env.local', 'is_correct' => false],
            ['answer_text' => '.env', 'is_correct' => true],
            ['answer_text' => '.config', 'is_correct' => false],
        ]);


        $userId = 1;
        $subjects = [
            'Génie Logiciel' => [
                ['question' => "Qu'est-ce qu'un diagramme de séquence en UML ?", 'answers' => ['Représente les interactions dans le temps.', 'Décrit les classes et leurs attributs.', 'Définit la base de données.', 'Indique la politique réseau.',],],
                ['question' => "Que signifie DRY en génie logiciel ?", 'answers' => ['Don’t Repeat Yourself.', 'Deploy Rapidly Yearly.', 'Do Redirect Yourself.', 'Define Reliable YAML.',],],
                ['question' => "Rôle du Product Owner dans Scrum ?", 'answers' => ['Gère le backlog produit.', 'Test le code quotidiennement.', 'Développe les APIs.', 'Supervise le serveur DNS.',],],
                ['question' => "Qu'est-ce qu'une User Story ?", 'answers' => ['Description fonctionnelle centrée utilisateur.', 'Script de migration de base.', 'Diagramme réseau.', 'Document d’architecture matérielle.',],],
                ['question' => "C'est quoi la dette technique ?", 'answers' => ['Compromis à court terme sur la qualité.', 'Protocole de cryptage logiciel.', 'Framework d’authentification.', 'Méthode de compression vidéo.',],],
                ['question' => "Qu’est-ce que CI/CD ?", 'answers' => ['Intégration et déploiement continus.', 'Compression Interactive.', 'Communication Intranet.', 'Câblage Intelligent.',],],
                ['question' => "Quel outil pour gérer le code source ?", 'answers' => ['Git', 'MySQL', 'Photoshop', 'Apache',],],
                ['question' => "Un test unitaire sert à quoi ?", 'answers' => ['Tester une fonction isolée.', 'Superviser la charge CPU.', 'Modifier les interfaces réseau.', 'Optimiser les logs serveur.',],],
                ['question' => "Qu’est-ce qu’un commit en développement ?", 'answers' => ['Sauvegarde d’un état du code.', 'Ajout d’une route réseau.', 'Mise à jour du BIOS.', 'Création d’une machine virtuelle.',],],
                ['question' => "Que signifie UML ?", 'answers' => ['Unified Modeling Language.', 'User Management Level.', 'Universal Media Language.', 'Unit Measurement Logger.',],],
            ],
            'Réseau' => [
                [
                    'question' => "Quel protocole attribue des IP dynamiques ?",
                    'answers' => [
                        'DHCP',
                        'DNS',
                        'FTP',
                        'SSH',
                    ],
                ],
                [
                    'question' => "Quel outil vérifie la connectivité réseau ?",
                    'answers' => [
                        'Ping',
                        'Word',
                        'MySQL',
                        'Chrome',
                    ],
                ],
                [
                    'question' => "Un VPN permet quoi ?",
                    'answers' => [
                        'Créer un tunnel sécurisé.',
                        'Gérer les comptes utilisateurs.',
                        'Stocker des fichiers multimédias.',
                        'Compiler du code Java.',
                    ],
                ],
                [
                    'question' => "C'est quoi HTTP ?",
                    'answers' => [
                        'Protocole de transfert web.',
                        'Langage de programmation.',
                        'Serveur mail.',
                        'Routeur intelligent.',
                    ],
                ],
                [
                    'question' => "Le rôle d'un routeur ?",
                    'answers' => [
                        'Transférer les paquets entre réseaux.',
                        'Créer des bases de données.',
                        'Analyser les virus.',
                        'Protéger contre le phishing.',
                    ],
                ],
                [
                    'question' => "Quelle commande sous Linux teste la connectivité ?",
                    'answers' => [
                        'ping',
                        'mkdir',
                        'sudo',
                        'cp',
                    ],
                ],
                [
                    'question' => "Quel port pour le HTTPS ?",
                    'answers' => [
                        '443',
                        '21',
                        '80',
                        '8080',
                    ],
                ],
                [
                    'question' => "Adresse IP privée typique ?",
                    'answers' => [
                        '192.168.x.x',
                        '8.8.8.8',
                        '172.217.0.0',
                        '224.0.0.1',
                    ],
                ],
                [
                    'question' => "Que signifie LAN ?",
                    'answers' => [
                        'Local Area Network.',
                        'Large Access Node.',
                        'Logical App Network.',
                        'Linux Application Name.',
                    ],
                ],
                [
                    'question' => "Le DNS sert à quoi ?",
                    'answers' => [
                        'Résoudre un nom en IP.',
                        'Stocker des pages web.',
                        'Analyser le code source.',
                        'Compresser des images.',
                    ],
                ],
            ],
            'Bases de Données' => [
                [
                    'question' => "C'est quoi une clé primaire ?",
                    'answers' => [
                        'Identifiant unique d’un enregistrement.',
                        'Mot de passe du serveur.',
                        'Protocole de chiffrement.',
                        'Adresse IP de la base.',
                    ],
                ],
                [
                    'question' => "SQL signifie quoi ?",
                    'answers' => [
                        'Structured Query Language.',
                        'Server Query Logic.',
                        'Sequential Quick Loop.',
                        'Standard Query List.',
                    ],
                ],
                [
                    'question' => "Index en base : rôle ?",
                    'answers' => [
                        'Accélérer les recherches.',
                        'Afficher les images.',
                        'Créer des logs.',
                        'Stocker les emails.',
                    ],
                ],
                [
                    'question' => "Quel SGBD est NoSQL ?",
                    'answers' => [
                        'MongoDB',
                        'MySQL',
                        'Oracle',
                        'PostgreSQL',
                    ],
                ],
                [
                    'question' => "C'est quoi une table ?",
                    'answers' => [
                        'Ensemble structuré de données.',
                        'Langage de script.',
                        'Protocole réseau.',
                        'Variable PHP.',
                    ],
                ],
                [
                    'question' => "Langage pour interroger MySQL ?",
                    'answers' => [
                        'SQL',
                        'HTML',
                        'SSH',
                        'Python',
                    ],
                ],
                [
                    'question' => "Commande pour afficher une table en MySQL ?",
                    'answers' => [
                        'SELECT * FROM table',
                        'GET table',
                        'SHOW files',
                        'DISPLAY table',
                    ],
                ],
                [
                    'question' => "C'est quoi une clé étrangère ?",
                    'answers' => [
                        'Lien entre deux tables.',
                        'Cryptage des données.',
                        'Identifiant du serveur.',
                        'Adresse MAC du routeur.',
                    ],
                ],
                [
                    'question' => "C'est quoi une requête ?",
                    'answers' => [
                        'Instruction envoyée à la base.',
                        'Interface graphique.',
                        'Message réseau.',
                        'Image compressée.',
                    ],
                ],
                [
                    'question' => "Quel type de base stocke des documents JSON ?",
                    'answers' => [
                        'NoSQL',
                        'SQL',
                        'FTP',
                        'DNS',
                    ],
                ],
            ],
            'Algorithmique' => [
                [
                    'question' => "Complexité de recherche linéaire ?",
                    'answers' => [
                        'O(n)',
                        'O(1)',
                        'O(log n)',
                        'O(n²)',
                    ],
                ],
                [
                    'question' => "Algorithme basé sur 'diviser pour régner' ?",
                    'answers' => [
                        'Quicksort',
                        'Tri à bulles',
                        'Recherche linéaire',
                        'Tri par insertion',
                    ],
                ],
                [
                    'question' => "À quoi sert un arbre binaire ?",
                    'answers' => [
                        'Structurer des données hiérarchiques.',
                        'Crypter des données.',
                        'Générer des nombres aléatoires.',
                        'Gérer les threads système.',
                    ],
                ],
                [
                    'question' => "Algorithme de tri le plus rapide en moyenne ?",
                    'answers' => [
                        'Quicksort',
                        'Selection sort',
                        'Bubble sort',
                        'Insertion sort',
                    ],
                ],
                [
                    'question' => "Complexité de Tri à Bulles ?",
                    'answers' => [
                        'O(n²)',
                        'O(1)',
                        'O(n)',
                        'O(log n)',
                    ],
                ],
                [
                    'question' => "Complexité de recherche dichotomique ?",
                    'answers' => [
                        'O(log n)',
                        'O(n²)',
                        'O(n)',
                        'O(1)',
                    ],
                ],
                [
                    'question' => "Un algorithme glouton c'est quoi ?",
                    'answers' => [
                        'Choisit localement la meilleure option.',
                        'Compare systématiquement tous les cas.',
                        'Utilise un arbre binaire.',
                        'Ordre aléatoire.',
                    ],
                ],
                [
                    'question' => "Variable de contrôle dans une boucle for ?",
                    'answers' => [
                        'Indice de répétition.',
                        'Taille du tableau.',
                        'Type de protocole.',
                        'Format de message réseau.',
                    ],
                ],
                [
                    'question' => "Que signifie Big O ?",
                    'answers' => [
                        'Notation de complexité.',
                        'Norme de sécurité.',
                        'Type de base SQL.',
                        'Adresse réseau.',
                    ],
                ],
                [
                    'question' => "Complexité d'un parcours séquentiel ?",
                    'answers' => [
                        'O(n)',
                        'O(log n)',
                        'O(1)',
                        'O(n²)',
                    ],
                ],
            ],
            'Sécurité Informatique' => [
                [
                    'question' => "C'est quoi le phishing ?",
                    'answers' => [
                        'Usurpation pour voler des infos.',
                        'Cryptage de disque.',
                        'Logiciel antivirus.',
                        'Surveillance du trafic web.',
                    ],
                ],
                [
                    'question' => "HTTPS sert à quoi ?",
                    'answers' => [
                        'Sécuriser les échanges web.',
                        'Accélérer le chargement.',
                        'Faire des sauvegardes.',
                        'Gérer la mémoire vive.',
                    ],
                ],
                [
                    'question' => "Différence symétrique/asymétrique ?",
                    'answers' => [
                        'Clé unique contre clé publique/privée.',
                        'Adresse IP fixe contre dynamique.',
                        'SQL contre NoSQL.',
                        'Serveur proxy contre VPN.',
                    ],
                ],
                [
                    'question' => "Qu'est-ce qu'un ransomware ?",
                    'answers' => [
                        'Logiciel de rançon bloquant des données.',
                        'Protocole de chiffrement.',
                        'Application de gestion DNS.',
                        'Pare-feu matériel.',
                    ],
                ],
                [
                    'question' => "Que signifie SSL ?",
                    'answers' => [
                        'Secure Socket Layer.',
                        'Server Session List.',
                        'Super Security Level.',
                        'Secure Service Locator.',
                    ],
                ],
                [
                    'question' => "Attaque DDoS : principe ?",
                    'answers' => [
                        'Saturation d’un serveur par requêtes.',
                        'Modification des DNS.',
                        'Usurpation IP.',
                        'Backup réseau.',
                    ],
                ],
                [
                    'question' => "Firewall : fonction ?",
                    'answers' => [
                        'Filtre le trafic réseau.',
                        'Convertit des vidéos.',
                        'Stocke des logs.',
                        'Trie des emails.',
                    ],
                ],
                [
                    'question' => "Antivirus détecte quoi ?",
                    'answers' => [
                        'Malwares et virus.',
                        'Adresses IP.',
                        'Flux RSS.',
                        'Extensions CSS.',
                    ],
                ],
                [
                    'question' => "HTTPS utilise quel port ?",
                    'answers' => [
                        '443',
                        '80',
                        '21',
                        '25',
                    ],
                ],
                [
                    'question' => "Que protège le chiffrement ?",
                    'answers' => [
                        'La confidentialité des données.',
                        'Le nombre de connexions.',
                        'L\'espace disque.',
                        'L\'affichage graphique.',
                    ],
                ],
            ],
            'Systèmes d’Exploitation' => [
                [
                    'question' => "Rôle du kernel ?",
                    'answers' => [
                        'Gérer les ressources matérielles.',
                        'Éditer des images.',
                        'Compresser des fichiers.',
                        'Gérer le webmail.',
                    ],
                ],
                [
                    'question' => "Commande Linux pour afficher les processus ?",
                    'answers' => [
                        'ps',
                        'mv',
                        'chmod',
                        'mkdir',
                    ],
                ],
                [
                    'question' => "Qu'est-ce qu'un appel système ?",
                    'answers' => [
                        'Requête d’un programme au noyau.',
                        'Lancement d’un navigateur.',
                        'Protocole réseau.',
                        'Méthode de tri.',
                    ],
                ],
                [
                    'question' => "Que signifie OS ?",
                    'answers' => [
                        'Operating System.',
                        'Online Service.',
                        'Object Storage.',
                        'Open Source.',
                    ],
                ],
                [
                    'question' => "Système basé Unix ?",
                    'answers' => [
                        'Linux',
                        'Windows',
                        'Excel',
                        'Android Studio',
                    ],
                ],
                [
                    'question' => "Partition système principale sous Linux ?",
                    'answers' => [
                        '/',
                        '/home',
                        '/etc',
                        '/mnt',
                    ],
                ],
                [
                    'question' => "Commande Linux pour créer un dossier ?",
                    'answers' => [
                        'mkdir',
                        'ping',
                        'grep',
                        'ls',
                    ],
                ],
                [
                    'question' => "Fichier exécuté au démarrage Linux ?",
                    'answers' => [
                        '/etc/init.d/',
                        '/home/config/',
                        '/usr/bin/boot/',
                        '/var/www/html/',
                    ],
                ],
                [
                    'question' => "Mémoire vive autre nom ?",
                    'answers' => [
                        'RAM',
                        'ROM',
                        'SSD',
                        'CPU',
                    ],
                ],
                [
                    'question' => "Utilitaire Linux pour surveiller la mémoire ?",
                    'answers' => [
                        'top',
                        'cat',
                        'who',
                        'find',
                    ],
                ],
            ],
            'Programmation Web' => [
                [
                    'question' => "Balise pour JavaScript externe ?",
                    'answers' => [
                        '<script src="..."></script>',
                        '<link>',
                        '<style>',
                        '<js>',
                    ],
                ],
                [
                    'question' => "DOM signifie ?",
                    'answers' => [
                        'Document Object Model.',
                        'Direct Object Mapping.',
                        'Data Option Manager.',
                        'Domain Operating Mode.',
                    ],
                ],
                [
                    'question' => "Framework CSS populaire ?",
                    'answers' => [
                        'Tailwind',
                        'SQL',
                        'MySQL',
                        'Python',
                    ],
                ],
                [
                    'question' => "Langage côté serveur ?",
                    'answers' => [
                        'PHP',
                        'HTML',
                        'CSS',
                        'JSON',
                    ],
                ],
                [
                    'question' => "C'est quoi JSON ?",
                    'answers' => [
                        'Format d’échange de données.',
                        'Serveur web.',
                        'SGBD.',
                        'Routeur.',
                    ],
                ],
                [
                    'question' => "Quel langage pour CSS dynamique ?",
                    'answers' => [
                        'SASS',
                        'SQL',
                        'HTML',
                        'FTP',
                    ],
                ],
                [
                    'question' => "Attribut HTML pour un champ obligatoire ?",
                    'answers' => [
                        'required',
                        'disabled',
                        'value',
                        'autoplay',
                    ],
                ],
                [
                    'question' => "Structure type d’un site web ?",
                    'answers' => [
                        'Header, Body, Footer',
                        'Class, Method, Object',
                        'IF, ELSE, WHILE',
                        'Table, Row, Cell',
                    ],
                ],
                [
                    'question' => "Que retourne fetch() en JS ?",
                    'answers' => [
                        'Une promesse',
                        'Une image',
                        'Un PDF',
                        'Une URL',
                    ],
                ],
                [
                    'question' => "Extension pour un fichier HTML ?",
                    'answers' => [
                        '.html',
                        '.php',
                        '.css',
                        '.sql',
                    ],
                ],
            ],
        ];
        foreach ($subjects as $subject => $questions) {
            $quiz = Quiz::create([
                'user_id' => 1,
                'title' => "Quiz $subject",
                'description' => "Testez vos connaissances en $subject.",
            ]);

            foreach ($questions as $q) {
                $type = rand(0, 1) ? 'single' : 'multiple';

                $question = Question::create([
                    'quiz_id' => $quiz->id,
                    'question_text' => "<p><strong>{$q['question']}</strong></p>",
                    'type' => $type,
                ]);

                foreach ($q['answers'] as $index => $answerText) {
                    Answer::create([
                        'question_id' => $question->id,
                        'answer_text' => "<p>$answerText</p>",
                        'is_correct' => $type === 'single' ? ($index === 0) : (rand(0, 1) === 0),
                    ]);
                }
            }
        }


        /*------------------------------------------------------------------------------------
         *                               History
         *------------------------------------------------------------------------------------*/

        $this->call([
            HistorySeeder::class,
        ]);
    }
}
