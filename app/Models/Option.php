<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'option';
    protected $primaryKey = 'ID_option';
    protected $fillable = ['Nom_option', 'ID_filiere'];
    public function filiere(){
        return $this->belongsTo(Filiere::class, 'ID_filiere');
    }
    public function users(){
        return $this->hasMany(User::class,'ID_option');
    }
    public function modules(){
            return $this->belongsToMany(Module::class, 'module_option', 'ID_option', 'ID_module');
    }
}
