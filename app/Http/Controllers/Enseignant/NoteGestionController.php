<?php

namespace App\Http\Controllers\Enseignant;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Note;
use App\Models\Option;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteGestionController extends Controller
{
    public function index(Request $request)
    {
        $query = Note::with(['user', 'module']);

        if ($request->filled('search')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('option')) {
            $query->whereHas('module', function($q) use ($request) {
                $q->where('ID_option', $request->option);
            });
        }

        if ($request->filled('module')) {
            $query->where('ID_module', $request->module);
        }

        return view('enseignant.note-gestion', [
            'notes' => $query->orderBy('Date_note', 'desc')->paginate(10),
            'etudiants' => User::role('etudiant')->get(),
            'modules' => Module::all(),
            'options' => Option::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'etudiant_id' => 'required|exists:users,id',
            'module_id' => 'required|exists:module,ID_module',
            'type_note' => 'required|in:ds,exam',
            'session_note' => 'required|in:normale,rattrapage',
            'valeur_note' => 'required|numeric|min:0|max:20'
        ]);

        if (!$this->isAuthorizedForModule($request->module_id)) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        Note::create([
            'ID_utilisateur' => $request->etudiant_id,
            'ID_module' => $request->module_id,
            'Type_note' => strtolower($request->type_note),
            'Session_note' => strtolower($request->session_note),
            'Valeur_note' => $request->valeur_note,
            'Date_note' => now()
        ]);

        return response()->json(['success' => true]);
    }

    public function update(Request $request, Note $note)
    {
        $request->validate([
            'valeur_note' => 'required|numeric|min:0|max:20',
            'type_note' => 'required|in:ds,exam',
            'session_note' => 'required|in:normale,rattrapage'
        ]);

        if (!$this->isAuthorizedForModule($note->ID_module)) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        $note->update([
            'Type_note' => strtolower($request->type_note),
            'Session_note' => strtolower($request->session_note),
            'Valeur_note' => $request->valeur_note
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy(Note $note)
    {
        if (!$this->isAuthorizedForModule($note->ID_module)) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        $note->delete();
        return response()->json(['success' => true]);
    }

    private function isAuthorizedForModule($moduleId)
    {
        return Module::where('ID_module', $moduleId)
            ->where('ID_utilisateur', Auth::id())
            ->exists();
    }
} 