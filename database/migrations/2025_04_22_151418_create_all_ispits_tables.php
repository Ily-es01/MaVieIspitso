<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllIspitsTables  extends Migration
{
    public function up(): void
    {
        Schema::create('filiere', function (Blueprint $table) {
            $table->id('ID_filiere');
            $table->string('Nom_filiere');
        });

        Schema::create('option', function (Blueprint $table) {
            $table->id('ID_option');
            $table->unsignedBigInteger('ID_filiere');
            $table->string('Nom_option');
            $table->foreign('ID_filiere')->references('ID_filiere')->on('filiere');
        });


        Schema::create('semestre', function (Blueprint $table) {
            $table->id('ID_semestre');
            $table->string('Semestre_numero');
            $table->date('Semestre_debut');
            $table->date('Semestre_fin');
        });


        Schema::create('module', function (Blueprint $table) {
            $table->id('ID_module');
            $table->unsignedBigInteger('ID_semestre');
            $table->unsignedBigInteger('ID_utilisateur');
            $table->string('Nom_module');
            $table->string('Type');
            $table->integer('Volume_module')->nullable();
            $table->decimal('Coefficient_module', 5, 2)->nullable();
            $table->foreign('ID_semestre')->references('ID_semestre')->on('semestre');
            $table->foreign('ID_utilisateur')->references('id')->on('users');
        });

        Schema::create('option_utilisateur', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ID_option');
            $table->unsignedBigInteger('ID_utilisateur');

            $table->foreign('ID_option')->references('ID_option')->on('option')->onDelete('cascade');
            $table->foreign('ID_utilisateur')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('module_option', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ID_module');
            $table->unsignedBigInteger('ID_option');

            $table->foreign('ID_module')->references('ID_module')->on('module')->onDelete('cascade');
            $table->foreign('ID_option')->references('ID_option')->on('option')->onDelete('cascade');
        });


        Schema::create('annonce', function (Blueprint $table) {
            $table->id('ID_annonce');
            $table->unsignedBigInteger('ID_utilisateur');
            $table->string('Objet_annonce');
            $table->text('Option_classe');
            $table->text('Contenu_annonce');
            $table->timestamp('Date_annonce')->nullable();
            $table->foreign('ID_utilisateur')->references('id')->on('users');
        });



        Schema::create('note', function (Blueprint $table) {
            $table->id('ID_note');
            $table->unsignedBigInteger('ID_utilisateur');
            $table->unsignedBigInteger('ID_module');
            $table->date('Date_note');
            $table->float('Valeur_note')->nullable();
            $table->string('Mention_note')->nullable();
            $table->text('Type_note')->nullable();
            $table->string('Session_note')->nullable();
            $table->foreign('ID_utilisateur')->references('id')->on('users');
            $table->foreign('ID_module')->references('ID_module')->on('module');
        });

        Schema::create('salle', function (Blueprint $table) {
            $table->id('ID_salle');
            $table->string('Nom_salle');
            $table->integer('Capacite_salle');
        });

        Schema::create('seance', function (Blueprint $table) {
            $table->id('ID_seance');
            $table->string('jour')->nullable();
            $table->unsignedBigInteger('ID_salle');
            $table->unsignedBigInteger('ID_module');
            $table->unsignedBigInteger('ID_utilisateur');
            $table->time('HeureDebut_seance');
            $table->time('HeureFin_seance');
            $table->foreign('ID_salle')->references('ID_salle')->on('salle');
            $table->foreign('ID_module')->references('ID_module')->on('module');
            $table->foreign('ID_utilisateur')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seance');
        Schema::dropIfExists('salle');
        Schema::dropIfExists('note');
        Schema::dropIfExists('module');
        Schema::dropIfExists('annonce');
        Schema::dropIfExists('semestre');
        Schema::dropIfExists('option');
        Schema::dropIfExists('filiere');
    }
}
