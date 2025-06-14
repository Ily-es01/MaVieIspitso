<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    protected $table = 'seance';
    protected $primaryKey = 'ID_seance';

    protected $fillable = [
        'ID_module',
        'ID_salle',
        'ID_utilisateur',
        'jour',
        'HeureDebut_seance',
        'HeureFin_seance'
    ];

    public function salle(){
        return $this->belongsTo(Salle::class, 'ID_salle', 'ID_salle');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'ID_module', 'ID_module');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_utilisateur', 'id');
    }
}
