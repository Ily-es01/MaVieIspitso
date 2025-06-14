<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    protected $table = 'semestre';
    protected $primaryKey = 'ID_semestre';

    public function users(){
        return $this->hasMany(User::class);
    }
    public function modules(){
        return $this->hasMany(Module::class);
    }
}
