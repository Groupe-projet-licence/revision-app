<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Quiz App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Quiz App</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="{{ route('quizzes.index') }}" class="nav-link">Quizzes</a></li>
                    <li class="nav-item"><a href="{{ route('categories.index') }}" class="nav-link">Catégories</a></li>
                    <li class="nav-item"><a href="{{ route('questions.index') }}" class="nav-link">Questions</a></li>
                    <li class="nav-item"><a href="{{ route('answers.index') }}" class="nav-link">Réponses</a></li>
                    <li class="nav-item"><a href="{{ route('histories.index') }}" class="nav-link">Historique</a></li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="text-center mt-5 mb-3">
        <p>© {{ date('Y') }} - Quiz App</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</body>
</html>
