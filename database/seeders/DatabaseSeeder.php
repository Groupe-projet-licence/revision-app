<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Sheet;
use Carbon\Carbon;
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
            "name" => "Darlin",
            "email" => "donfackdarlin@gmail.com",
            'role' => 'admin',
            "password" => Hash::make("670748873")
        ]);
        $user1 = User::factory()->create([
            "name" => "rochelin",
            "email" => "anoumedemrochelin6@gmail.com",
            "password" => Hash::make("698112522"),
            'role' => 'admin'
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
                'next_revision_at' => Carbon::yesterday()
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
                'category_id' => 11,
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
                ['question' => "Qu'est-ce qu'un diagramme de séquence en UML ?", 'answers' => ['Représente les interactions dans le temps.', 'Décrit les classes et leurs attributs.', 'Indique la politique réseau.', 'Définit la base de données.']],
                ['question' => "Que signifie DRY en génie logiciel ?", 'answers' => ['Don’t Repeat Yourself.', 'Do Redirect Yourself.', 'Deploy Rapidly Yearly.', 'Define Reliable YAML.']],
                [
                    'question' => "Rôle du Product Owner dans Scrum ?",
                    'answers' => [
                        '<ul><li>Gère le backlog produit.</li><li>Priorise les fonctionnalités.</li></ul>',
                        '<ul><li>Configure les pare-feux.</li><li>Analyse les logs réseau.</li></ul>',
                    ]
                ],
                [
                    'question' => "Qu'est-ce qu'une User Story ?",
                    'answers' => [
                        '<ul><li>Description fonctionnelle centrée utilisateur.</li><li>Petite fonctionnalité apportant de la valeur.</li></ul>',
                        '<ul><li>Document d’architecture réseau.</li><li>Extrait du modèle de données.</li></ul>',
                    ]
                ],
                ['question' => "C'est quoi la dette technique ?", 'answers' => ['Compromis à court terme sur la qualité.', 'Protocole de cryptage logiciel.', 'Framework d’authentification.', 'Méthode de compression vidéo.']],
                ['question' => "Qu’est-ce que CI/CD ?", 'answers' => ['Intégration et déploiement continus.', 'Compression Interactive.', 'Communication Intranet.', 'Câblage Intelligent.']],
                ['question' => "Quel outil pour gérer le code source ?", 'answers' => ['Git', 'Photoshop', 'Apache', 'MySQL']],
                ['question' => "Un test unitaire sert à quoi ?", 'answers' => ['Tester une fonction isolée.', 'Superviser la charge CPU.', 'Modifier les interfaces réseau.', 'Optimiser les logs serveur.']],
                ['question' => "Qu’est-ce qu’un commit en développement ?", 'answers' => ['Sauvegarde d’un état du code.', 'Ajout d’une route réseau.', 'Création d’une machine virtuelle.', 'Mise à jour du BIOS.']],
                ['question' => "Que signifie UML ?", 'answers' => ['Unified Modeling Language.', 'Unit Measurement Logger.', 'User Management Level.', 'Universal Media Language.']],
            ],
            'Réseau' => [
                ['question' => "Quelle couche du modèle OSI gère les paquets IP ?", 'answers' => ['Couche Réseau.', 'Couche Application.', 'Couche Liaison.', 'Couche Physique.']],
                ['question' => "Qu'est-ce qu'une adresse MAC ?", 'answers' => ['Identifiant unique d’une carte réseau.', 'Adresse logique IP.', 'Protocole de transfert.', 'Type de câble.']],
                [
                    'question' => "Différence entre TCP et UDP ?",
                    'answers' => [
                        '<ul><li>TCP est fiable, UDP est rapide.</li><li>TCP garantit la livraison, UDP non.</li></ul>',
                        '<ul><li>TCP chiffre les données, UDP non.</li><li>UDP est basé sur HTTP.</li></ul>',
                    ]
                ],
                [
                    'question' => "À quoi sert le protocole DNS ?",
                    'answers' => [
                        '<ul><li>Résoudre les noms de domaine.</li><li>Convertir les URL en adresses IP.</li></ul>',
                        '<ul><li>Créer des VLANs.</li><li>Gérer le pare-feu.</li></ul>',
                    ]
                ],
                ['question' => "Quel protocole attribue automatiquement une IP ?", 'answers' => ['DHCP', 'DNS', 'HTTP', 'FTP']],
                ['question' => "Quel outil pour tester la connectivité réseau ?", 'answers' => ['Ping', 'Git', 'MySQL', 'Photoshop']],
                ['question' => "Un switch opère à quelle couche OSI ?", 'answers' => ['Couche Liaison (2)', 'Couche Réseau (3)', 'Couche Transport (4)', 'Couche Application (7)']],
                ['question' => "Quel est le rôle du pare-feu ?", 'answers' => ['Filtrer les connexions réseau.', 'Compiler du code.', 'Analyser les logs.', 'Ouvrir des ports.']],
                ['question' => "Qu’est-ce qu’un VPN ?", 'answers' => ['Réseau privé virtuel sécurisé.', 'Serveur web.', 'Outil de compression.', 'Protocole mail.']],
                ['question' => "Que signifie HTTP ?", 'answers' => ['HyperText Transfer Protocol.', 'Hyper Type Table Packet.', 'High Transfer Terminal Protocol.', 'Host Text Tag Processor.']],
            ],
            'Base de Données' => [
                ['question' => "Qu'est-ce qu'une clé primaire ?", 'answers' => ['Identifie de manière unique une ligne.', 'Représente une relation.', 'Trie les colonnes.', 'Compresse les données.']],
                ['question' => "Quel langage interroge les bases de données ?", 'answers' => ['SQL', 'HTML', 'PHP', 'CSS']],
                [
                    'question' => "À quoi sert une jointure (JOIN) ?",
                    'answers' => [
                        '<ul><li>Combiner plusieurs tables.</li><li>Associer des enregistrements liés.</li></ul>',
                        '<ul><li>Créer un trigger.</li><li>Définir un index.</li></ul>',
                    ]
                ],
                [
                    'question' => "Différence entre DELETE et TRUNCATE ?",
                    'answers' => [
                        '<ul><li>DELETE peut être filtré, TRUNCATE supprime tout.</li><li>DELETE est transactionnel.</li></ul>',
                        '<ul><li>TRUNCATE crypte la table.</li><li>DELETE crée un index.</li></ul>',
                    ]
                ],
                ['question' => "Que fait la commande SELECT ?", 'answers' => ['Récupère des données.', 'Insère des données.', 'Supprime une table.', 'Modifie la structure.']],
                ['question' => "Un index en base de données sert à ?", 'answers' => ['Accélérer les recherches.', 'Chiffrer les champs.', 'Nettoyer les données.', 'Créer des utilisateurs.']],
                ['question' => "Une base relationnelle est basée sur ?", 'answers' => ['Des tables liées.', 'Des fichiers XML.', 'Des structures arborescentes.', 'Des documents JSON.']],
                ['question' => "Que signifie SGBD ?", 'answers' => ['Système de Gestion de Base de Données.', 'Script Général de Bloc de Données.', 'Sécurisation Globale des Bases Distribuées.', 'Serveur Graphique Basique Dédié.']],
                ['question' => "Quel type de clé permet de relier deux tables ?", 'answers' => ['Clé étrangère.', 'Clé primaire.', 'Clé de tri.', 'Clé symétrique.']],
                ['question' => "Quel SGBD est orienté documents ?", 'answers' => ['MongoDB', 'MySQL', 'PostgreSQL', 'Oracle']],
            ],
            'Systèmes d’Exploitation' => [
                ['question' => "Quel est le rôle du noyau (kernel) ?", 'answers' => ['Gérer l’interaction matériel-logiciel.', 'Afficher l’interface.', 'Dessiner les fenêtres.', 'Créer les fichiers.']],
                ['question' => "Que fait un planificateur de tâches ?", 'answers' => ['Attribue le temps CPU aux processus.', 'Supprime les fichiers.', 'Chiffre les données.', 'Affiche les logs.']],
                [
                    'question' => "Différence entre processus et thread ?",
                    'answers' => [
                        '<ul><li>Un thread est plus léger qu’un processus.</li><li>Un processus peut contenir plusieurs threads.</li></ul>',
                        '<ul><li>Un thread remplace un noyau.</li><li>Un processus ne contient pas de mémoire.</li></ul>',
                    ]
                ],
                [
                    'question' => "Que signifie multitâche ?",
                    'answers' => [
                        '<ul><li>Exécuter plusieurs tâches simultanément.</li><li>Partager les ressources CPU.</li></ul>',
                        '<ul><li>Ouvrir plusieurs fenêtres.</li><li>Installer plusieurs OS.</li></ul>',
                    ]
                ],
                ['question' => "Quel est le rôle du système de fichiers ?", 'answers' => ['Organiser les fichiers sur le disque.', 'Compresser les données.', 'Sécuriser les connexions.', 'Compiler du code.']],
                ['question' => "Que signifie BSOD sous Windows ?", 'answers' => ['Écran bleu de la mort.', 'Bug système opéré.', 'Blocage serveur on-demand.', 'Boîte système ouverte.']],
                ['question' => "Une interruption matérielle sert à ?", 'answers' => ['Signaler un événement au CPU.', 'Effacer un fichier.', 'Afficher une alerte.', 'Sauvegarder des logs.']],
                ['question' => "Que fait la commande `ls` sous Linux ?", 'answers' => ['Liste les fichiers.', 'Lance le système.', 'Lie un fichier.', 'Stoppe un processus.']],
                ['question' => "Un deadlock est ?", 'answers' => ['Blocage mutuel entre processus.', 'Erreur mémoire.', 'Virus système.', 'Fuite de mémoire.']],
                ['question' => "Qu’est-ce qu’une partition ?", 'answers' => ['Section du disque dur.', 'Type de processus.', 'Protocole réseau.', 'Unité RAM.']],
            ]
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
                        'is_correct' => $index === 0,
                    ]);
                }
            }
        }
    }
}
