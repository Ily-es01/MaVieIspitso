<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    protected $table = "annonce";
    protected $primaryKey = "ID_annonce";
    public $timestamps = false;

    protected $fillable = [
        'ID_utilisateur',
        'Objet_annonce',
        'Option_classe',
        'Contenu_annonce',
        'Date_annonce'
    ];

    public function user(){
        return $this->belongsTo(User::class , 'ID_utilisateur');
    }
}
