<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
     protected $table = 'note';
     protected $primaryKey = 'ID_note';
     public $timestamps = false;

     protected $fillable = [
         'ID_utilisateur',
         'ID_module',
         'Date_note',
         'Valeur_note',
         'Type_note',
         'Session_note'
     ];

     protected $casts = [
         'Date_note' => 'datetime'
     ];

    public function module(){
        return $this->belongsTo(Module::class,'ID_module');
    }

    public function user(){
        return $this->belongsTo(User::class, 'ID_utilisateur', 'id');
    }
}
