<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institution_id');
            $table->unsignedBigInteger('vacancy_id')->nullable();
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('package_id');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('archivo')->nullable();
            $table->string('cuenta')->nullable();
            $table->string('codigo');
            $table->string('estado')->nullable();
            $table->double('monto_total', 8, 2)->nullable();
            $table->double('salario_basico', 8, 2)->nullable();
            $table->timestamps();

            $table->foreign('institution_id')->references('id')->on('institutions');
            $table->foreign('vacancy_id')->references('id')->on('vacancies');
            $table->foreign('person_id')->references('id')->on('people');
            $table->foreign('package_id')->references('id')->on('packages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
