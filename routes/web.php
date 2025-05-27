<?php

use App\Http\Controllers\admin\SheetController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\HistoryController;
use App\Models\Quiz;
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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//Les diferentes Routes du QUIZ la manipulation des differente tables
Route::resource('categories', CategoryController::class);
Route::resource('questions', QuestionController::class);
Route::resource('answers', AnswerController::class);
Route::resource('histories', HistoryController::class);
Route::resource('quizzes', QuizController::class);



Route::get('/test-quizzes', function () {
    return Quiz::with(['questions.answers'])->get();
});




require __DIR__.'/auth.php';

/*--------------------------------------------------------------------------------------------- 
                                Routes liées aux fiches de l'apprenant
-----------------------------------------------------------------------------------------------*/

Route::resource('sheets',controller: SheetController::class)->middleware('auth');



Route::middleware(['auth'])->group(function () {
    Route::get('/', fn () => Inertia::render('Accueil'));
    Route::get('/compte', fn () => Inertia::render('Compte'));
    Route::get('/quizz', fn () => Inertia::render('Quizz'));
    Route::get('/revision', fn () => Inertia::render('Revision'));
    Route::get('/historique', fn () => Inertia::render('Historique'));
    Route::get('/parametres', fn () => Inertia::render('Parametres'));
});
