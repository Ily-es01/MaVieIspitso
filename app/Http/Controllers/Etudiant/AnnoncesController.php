<?php

namespace App\Http\Controllers\Etudiant;

use App\Http\Controllers\Controller;
use App\Models\Annonce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AnnoncesController extends Controller
{
    public function allannonces(){
        $optionEtudiant = auth::user();
        $optionName = $optionEtudiant->option->Nom_option;

        $annonces = Annonce::where('Option_classe',$optionName)
                            ->orderBy('Date_annonce','desc')
                            ->paginate(6);

        return view('etudiant.annonce',compact('annonces'));
    }
}
