<?php

use App\Models\Quiz;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RoleUserController;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\admin\SheetController;
use App\Http\Controllers\QuizSubmissionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome');
});


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Nouvelle route des quizs
Route::resource('/quizzes', QuizController::class);
Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
Route::get('/quizzes/{quiz}/edit', [QuizController::class, 'edit'])->name('quizzes.edit');
Route::get('/quizzes/library', [QuizController::class, 'library'])->name('quizzes.library');
Route::middleware(['auth'])->post('/quizzes/{quiz}/share', [QuizController::class, 'share'])->name('quizzes.share');

//Les diferentes Routes du QUIZ la manipulation des differente tables
Route::resource('categories', CategoryController::class);

Route::get('/questions/create/{quiz}', [QuestionController::class, 'create'])->name('questions.create');
Route::post('/questions/{quiz}', [QuestionController::class, 'store'])->name('questions.store');
Route::resource('questions', QuestionController::class)->except(['store', 'create']);

Route::resource('answers', AnswerController::class);



Route::middleware(['auth'])->group(function () {
    Route::get('/histories', [HistoryController::class, 'index'])->name('histories.index');
    Route::get('/histories/{history}', [HistoryController::class, 'result'])->name('histories.result');
});
Route::get('history/historique', [HistoryController::class, 'index'])->name('history.historique');



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/quizzes/{quiz}/quiz/evaluate', [QuizSubmissionController::class, 'show'])->name('quiz.evaluate');
    Route::post('/quizzes/{quiz}/submit', [QuizSubmissionController::class, 'store'])->name('quiz.submit');
    Route::get('/quizzes/submission/{id}', [QuizSubmissionController::class, 'result'])->name('quiz.result');

});
Route::get('/quiz/history', [QuizSubmissionController::class, 'history'])->name('quiz.history');




Route::get('/test-quizzes', function () {
    return Quiz::with(['questions.answers'])->get();
});




require __DIR__ . '/auth.php';

/*---------------------------------------------------------------------------------------------
                                Routes liées aux fiches de l'apprenant
-----------------------------------------------------------------------------------------------*/

Route::get('sheets/revision', [SheetController::class, 'showSheetsToReviewed'])->name('sheets.revision');
Route::resource('sheets', controller: SheetController::class)->middleware('auth');





Route::middleware(['auth'])->group(function () {
    //Route::get('/', fn () => Inertia::render('Accueil'));
    Route::get('/compte', fn() => Inertia::render('Compte'));
    Route::get('/quizz', fn() => Inertia::render('Quizz'));
    Route::get('/revision', fn() => Inertia::render('Revision'));
    Route::get('/historique', fn() => Inertia::render('Historique'));
    Route::get('/parametres', fn() => Inertia::render('Parametres'));
});


//Routes pour la gestions des roles des utilisateurs
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/users', [RoleUserController::class, 'index'])->name('admin.users.index');
    Route::put('/users/{user}', [RoleUserController::class, 'update'])->name('admin.users.update');
});


//Route pour marquer le tutoriel comme vu
Route::middleware(['auth'])->post('/tutorial/complete', [TutorialController::class, 'complete']);

//Route pour demander a ntre IA
Route::middleware(['auth'])->group(function () {
    Route::get('/chatbot', function (){
        return Inertia::render('Chatbot/Chatbot');
    })->name('chatbot');
});
//Route::post('/chatbot/ask', [ChatbotController::class, 'ask']);
