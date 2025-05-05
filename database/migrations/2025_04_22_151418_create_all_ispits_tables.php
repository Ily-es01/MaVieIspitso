<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Table Filières
        Schema::create('filieres', function (Blueprint $table) {
            $table->id('id_filiere');
            $table->string('nom_filiere');
            $table->timestamps();
        });

        // Table Options
        Schema::create('options', function (Blueprint $table) {
            $table->id('id_option');
            $table->unsignedBigInteger('id_filiere');
            $table->string('nom_option');
            $table->foreign('id_filiere')->references('id_filiere')->on('filieres')->onDelete('cascade');
            $table->timestamps();
        });

        // Table Enseignants
        Schema::create('enseignants', function (Blueprint $table) {
            $table->id('id_enseignant');
            $table->string('nom_enseignant');
            $table->string('prenom_enseignant');
            $table->string('email_enseignant')->unique();
            $table->string('password_enseignant');
            $table->timestamps();
        });

        // Table Modules
        Schema::create('modules', function (Blueprint $table) {
            $table->id('id_module');
            $table->unsignedBigInteger('id_enseignant')->nullable();
            $table->string('nom_module');
            $table->float('coefficient');
            $table->integer('semestre');
            $table->string('type_module');
            $table->integer('volume_horaire');
            $table->foreign('id_enseignant')->references('id_enseignant')->on('enseignants')->onDelete('set null');
            $table->timestamps();
        });

        // Table Notes
        Schema::create('notes', function (Blueprint $table) {
            $table->id('id_note');
            $table->unsignedBigInteger('id_etudiant');
            $table->unsignedBigInteger('id_module');
            $table->float('valeur_note')->nullable();
            $table->float('session_note')->nullable();
            $table->float('controle_note')->nullable();
            $table->float('exam_note')->nullable();
            $table->foreign('id_etudiant')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_module')->references('id_module')->on('modules')->onDelete('cascade');
            $table->timestamps();
        });

        // Table enseignes_modules (pivot)
        Schema::create('enseignes_modules', function (Blueprint $table) {
            $table->unsignedBigInteger('id_option');
            $table->unsignedBigInteger('id_module');
            $table->primary(['id_option', 'id_module']);
            $table->foreign('id_option')->references('id_option')->on('options')->onDelete('cascade');
            $table->foreign('id_module')->references('id_module')->on('modules')->onDelete('cascade');
        });

        // Table Salles
        Schema::create('salles', function (Blueprint $table) {
            $table->id('id_salle');
            $table->string('nom_salle');
            $table->string('numero_salle');
            $table->integer('capacite_salle');
            $table->timestamps();
        });

        // Table Séances
        Schema::create('seances', function (Blueprint $table) {
            $table->id('id_seance');
            $table->unsignedBigInteger('id_module');
            $table->unsignedBigInteger('id_salle');
            $table->unsignedBigInteger('id_enseignant');
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->string('jour');
            $table->timestamps();

            $table->foreign('id_module')->references('id_module')->on('modules')->onDelete('cascade');
            $table->foreign('id_salle')->references('id_salle')->on('salles')->onDelete('cascade');
            $table->foreign('id_enseignant')->references('id_enseignant')->on('enseignants')->onDelete('cascade');
        });

        // Table Annonces
        Schema::create('annonces', function (Blueprint $table) {
            $table->id('id_annonce');
            $table->unsignedBigInteger('id_enseignant');
            $table->string('objet_annonce');
            $table->text('contenu_annonce');
            $table->date('date_annonce');
            $table->timestamps();

            $table->foreign('id_enseignant')->references('id_enseignant')->on('enseignants')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('annonces');
        Schema::dropIfExists('seances');
        Schema::dropIfExists('salles');
        Schema::dropIfExists('enseignes_modules');
        Schema::dropIfExists('notes');
        Schema::dropIfExists('modules');
        Schema::dropIfExists('enseignants');
        Schema::dropIfExists('options');
        Schema::dropIfExists('filieres');
    }
};
