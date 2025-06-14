<?php

use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Enseignant\EmploiProfController;
use App\Http\Controllers\Enseignant\NoteGestionController;
use App\Http\Controllers\Enseignant\profIndexController;
use App\Http\Controllers\Etudiant\AnnoncesController;
use App\Http\Controllers\Etudiant\NoteController;
use App\Http\Controllers\Etudiant\SeanceController;
use App\Http\Controllers\Etudiant\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\enseignant;
use App\Http\Middleware\etudiant;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Etudiant\IndexController;
use App\Http\Controllers\Auth;
use App\Models\User;
use App\Models\Option;
use App\Http\Controllers\Enseignant\EnseignantController;
use App\Http\Controllers\Enseignant\NotesController;
use App\Http\Controllers\Enseignant\AnnoncesEnseignantController;
use App\Http\Controllers\Enseignant\EmploiController;
use App\Http\Controllers\Enseignant\ProfileController as EnseignantProfileController;
use App\Http\Controllers\ResponsableController;

Route::get('/respo',[ResponsableController::class,'index'])->name('respo.index');
Route::get('/', function () {
    return view('auth.login');
});
// routes/web.php
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->middleware('guest')->name('password.update');



Route::middleware([etudiant::class])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::get('/etudiant/home', [IndexController::class,'index'])->name('etudiant.index');

    Route::get('/notes', [NoteController::class, 'afficherNotes'])->name('etudiant.notes');

    Route::get('/emploiDuTemps', [SeanceController::class,'emploidutemps']
            )->name('emploi');
    Route::get('/annonces',[AnnoncesController::class,'allannonces'])->name('annonce');
    Route::get('/profile/edit/{id}', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{id}', [UserController::class, 'update'])->name('etudiants.update');


});

Route::middleware(['auth', 'role:enseignant'])->group(function () {
    Route::get('/enseignant/home', [profIndexController::class, 'indexProf'])->name('enseignant.index');
    Route::get('/gestion/notes', [NoteGestionController::class, 'index'])->name('enseignant.notes.index');
    Route::post('/gestion/notes', [NoteGestionController::class, 'store'])->name('enseignant.notes.store');
    Route::put('/gestion/notes/{note}', [NoteGestionController::class, 'update'])->name('enseignant.notes.update');
    Route::delete('/gestion/notes/{note}', [NoteGestionController::class, 'destroy'])->name('enseignant.notes.destroy');

    // Routes pour la gestion des annonces
    Route::get('/enseignant/annonces', [AnnoncesEnseignantController::class, 'index'])->name('enseignant.annonces.index');
    Route::get('/enseignant/annonces/create', [AnnoncesEnseignantController::class, 'create'])->name('enseignant.annonces.create');
    Route::post('/enseignant/annonces', [AnnoncesEnseignantController::class, 'store'])->name('enseignant.annonces.store');
    Route::get('/enseignant/annonces/{annonce}/edit', [AnnoncesEnseignantController::class, 'edit'])->name('enseignant.annonces.edit');
    Route::put('/enseignant/annonces/{annonce}', [AnnoncesEnseignantController::class, 'update'])->name('enseignant.annonces.update');
    Route::delete('/enseignant/annonces/{annonce}', [AnnoncesEnseignantController::class, 'destroy'])->name('enseignant.annonces.destroy');

    Route::get('/enseignant/emploi', [EmploiProfController::class, 'index'])->name('enseignant.emploi');

    // Routes pour le profil de l'enseignant
    Route::get('/enseignant/profile/{id}', [EnseignantProfileController::class, 'edit'])->name('enseignant.profile.edit');
    Route::put('/enseignant/profile/{id}', [EnseignantProfileController::class, 'update'])->name('enseignant.profile.update');
});


// Test route simplifié pour les uploads
Route::prefix('test')->group(function() {
    Route::get('/upload', function() {
        return view('test-upload');
    })->name('test.upload');

    Route::post('/upload', function(Illuminate\Http\Request $request) {
        if (!$request->hasFile('test_image') || !$request->file('test_image')->isValid()) {
            return back()->with('error', 'Aucun fichier valide téléchargé');
        }

        try {
            $file = $request->file('test_image');
            $path = $file->store('test-images', 'public');
            return "Upload réussi: " . $path .
                "<br><img src='" . asset('storage/' . $path) . "' style='max-width:300px;'>";
        } catch (\Exception $e) {
            return "Erreur: " . $e->getMessage();
        }
    })->name('test.upload.action');
});

Route::get('/api/etudiants/{optionId}', function ($optionId) {
    try {
        $students = User::where('ID_option', $optionId)
                       ->where('role', 'etudiant')
                       ->select('id', 'name', 'Prenom')
                       ->get();

        return response()->json($students);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

Route::middleware(['auth', 'role:admin'])->group(function () {
// Routes pour le responsable
    Route::get('/responsable', [ResponsableController::class, 'index'])->name('responsable.index');

    // Routes pour les séances
    Route::post('/sessions', [ResponsableController::class, 'storeSession'])->name('responsable.sessions.store');
    Route::put('/sessions/{session}', [ResponsableController::class, 'updateSession'])->name('responsable.sessions.update');
    Route::delete('/sessions/{session}', action: [ResponsableController::class, 'deleteSession'])->name('responsable.sessions.delete');

    // Routes pour les salles
    Route::post('/rooms', [ResponsableController::class, 'storeRoom'])->name('responsable.rooms.store');
    Route::put('/rooms/{room}', [ResponsableController::class, 'updateRoom'])->name('responsable.rooms.update');
    Route::delete('/rooms/{room}', [ResponsableController::class, 'deleteRoom'])->name('responsable.rooms.delete');

    // Routes pour les enseignants
    Route::post('/teachers', [ResponsableController::class, 'storeTeacher'])->name('responsable.teachers.store');
    Route::put('/teachers/{teacher}', [ResponsableController::class, 'updateTeacher'])->name('responsable.teachers.update');
    Route::delete('/teachers/{teacher}', [ResponsableController::class, 'deleteTeacher'])->name('responsable.teachers.delete');

    // Routes pour les étudiants
    Route::post('/students', [ResponsableController::class, 'storeStudent'])->name('responsable.students.store');
    Route::put('/students/{student}', [ResponsableController::class, 'updateStudent'])->name('responsable.students.update');
    Route::delete('/students/{student}', [ResponsableController::class, 'deleteStudent'])->name('responsable.students.delete');

    // Routes pour les filières
    Route::post('/fields', [ResponsableController::class, 'storeField'])->name('responsable.fields.store');
    Route::put('/fields/{field}', [ResponsableController::class, 'updateField'])->name('responsable.fields.update');
    Route::delete('/fields/{field}', [ResponsableController::class, 'deleteField'])->name('responsable.fields.delete');

    // Routes pour les options
    Route::post('/responsable/options/store', [ResponsableController::class, 'storeOption'])->name('responsable.options.store');
    Route::put('/options/{option}', [ResponsableController::class, 'updateOption'])->name('responsable.options.update');
    Route::delete('/options/{option}', [ResponsableController::class, 'deleteOption'])->name('responsable.options.delete');

    // Routes pour les modules
    Route::post('/modules', [ResponsableController::class, 'storeModule'])->name('responsable.modules.store');
    Route::put('/modules/{module}', [ResponsableController::class, 'updateModule'])->name('responsable.modules.update');
    Route::delete('/modules/{module}', [ResponsableController::class, 'deleteModule'])->name('responsable.modules.delete');
});
require __DIR__.'/auth.php';
