<?php

namespace App\Http\Controllers\Etudiant;

use App\Models\Annonce;
use App\Models\Module;
use App\Models\Note;
use App\Models\Seance;
use App\Models\User;
use App\Models\Filiere;
use App\Models\Option;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class IndexController extends Controller
{
   public function index()
   {
        $idEtudiant = Auth::id() ;
         $notes = Note::with('module')
                     ->where('ID_utilisateur',$idEtudiant)
                     ->orderBy('Date_note','desc')
                     ->take(4)
                     ->get();

         $jour = Carbon::today()->locale('fr')->isoformat('dddd');
         $idOption = Auth::user()->ID_option;
         $idSemestre = Auth::user()->ID_semestre;
         $option = Option::with('modules')->find($idOption);
         $AllModulesID = $option->modules->pluck('ID_module');
         $optionNom = Auth::user()->option->Nom_option;
         $modules = Module::where('ID_semestre', $idSemestre)->pluck('ID_module');
         $commonModule = $AllModulesID->intersect($modules);

//       Requête finale des séances
         $seances = Seance::with('module', 'salle')
                            ->whereIn('ID_module', $commonModule)
                            ->where('jour', $jour)
                            ->orderBy('HeureDebut_seance', 'ASC')
                            ->get();

         $annonce = Annonce::with('user')
                            ->where('Option_classe', $optionNom)
                            ->orderBy('Date_annonce','desc')
                            ->first();


        return view('etudiant.index', compact('notes','seances', 'annonce'));
   }
}
