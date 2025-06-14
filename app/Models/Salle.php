<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    protected $table = 'salle';
    protected $primaryKey = 'ID_salle';
    public function seances(){
        return $this->hasMany(Seance::class);
    }
}
