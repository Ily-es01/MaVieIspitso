<?php

namespace App\Http\Controllers\Etudiant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;
use App\Models\Module;
use App\Models\Option;
use App\Models\Semestre;
use Illuminate\Support\Facades\Log;

class NoteController extends Controller
{
    public function afficherNotes(Request $request)
    {
        $idEtudiant = Auth::id();
        $optionEtudiant = Option::with('modules')->find(Auth::user()->ID_option);
        
        // Récupérer tous les semestres disponibles et les trier par numéro de semestre
        $semestres = Semestre::orderBy('Semestre_numero')->get();
        
        // Récupérer le semestre de l'étudiant ou utiliser celui sélectionné dans le formulaire
        $semestreActuel = Semestre::find(Auth::user()->ID_semestre);
        
        // Vérifier si un semestre a été sélectionné dans le formulaire
        $semestreSelectionne = null;
        if ($request->has('semester')) {
            $semestreSelectionne = Semestre::find($request->input('semester'));
        }
        
        // Utiliser le semestre sélectionné ou celui de l'étudiant
        $semestreCourant = $semestreSelectionne ?? $semestreActuel;

        // Récupérer tous les modules du semestre sélectionné
        $modulesSemestre = Module::where('ID_semestre', $semestreCourant->ID_semestre)->get();
        
        // Récupérer les modules de l'option de l'étudiant
        $modulesOption = $optionEtudiant->modules->pluck('ID_module')->toArray();

        // Ne plus filtrer par option - afficher tous les modules du semestre
        $modulesActifs = $modulesSemestre;

        // Récupérer les notes par module
        $notesParModules = $modulesActifs->map(function ($module) use ($idEtudiant) {
            $dsNote = Note::where('ID_module', $module->ID_module)
                          ->where('ID_utilisateur', $idEtudiant)
                          ->where('Type_note', 'ds')
                          ->value('Valeur_note');

            $examNote = Note::where('ID_module', $module->ID_module)
                            ->where('ID_utilisateur', $idEtudiant)
                            ->where('Type_note', 'exam')
                            ->value('Valeur_note');
                            
            $rattNote = Note::where('ID_module', $module->ID_module)
                            ->where('ID_utilisateur', $idEtudiant)
                            ->where('Type_note', 'ratt')
                            ->value('Valeur_note');

            $noteFinale = null;
            if ($dsNote !== null && $examNote !== null) {
                $noteFinale = round(($dsNote + $examNote) / 2, 2);
                
                // Si la note finale est inférieure à 10 et qu'il y a une note de rattrapage
                if ($noteFinale < 10 && $rattNote !== null) {
                    // La nouvelle note finale est la moyenne entre le DS et le rattrapage
                    $noteFinale = round(($dsNote + $rattNote) / 2, 2);
                    
                    // Si cette nouvelle moyenne est supérieure à 10, on la plafonne à 10
                    if ($noteFinale > 10) {
                        $noteFinale = 10;
                    }
                }
            }

            return [
                'module' => $module->Nom_module,
                'module_id' => $module->ID_module,
                'coefficient' => $module->Coefficient_module,
                'ds' => $dsNote,
                'exam' => $examNote,
                'ratt' => $rattNote,
                'final' => $noteFinale,
            ];
        });

        // Calculer les statistiques du semestre avec les coefficients
        $moyenneGenerale = 0;
        $meilleureNote = 0;
        $modulesValides = 0;
        $nombreModules = count($notesParModules);
        $totalCoefficients = 0;
        $totalPonderation = 0;

        if ($nombreModules > 0) {
            // Calculer la moyenne pondérée
            foreach ($notesParModules as $note) {
                if (isset($note['final']) && isset($note['coefficient']) && $note['coefficient'] > 0) {
                    $totalPonderation += $note['final'] * $note['coefficient'];
                    $totalCoefficients += $note['coefficient'];
                }
            }

            // Calculer la moyenne
            if ($totalCoefficients > 0) {
                $moyenneGenerale = round($totalPonderation / $totalCoefficients, 2);
            }

            // Trouver la meilleure note
            $notesFinales = $notesParModules->pluck('final')->filter(function ($note) {
                return $note !== null;
            });
            
            if ($notesFinales->count() > 0) {
                $meilleureNote = $notesFinales->max();
                $modulesValides = $notesFinales->filter(function ($note) {
                    return $note >= 10;
                })->count();
            }
        }

        return view('etudiant.notes', compact(
            'notesParModules',
            'semestreCourant',
            'semestres',
            'moyenneGenerale',
            'meilleureNote',
            'modulesValides',
            'nombreModules'
        ));
    }
}
