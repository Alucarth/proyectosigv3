<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareerPersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('career_person', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('career_id');
            $table->string('institution');
            $table->enum('grado_academico', [
                'TÉCNICO',
                'LICENCIATURA',
                'POSGRADO'
            ]);
            $table->date('egreso');
            $table->string('certificado');
            $table->timestamps();

            $table->foreign('person_id')->references('id')->on('people');
            $table->foreign('career_id')->references('id')->on('careers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('career_person');
    }
}
