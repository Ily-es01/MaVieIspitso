<?php

namespace App\Http\Controllers\Enseignant;

use App\Http\Controllers\Controller;
use App\Models\Annonce;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnoncesEnseignantController extends Controller
{
    public function index()
    {
        $enseignantId = Auth::id();
        $annonces = Annonce::where('ID_utilisateur', $enseignantId)
                          ->orderBy('Date_annonce', 'desc')
                          ->paginate(6);
        
        $options = Option::all();
        
        return view('enseignant.annonce-ens', compact('annonces', 'options'));
    }

    public function create()
    {
        $options = Option::all();
        return view('enseignant.create-annonce', compact('options'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Objet_annonce' => 'required|string|max:255',
            'Option_classe' => 'required|string',
            'Contenu_annonce' => 'required|string'
        ]);

        $annonce = new Annonce();
        $annonce->ID_utilisateur = Auth::id();
        $annonce->Objet_annonce = $request->Objet_annonce;
        $annonce->Option_classe = $request->Option_classe;
        $annonce->Contenu_annonce = $request->Contenu_annonce;
        $annonce->Date_annonce = now();
        $annonce->save();

        return redirect()->route('enseignant.annonces.index')->with('success', 'Annonce créée avec succès');
    }

    public function edit(Annonce $annonce)
    {
        if ($annonce->ID_utilisateur !== Auth::id()) {
            return redirect()->back()->with('error', 'Non autorisé');
        }

        $options = Option::all();
        return view('enseignant.edit-annonce', compact('annonce', 'options'));
    }

    public function update(Request $request, Annonce $annonce)
    {
        if ($annonce->ID_utilisateur !== Auth::id()) {
            return redirect()->back()->with('error', 'Non autorisé');
        }

        $request->validate([
            'Objet_annonce' => 'required|string|max:255',
            'Option_classe' => 'required|string',
            'Contenu_annonce' => 'required|string'
        ]);

        $annonce->update([
            'Objet_annonce' => $request->Objet_annonce,
            'Option_classe' => $request->Option_classe,
            'Contenu_annonce' => $request->Contenu_annonce
        ]);

        return redirect()->route('enseignant.annonces.index')->with('success', 'Annonce mise à jour avec succès');
    }

    public function destroy(Annonce $annonce)
    {
        if ($annonce->ID_utilisateur !== Auth::id()) {
            return redirect()->back()->with('error', 'Non autorisé');
        }

        $annonce->delete();
        return redirect()->back()->with('success', 'Annonce supprimée avec succès');
    }
} 