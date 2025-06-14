<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEtudiantFieldsToUsersTable extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('Nom_AR')->nullable();
            $table->string('Prenom')->nullable();
            $table->string('Prenom_AR')->nullable();
            $table->string('Sexe')->nullable();
            $table->string('Profile_image')->nullable();
            $table->date('NaissanceDate')->nullable();
            $table->string('LieuNaissance')->nullable();
            $table->string('Nationalite')->nullable();
            $table->string('IdentiteType')->nullable();
            $table->string('IdentiteNumero')->nullable();
            $table->string('Adresse')->nullable();
            $table->string('Ville')->nullable();
            $table->string('Telephone')->nullable();
            $table->string('Assurance_status')->nullable();
            $table->string('Bourse_status')->nullable();
            $table->string('Code_massar')->nullable();
            $table->string('BacSerie_etudiant')->nullable();
            $table->string('Academie')->nullable();
            $table->string('Loisir')->nullable();
            $table->string('Annne_bac')->nullable();
            $table->string('Moyenne_bac')->nullable();
            $table->unsignedBigInteger('ID_option')->nullable();
            $table->unsignedBigInteger('ID_filiere')->nullable();
            $table->unsignedBigInteger('ID_semestre')->nullable();
            $table->string('Role')->nullable();

            $table->foreign('ID_option')->references('ID_option')->on('option');
            $table->foreign('ID_filiere')->references('ID_filiere')->on('filiere');
            $table->foreign('ID_semestre')->references('ID_semestre')->on('semestre');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['ID_option']);
            $table->dropForeign(['ID_filiere']);
            $table->dropForeign(['ID_semestre']);

            $table->dropColumn([
                'Nom_AR', 'Prenom', 'Prenom_AR',
                'Sexe', 'NaissanceDate', 'LieuNaissance', 'Nationalite',
                'IdentiteType', 'IdentiteNumero', 'Adresse', 'Ville',
                'Telephone', 'Assurance_status', 'BacSerie_etudiant', 'Academie',
                'Loisir', 'ID_option', 'ID_filiere', 'ID_semestre', 'Role'
            ]);
        });
    }
}
