<?php

use App\Http\Controllers\QuizController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');
// If you have a controller
Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot');

// OR if it's just a simple view
Route::view('/chatbot', 'chatbot')->name('chatbot');
// These are the important ones for your quiz
Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');
Route::post('/quiz/submit', [QuizController::class, 'submit'])->name('quiz.submit');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// If you want everyone to see it
Route::get('/quiz/history', [App\Http\Controllers\QuizController::class, 'history'])->name('quiz.history');

// OR, if you only want logged-in users to see it (Recommended)
Route::middleware(['auth'])->group(function () {
    Route::get('/quiz/history', [App\Http\Controllers\QuizController::class, 'history'])->name('quiz.history');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
