<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/mesnotes', function(){
    return 'hello' ;
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/home', function () {
        return view('etudiant.index');
    })->name('index');
    Route::get('/notes', function(){
        return view('etudiant.notes');
    })-> name('notes');
    Route::get('/emploiDuTemps',function(){
        return view('etudiant.emploi');
            })->name('emploi');
    Route::get('/annonces',function(){
        return view('etudiant.annonce');
    })->name('annonce');
    Route::get('/profile',function(){
        return view('etudiant.userinfo');
    })->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
