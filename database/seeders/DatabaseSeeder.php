<?php

namespace Database\Seeders;

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
    public function run(): void
    {
        // Users
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

        // Categories
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

        // Sheets
        $sheets = [
            [
                'title' => 'Relational Databases',
                'category_id' => 19,
                'content' => '
                    <h1><strong>Relational Databases</strong></h1>
                    <p>A <strong>relational database</strong> stores data in related tables.</p>
                    <h2><strong>Core Elements</strong></h2>
                    <ul>
                        <li><strong>Primary Key:</strong> unique identifier.</li>
                        <li><strong>Foreign Key:</strong> external reference.</li>
                        <li><strong>Index:</strong> query speed-up.</li>
                    </ul>
                    <h2><strong>SQL Language</strong></h2>
                    <pre>CREATE TABLE users ( id INT PRIMARY KEY, name VARCHAR(50) );</pre>
                    <h2><strong>Transactions</strong></h2>
                    <ul>
                        <li><strong>Atomicity</strong></li>
                        <li><strong>Consistency</strong></li>
                        <li><strong>Isolation</strong></li>
                        <li><strong>Durability</strong></li>
                    </ul>
                    <blockquote>ACID is a fundamental concept of transactional databases.</blockquote>
                    <hr>
                    <h2><strong>NoSQL Models</strong></h2>
                    <p>For unstructured or large data: <strong>MongoDB, Redis…</strong></p>
                ',
                'next_revision_at' => Carbon::yesterday()
            ],
            [
                'title' => 'Software Lifecycle',
                'category_id' => 2,
                'content' => '
                    <h1><strong>Software Lifecycle</strong></h1>
                    <p>Includes several phases ensuring software quality.</p>
                    <h2><strong>Phases</strong></h2>
                    <ul>
                        <li>Requirement Analysis</li>
                        <li>Design (UML)</li>
                        <li>Implementation</li>
                        <li>Testing</li>
                        <li>Deployment</li>
                        <li>Maintenance</li>
                    </ul>
                    <h2><strong>Development Models</strong></h2>
                    <ul>
                        <li>Waterfall</li>
                        <li>V-Model</li>
                        <li>Agile (Scrum)</li>
                        <li>Iterative</li>
                    </ul>
                    <h2><strong>UML</strong></h2>
                    <ul>
                        <li>Class Diagrams</li>
                        <li>Use Cases</li>
                        <li>Sequence Diagrams</li>
                    </ul>
                    <blockquote>Diagrams facilitate system understanding.</blockquote>
                    <hr>
                    <p>Apply <strong>DRY</strong> and <strong>KISS</strong> principles.</p>
                ',
            ],
            [
                'title' => 'Mobile Programming: Key Concepts',
                'category_id' => 27,
                'content' => '
                    <h1><strong>Mobile Programming</strong></h1>
                    <p>Development of mobile apps considering: battery, connectivity, screen sizes...</p>
                    <h2><strong>Platforms</strong></h2>
                    <ul>
                        <li>Android: Java / Kotlin</li>
                        <li>iOS: Swift</li>
                        <li>Cross-Platform: Flutter, React Native</li>
                    </ul>
                    <h2><strong>MVC Architecture</strong></h2>
                    <ul>
                        <li>Model: data</li>
                        <li>View: interface</li>
                        <li>Controller: business logic</li>
                    </ul>
                    <h2><strong>Android Code Example</strong></h2>
                    <pre>
Button button = findViewById(R.id.myButton);
button.setOnClickListener(v -> {
  Toast.makeText(this, "Hello!", Toast.LENGTH_SHORT).show();
});
                    </pre>
                    <hr>
                    <p>Use <strong>REST APIs</strong> for remote services.</p>
                ',
            ],
            [
                'title' => 'Computer Networks: Basics',
                'category_id' => 11,
                'content' => '
                    <h1><strong>Computer Networks</strong></h1>
                    <p>Allows devices to connect and exchange data.</p>
                    <h2><strong>Types</strong></h2>
                    <ul>
                        <li>LAN</li>
                        <li>MAN</li>
                        <li>WAN (Internet)</li>
                    </ul>
                    <h2><strong>Hardware</strong></h2>
                    <ul>
                        <li>Switch</li>
                        <li>Router</li>
                        <li>Access Point</li>
                    </ul>
                    <h2><strong>IP Addresses</strong></h2>
                    <ul>
                        <li>IPv4: 192.168.0.1</li>
                        <li>IPv6: 2001:db8::1</li>
                    </ul>
                    <h2><strong>Protocols</strong></h2>
                    <ul>
                        <li>TCP/IP</li>
                        <li>HTTP</li>
                        <li>DNS</li>
                    </ul>
                    <pre>ping www.google.com</pre>
                    <hr>
                    <blockquote>Network security protects user resources.</blockquote>
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

        // Quizzes
        $user1->quizzes()->createMany([
            ['title' => 'Laravel', 'description' => 'My awesome description of the Laravel framework'],
            ['title' => 'Angular', 'description' => 'My awesome description of the Angular framework'],
            ['title' => 'ReactJs', 'description' => 'My awesome description of the ReactJs library']
        ]);

        Quiz::find(1)->questions()->createMany([
            ['question_text' => 'What is Laravel?', 'type' => 'single'],
            ['question_text' => 'What can be done with Laravel?', 'type' => 'multiple'],
            ['question_text' => 'Which technologies are similar to Laravel?', 'type' => 'multiple'],
            ['question_text' => 'Why does Laravel use the Blade template engine?', 'type' => 'single'],
            ['question_text' => 'Which file in a Laravel project manages environment-specific config variables?', 'type' => 'single'],
        ]);

        Question::find(1)->answers()->createMany([
            ['answer_text' => 'A framework', 'is_correct' => true],
            ['answer_text' => 'A library', 'is_correct' => false],
            ['answer_text' => 'Another name for React', 'is_correct' => false],
        ]);

        Question::find(2)->answers()->createMany([
            ['answer_text' => 'Build web applications', 'is_correct' => true],
            ['answer_text' => 'Create APIs to handle backend logic in a project', 'is_correct' => true],
            ['answer_text' => 'Version code', 'is_correct' => false],
            ['answer_text' => 'Implement an authentication system', 'is_correct' => true],
        ]);

        Question::find(3)->answers()->createMany([
            ['answer_text' => 'Angular', 'is_correct' => true],
            ['answer_text' => 'Spring Boot', 'is_correct' => true],
            ['answer_text' => 'React', 'is_correct' => false],
        ]);

        Question::find(4)->answers()->createMany([
            ['answer_text' => 'To simplify programming', 'is_correct' => false],
            ['answer_text' => 'As a model', 'is_correct' => false],
            ['answer_text' => 'To ease controller creation', 'is_correct' => false],
            ['answer_text' => 'For the view in MVC', 'is_correct' => true],
        ]);

        Question::find(5)->answers()->createMany([
            ['answer_text' => '.env.example', 'is_correct' => false],
            ['answer_text' => '.env.local', 'is_correct' => false],
            ['answer_text' => '.env', 'is_correct' => true],
            ['answer_text' => '.config', 'is_correct' => false],
        ]);

        
        $subjects = [
            'Software Engineering' => [
                [
                    'question' => 'What is a sequence diagram in UML?',
                    'answers' => [
                        'Represents interactions over time.',
                        'Describes classes and their attributes.',
                        'Indicates network policy.',
                        'Defines the database.',
                    ],
                ],
                [
                    'question' => 'What does DRY mean in software engineering?',
                    'answers' => [
                        'Don’t Repeat Yourself.',
                        'Do Redirect Yourself.',
                        'Deploy Rapidly Yearly.',
                        'Define Reliable YAML.',
                    ],
                ],
                [
                    'question' => 'Role of the Product Owner in Scrum?',
                    'answers' => [
                        '<ul><li>Manages the product backlog.</li><li>Prioritizes features.</li></ul>',
                        '<ul><li>Configures firewalls.</li><li>Analyzes network logs.</li></ul>',
                    ],
                ],
                [
                    'question' => 'What is a User Story?',
                    'answers' => [
                        '<ul><li>User-centered functional description.</li><li>Small feature delivering value.</li></ul>',
                        '<ul><li>Network architecture document.</li><li>Excerpt from data model.</li></ul>',
                    ],
                ],
                [
                    'question' => 'What is technical debt?',
                    'answers' => [
                        'Short-term compromise on quality.',
                        'Software encryption protocol.',
                        'Authentication framework.',
                        'Video compression method.',
                    ],
                ],
                [
                    'question' => 'What is CI/CD?',
                    'answers' => [
                        'Continuous Integration and Deployment.',
                        'Interactive Compression.',
                        'Intranet Communication.',
                        'Intelligent Cabling.',
                    ],
                ],
                [
                    'question' => 'Which tool is used to manage source code?',
                    'answers' => [
                        'Git',
                        'Photoshop',
                        'Apache',
                        'MySQL',
                    ],
                ],
                [
                    'question' => 'What is the purpose of a unit test?',
                    'answers' => [
                        'Test an isolated function.',
                        'Monitor CPU load.',
                        'Modify network interfaces.',
                        'Optimize server logs.',
                    ],
                ],
                [
                    'question' => 'What is a commit in development?',
                    'answers' => [
                        'Save a state of the code.',
                        'Add a network route.',
                        'Create a virtual machine.',
                        'Update the BIOS.',
                    ],
                ],
                [
                    'question' => 'What does UML stand for?',
                    'answers' => [
                        'Unified Modeling Language.',
                        'Unit Measurement Logger.',
                        'User Management Level.',
                        'Universal Media Language.',
                    ],
                ],
            ],
            'Networking' => [
                [
                    'question' => 'Which OSI layer manages IP packets?',
                    'answers' => [
                        'Network Layer.',
                        'Application Layer.',
                        'Data Link Layer.',
                        'Physical Layer.',
                    ],
                ],
                [
                    'question' => 'What is a MAC address?',
                    'answers' => [
                        'Unique identifier of a network card.',
                        'Logical IP address.',
                        'Transfer protocol.',
                        'Type of cable.',
                    ],
                ],
                [
                    'question' => 'Difference between TCP and UDP?',
                    'answers' => [
                        '<ul><li>TCP is reliable, UDP is fast.</li><li>TCP ensures delivery, UDP does not.</li></ul>',
                        '<ul><li>TCP encrypts data, UDP does not.</li><li>UDP is based on HTTP.</li></ul>',
                    ],
                ],
                [
                    'question' => 'What is the purpose of the DNS protocol?',
                    'answers' => [
                        '<ul><li>Resolve domain names.</li><li>Convert URLs to IP addresses.</li></ul>',
                        '<ul><li>Create VLANs.</li><li>Manage firewall.</li></ul>',
                    ],
                ],
                [
                    'question' => 'Which protocol automatically assigns an IP?',
                    'answers' => [
                        'DHCP',
                        'DNS',
                        'HTTP',
                        'FTP',
                    ],
                ],
                [
                    'question' => 'Which tool tests network connectivity?',
                    'answers' => [
                        'Ping',
                        'Git',
                        'MySQL',
                        'Photoshop',
                    ],
                ],
                [
                    'question' => 'At which OSI layer does a switch operate?',
                    'answers' => [
                        'Data Link Layer (2)',
                        'Network Layer (3)',
                        'Transport Layer (4)',
                        'Application Layer (7)',
                    ],
                ],
                [
                    'question' => 'What is the role of a firewall?',
                    'answers' => [
                        'Filter network connections.',
                        'Compile code.',
                        'Analyze logs.',
                        'Open ports.',
                    ],
                ],
                [
                    'question' => 'What is a VPN?',
                    'answers' => [
                        'Secure virtual private network.',
                        'Web server.',
                        'Compression tool.',
                        'Mail protocol.',
                    ],
                ],
                [
                    'question' => 'What does HTTP stand for?',
                    'answers' => [
                        'HyperText Transfer Protocol.',
                        'Hyper Type Table Packet.',
                        'High Transfer Terminal Protocol.',
                        'Host Text Tag Processor.',
                    ],
                ],
            ],
            'Databases' => [
                [
                    'question' => 'What is a primary key?',
                    'answers' => [
                        'Uniquely identifies a row.',
                        'Represents a relationship.',
                        'Sorts columns.',
                        'Compresses data.',
                    ],
                ],
                [
                    'question' => 'Which language queries databases?',
                    'answers' => [
                        'SQL',
                        'HTML',
                        'PHP',
                        'CSS',
                    ],
                ],
                [
                    'question' => 'What is a JOIN used for?',
                    'answers' => [
                        '<ul><li>Combine multiple tables.</li><li>Associate related records.</li></ul>',
                        '<ul><li>Create a trigger.</li><li>Define an index.</li></ul>',
                    ],
                ],
                [
                    'question' => 'Difference between DELETE and TRUNCATE?',
                    'answers' => [
                        '<ul><li>DELETE can be filtered, TRUNCATE deletes all.</li><li>DELETE is transactional.</li></ul>',
                        '<ul><li>TRUNCATE encrypts the table.</li><li>DELETE creates an index.</li></ul>',
                    ],
                ],
                [
                    'question' => 'What does the SELECT command do?',
                    'answers' => [
                        'Retrieves data.',
                        'Inserts data.',
                        'Deletes a table.',
                        'Modifies structure.',
                    ],
                ],
                [
                    'question' => 'What is the purpose of an index in a database?',
                    'answers' => [
                        'Speed up searches.',
                        'Encrypt fields.',
                        'Clean data.',
                        'Create users.',
                    ],
                ],
                [
                    'question' => 'A relational database is based on?',
                    'answers' => [
                        'Related tables.',
                        'XML files.',
                        'Tree structures.',
                        'JSON documents.',
                    ],
                ],
                [
                    'question' => 'What does DBMS stand for?',
                    'answers' => [
                        'Database Management System.',
                        'General Block Script.',
                        'Global Securing of Distributed Databases.',
                        'Basic Dedicated Graphic Server.',
                    ],
                ],
                [
                    'question' => 'Which key links two tables?',
                    'answers' => [
                        'Foreign key.',
                        'Primary key.',
                        'Sort key.',
                        'Symmetric key.',
                    ],
                ],
                [
                    'question' => 'Which DBMS is document-oriented?',
                    'answers' => [
                        'MongoDB',
                        'MySQL',
                        'PostgreSQL',
                        'Oracle',
                    ],
                ],
            ],
            'Operating Systems' => [
                [
                    'question' => 'What is the role of the kernel?',
                    'answers' => [
                        'Manage hardware-software interaction.',
                        'Display the interface.',
                        'Draw windows.',
                        'Create files.',
                    ],
                ],
                [
                    'question' => 'What does a task scheduler do?',
                    'answers' => [
                        'Allocates CPU time to processes.',
                        'Deletes files.',
                        'Encrypts data.',
                        'Displays logs.',
                    ],
                ],
                [
                    'question' => 'Difference between process and thread?',
                    'answers' => [
                        '<ul><li>A thread is lighter than a process.</li><li>A process can contain multiple threads.</li></ul>',
                        '<ul><li>A thread replaces a kernel.</li><li>A process has no memory.</li></ul>',
                    ],
                ],
                [
                    'question' => 'What does multitasking mean?',
                    'answers' => [
                        '<ul><li>Execute multiple tasks simultaneously.</li><li>Share CPU resources.</li></ul>',
                        '<ul><li>Open multiple windows.</li><li>Install several OSes.</li></ul>',
                    ],
                ],
                [
                    'question' => 'What is the role of a file system?',
                    'answers' => [
                        'Organize files on the disk.',
                        'Compress data.',
                        'Secure connections.',
                        'Compile code.',
                    ],
                ],
                [
                    'question' => 'What does BSOD stand for in Windows?',
                    'answers' => [
                        'Blue Screen of Death.',
                        'System Bug Operated.',
                        'On-demand Server Block.',
                        'Open System Box.',
                    ],
                ],
                [
                    'question' => 'What is a hardware interrupt for?',
                    'answers' => [
                        'Signal an event to the CPU.',
                        'Delete a file.',
                        'Show an alert.',
                        'Save logs.',
                    ],
                ],
                [
                    'question' => 'What does the `ls` command do in Linux?',
                    'answers' => [
                        'Lists files.',
                        'Launches the system.',
                        'Links a file.',
                        'Stops a process.',
                    ],
                ],
                [
                    'question' => 'What is a deadlock?',
                    'answers' => [
                        'Mutual blocking between processes.',
                        'Memory error.',
                        'System virus.',
                        'Memory leak.',
                    ],
                ],
                [
                    'question' => 'What is a partition?',
                    'answers' => [
                        'Section of a hard drive.',
                        'Type of process.',
                        'Network protocol.',
                        'RAM unit.',
                    ],
                ],
            ],
        ];

        foreach ($subjects as $subject => $questions) {
            $quiz = Quiz::create([
                'user_id' => 1,
                'title' => "Quiz $subject",
                'description' => "Test your knowledge in $subject.",
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
