<?php

namespace App\Http\Controllers;

use App\Models\Seance;
use App\Models\Salle;
use App\Models\User;
use App\Models\Filiere;
use App\Models\Option;
use App\Models\Module;
use App\Models\Semestre;
use App\Models\Note;
use App\Models\Annonce;
use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ResponsableController extends Controller
{
    public function index()
    {
         // Récupérer toutes les données nécessaires pour le dashboard
        $seances = Seance::with(['salle', 'module', 'user'])->get();
        $rooms = Salle::all(); // Renommé de $salles à $rooms
        $teachers = User::where('Role', 'enseignant')->get();
        $students = User::where('Role', 'etudiant') // Renommé de $etudiants à $students
                        ->with(['filiere', 'option', 'semestre'])
                        ->get();
        $fields  = Filiere::all(); // Pas besoin de charger options si tu ne les affiches pas ici
        $options = Option::with('filiere')->get();
        $modules = Module::with(['semestre', 'user', 'options'])->get();
        $semestres = Semestre::all();
        $notes = Note::with(['user', 'module'])->get();
        $annonces = Annonce::with('user')->orderBy('Date_annonce','desc')->take(2)->get();
        $allmodules = Module::get();

        // Statistiques pour le dashboard
        $stats = [
            'total_etudiants' => User::where('Role', 'etudiant')->count(),
            'total_enseignants' => User::where('Role', 'enseignant')->count(),
            'total_modules' => Module::count(),
            'total_seances' => Seance::count(),
            'total_salles' => Salle::count(),
            'total_filieres' => Filiere::count(),
        ];

        return view('responsable.index', compact(
            'seances', 'rooms', 'teachers', 'students',
            'fields', 'options', 'modules', 'semestres',
            'notes', 'annonces', 'stats','allmodules'
        ));
    }

    // Gestion des Séances
    public function storeSession(Request $request)
    {
             $request->validate([
            'ID_module' => 'required|exists:module,ID_module',
            'ID_salle' => 'required|exists:salle,ID_salle',
            'ID_utilisateur' => 'required|exists:users,id',
            'jour' => 'required|string',
            'HeureDebut_seance' => 'required|date_format:H:i:s',
            'HeureFin_seance' => 'required|after:HeureDebut_seance',
        ]);

        DB::table('seance')->insert([
            'ID_module' => $request->input('ID_module'),
            'ID_salle' => $request->input('ID_salle'),
            'ID_utilisateur' => $request->input('ID_utilisateur'),
            'jour' => $request->input('jour'),
            'HeureDebut_seance' => $request->input('HeureDebut_seance'),
            'HeureFin_seance' => $request->input('HeureFin_seance'),
        ]);

        return redirect()->back()->with('success', 'Séance créée avec succès');
    }

    public function updateSession(Request $request, $id)
    {
        $seance = Seance::findOrFail($id);

        $validated = $request->validate([
            'ID_module' => 'required|exists:module,ID_module',
            'ID_salle' => 'required|exists:salle,ID_salle',
            'ID_utilisateur' => 'required|exists:users,id',
            'jour' => 'required|string',
            'HeureDebut_seance' => 'required',
            'HeureFin_seance' => 'required|after:HeureDebut_seance',
        ]);

        $seance->update($validated);
        return redirect()->back()->with('success', 'Séance mise à jour avec succès');
    }

    public function deleteSession($id)
    {
        $seance = Seance::where('ID_seance', $id)->firstOrFail();
        $seance->delete();
        return redirect()->back()->with('success', 'Séance supprimée avec succès');
    }

    // Gestion des Salles
    public function storeRoom(Request $request)
    {
         $request->validate([
            'Nom_salle' => 'required|string|unique:salle',
            'Capacite_salle' => 'required|integer|min:1',
        ]);

        DB::table('salle')->insert([
            'Nom_salle' => $request->input('Nom_salle'),
            'Capacite_salle' => $request->input('Capacite_salle'),
        ]);
        return redirect()->back()->with('success', 'Salle créée avec succès');
    }

    public function updateRoom(Request $request, $id)
    {
        $salle = Salle::findOrFail($id);

        $validated = $request->validate([
            'Nom_salle' => 'required|string|unique:salle,Nom_salle,' . $salle->ID_salle . ',ID_salle',
            'Capacite_salle' => 'required|integer|min:1',
        ]);

        $salle->update($validated);
        return redirect()->back()->with('success', 'Salle mise à jour avec succès');
    }

    public function deleteRoom($id)
    {
        $salle = Salle::findOrFail($id);
        $salle->delete();
        return redirect()->back()->with('success', 'Salle supprimée avec succès');
    }

    // Gestion des Enseignants
    public function storeTeacher(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'Prenom' => 'required|string',
            'email' => 'required|email|unique:users',
            'Telephone' => 'nullable|string',
        ]);

        $validated['Role'] = 'enseignant'; // valeur pour l'affichage
        $validated['password'] = bcrypt('pfe');
        $user = User::create($validated);
        $user->assignRole('enseignant');

        return redirect()->back()->with('success', 'Enseignant ajouté avec succès');
    }

    public function updateTeacher(Request $request, $id)
    {
        $enseignant = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string',
            'Prenom' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $enseignant->id,
            'Telephone' => 'nullable|string',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        }

        $enseignant->update($validated);
        return redirect()->back()->with('success', 'Enseignant mis à jour avec succès');
    }

    public function deleteTeacher($id)
    {
        $enseignant = User::findOrFail($id);
        $enseignant->delete();
        return redirect()->back()->with('success', 'Enseignant supprimé avec succès');
    }

    // Gestion des Étudiants
    public function storeStudent(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'Prenom' => 'required|string',
            'email' => 'required|email|unique:users',
            'ID_filiere' => 'required|exists:filiere,ID_filiere',
            'ID_option' => 'nullable|exists:option,ID_option',
            'ID_semestre' => 'required|exists:semestre,ID_semestre',
        ]);

        $validated['Role'] = 'etudiant'; // valeur pour l'affichage
        $validated['password'] = bcrypt('pfe');
        $user = User::create($validated);
        $user->assignRole('etudiant');

        return redirect()->back()->with('success', 'Étudiant ajouté avec succès');
    }

    public function updateStudent(Request $request, $id)
    {
        $etudiant = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string',
            'Prenom' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $etudiant->id,
            'ID_filiere' => 'required|exists:filiere,ID_filiere',
            'ID_option' => 'nullable|exists:option,ID_option',
            'ID_semestre' => 'required|exists:semestre,ID_semestre',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        }

        $etudiant->update($validated);
        return redirect()->back()->with('success', 'Étudiant mis à jour avec succès');
    }

    public function deleteStudent($id)
    {
        $etudiant = User::findOrFail($id);
        $etudiant->delete();
        return redirect()->back()->with('success', 'Étudiant supprimé avec succès');
    }

    // Gestion des Filières
    public function storeField(Request $request)
    {
         $request->validate([
            'Nom_filiere' => 'required|string|unique:filiere',
        ]);

        DB::table('filiere')->insert([
             'Nom_filiere'=> $request->input('Nom_filiere'),
        ]);
        return redirect()->back()->with('success', 'Filière créée avec succès');
    }

    public function updateField(Request $request, $id)
    {
        $filiere = Filiere::findOrFail($id);

        $validated = $request->validate([
            'Nom_filiere' => 'required|string|unique:filiere,Nom_filiere,' . $filiere->ID_filiere . ',ID_filiere',
        ]);

        $filiere->update($validated);
        return redirect()->back()->with('success', 'Filière mise à jour avec succès');
    }

    public function deleteField($id)
    {
        $filiere = Filiere::findOrFail($id);
        $filiere->delete();
        return redirect()->back()->with('success', 'Filière supprimée avec succès');
    }

    // Gestion des Options
    public function storeOption(Request $request)
    {
        $request->validate([
            'Nom_option' => 'required|string|unique:option',
            'ID_filiere' => 'required|exists:filiere,ID_filiere',
        ]);
            DB::table('option')->insert([
                'Nom_option' => $request->input('Nom_option'),
                'ID_filiere' => $request->input('ID_filiere')
            ]);
        return redirect()->back()->with('success', 'Option créée avec succès');
    }

    public function updateOption(Request $request, $id)
    {
        $option = Option::findOrFail($id);

        $validated = $request->validate([
            'Nom_option' => 'required|string|unique:option,Nom_option,' . $option->ID_option . ',ID_option',
            'ID_filiere' => 'required|exists:filiere,ID_filiere',
        ]);

        $option->update($validated);
        return redirect()->back()->with('success', 'Option mise à jour avec succès');
    }

    public function deleteOption($id)
    {
        $option = Option::findOrFail($id);
        $option->delete();
        return redirect()->back()->with('success', 'Option supprimée avec succès');
    }

    // Gestion des Modules
    public function storeModule(Request $request)
    {
        $validated = $request->validate([
            'Nom_module' => 'required|string',
            'ID_semestre' => 'required|exists:semestre,ID_semestre',
            'ID_utilisateur' => 'required|exists:users,id',
            'Type' => 'required|string',
            'Volume_module' => 'nullable|integer',
            'Coefficient_module' => 'nullable|numeric',
        ]);

        DB::table('module')->insert([
        'Nom_module' => $validated['Nom_module'],
        'ID_semestre' => $validated['ID_semestre'],
        'ID_utilisateur' => $validated['ID_utilisateur'],
        'Type' => $validated['Type'],
        'Volume_module' => $validated['Volume_module'] ?? null,
        'Coefficient_module' => $validated['Coefficient_module'] ?? null,
    ]);

        return redirect()->back()->with('success', 'Module créé avec succès');
    }

    public function updateModule(Request $request, $id)
    {
        $module = Module::findOrFail($id);

        $validated = $request->validate([
            'Nom_module' => 'required|string',
            'ID_semestre' => 'required|exists:semestre,ID_semestre',
            'ID_utilisateur' => 'required|exists:users,id',
            'Type' => 'required|string',
            'Volume_module' => 'nullable|integer',
            'Coefficient_module' => 'nullable|numeric',
        ]);

        $module->update($validated);
        return redirect()->back()->with('success', 'Module mis à jour avec succès');
    }

    public function deleteModule($id)
    {
        $module = Module::findOrFail($id);
        $module->delete();
        return redirect()->back()->with('success', 'Module supprimé avec succès');
    }
}
