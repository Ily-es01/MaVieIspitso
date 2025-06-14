<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    protected $table = 'filiere';
    protected $primaryKey = 'ID_filiere';
    public function options(){
        return $this->hasMany(Option::class,'ID_option','');
    }
    public function users(){
        return $this->hasMany(User::class);
    }
}
