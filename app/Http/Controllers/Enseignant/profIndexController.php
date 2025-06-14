<?php

namespace App\Http\Controllers\Enseignant;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Option;
use App\Models\User;
use App\Models\Seance;
use Auth;
use Illuminate\Http\Request;

class profIndexController extends Controller
{
        public function indexProf(){
        $enseignantId  = Auth::id();
    // Charger les options avec les modules enseignés par le prof, les semestres et les étudiants
    $options = Option::whereHas('modules', function ($query) use ($enseignantId) {
            $query->where('ID_utilisateur', $enseignantId);
        })
        ->with([
            'modules' => function ($query) use ($enseignantId) {
                $query->where('ID_utilisateur', $enseignantId)
                      ->with(['semestre', 'seances']);
            },
            'users' => function ($query) {
                $query->with('semestre');
            }
        ])
        ->get();

    // Calculer les statistiques
    $totalEtudiants = 0;
    $totalClasses = 0;
    $totalHeures = 0;

    foreach ($options as $option) {
        $totalEtudiants += $option->users->count();
        $totalClasses += $option->modules->count();
        
        // Calculer les heures par semaine pour chaque module
        foreach ($option->modules as $module) {
            $heuresModule = 0;
            foreach ($module->seances as $seance) {
                $debut = \Carbon\Carbon::parse($seance->HeureDebut_seance);
                $fin = \Carbon\Carbon::parse($seance->HeureFin_seance);
                $heuresModule += $debut->diffInHours($fin);
            }
            $totalHeures += $heuresModule;
        }
    }

    // Ajouter des infos dynamiques à chaque option
    foreach ($options as $option) {
        // Nombre d'étudiants dans cette option
        $option->nombre_etudiants = $option->users->count();

        // Calculer les heures par semaine pour cette option
        $heuresOption = 0;
        foreach ($option->modules as $module) {
            foreach ($module->seances as $seance) {
                $debut = \Carbon\Carbon::parse($seance->HeureDebut_seance);
                $fin = \Carbon\Carbon::parse($seance->HeureFin_seance);
                $heuresOption += $debut->diffInHours($fin);
            }
        }
        $option->heures_semaine = $heuresOption;

        // Récupérer les jours des séances
        $jours = [];
        foreach ($option->modules as $module) {
            foreach ($module->seances as $seance) {
                if (!empty($seance->jour)) {
                    $jours[] = $seance->jour;
                }
            }
        }
        $option->jours = implode(', ', array_unique($jours));
    }

    return view('enseignant.index', compact('options', 'totalEtudiants', 'totalClasses', 'totalHeures'));
}
}
