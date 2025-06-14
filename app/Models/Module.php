<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $primaryKey = 'ID_module';
    protected $table = 'module';

    protected $fillable = [
        'Nom_module',
        'ID_utilisateur',
        'ID_semestre',
        'Coefficient_module'
    ];

    public function notes(){
        return $this->hasMany(Note::class, 'ID_module', 'ID_module');
    }

    public function user(){
        return $this->belongsTo(User::class, 'ID_utilisateur', 'id');
    }

    public function semestre(){
        return $this->belongsTo(Semestre::class, 'ID_semestre', 'ID_semestre');
    }

    public function seances()
    {
        return $this->hasMany(Seance::class, 'ID_module', 'ID_module');
    }

    public function options()
    {
        return $this->belongsToMany(Option::class, 'module_option', 'ID_module', 'ID_option');
    }
}
