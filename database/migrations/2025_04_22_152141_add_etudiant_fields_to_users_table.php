<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEtudiantFieldsToUsersTable extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_filiere')->nullable()->after('id');
            $table->string('prenom_etudiant')->nullable();
            $table->string('nom_etudiant')->nullable();
            $table->string('arabepnom_etudiant')->nullable();
            $table->string('arabenom_etudiant')->nullable();
            $table->string('sexe_etudiant')->nullable();
            $table->date('naissance_date')->nullable();
            $table->string('lieu_naissance')->nullable();
            $table->string('nationalite')->nullable();
            $table->string('identite_type')->nullable();
            $table->string('identite_numero')->nullable();
            $table->string('adresse')->nullable();
            $table->string('ville')->nullable();
            $table->boolean('bourse_status')->default(false);
            $table->boolean('assurance_status')->default(false);
            $table->string('bac_serie')->nullable();
            $table->string('academie')->nullable();
            $table->string('loisir')->nullable();
            $table->string('role')->default('etudiant');

            // Foreign key
            $table->foreign('id_filiere')->references('id_filiere')->on('filieres')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_filiere']);
            $table->dropColumn([
                'id_filiere', 'prenom_etudiant', 'nom_etudiant', 'arabepnom_etudiant', 'arabenom_etudiant',
                'sexe_etudiant', 'naissance_date', 'lieu_naissance', 'nationalite', 'identite_type',
                'identite_numero', 'adresse', 'ville', 'bourse_status', 'assurance_status',
                'bac_serie', 'academie', 'loisir', 'role'
            ]);
        });
    }
}