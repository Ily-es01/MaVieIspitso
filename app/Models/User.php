<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
     use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'Nom_AR',
        'Prenom',
        'Prenom_AR',
        'Sexe',
        'Profile_image',
        'NaissanceDate',
        'LieuNaissance',
        'Nationalite',
        'IdentiteType',
        'IdentiteNumero',
        'Adresse',
        'Ville',
        'Telephone',
        'Assurance_status',
        'Bourse_status',
        'Code_massar',
        'BacSerie_etudiant',
        'Academie',
        'Loisir',
        'Annne_bac',
        'Anne_bac',
        'Moyenne_bac',
        'Role',
        'ID_filiere',
        'ID_option',
        'ID_semestre',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function filiere(){
        return $this->belongsTo(Filiere::class,'ID_filiere');
    }
    public function option(){
        return $this->belongsTo(Option::class,'ID_option');
    }

    public function semestre(){
        return $this->belongsTo(Semestre::class, 'ID_semestre');
    }

    public function modules(){
        return $this->hasMany(Module::class);
    }

    public function annonces(){
        return $this->hasMany(Annonce::class);
    }

    public function seances(){
        return $this->hasMany(Seance::class);
    }

}
