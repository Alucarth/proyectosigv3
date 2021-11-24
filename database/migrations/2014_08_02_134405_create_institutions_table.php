<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->string('razon_social');
            $table->string('nombre_comercial')->nullable();
            $table->unsignedBigInteger('society_id');
            $table->string('nit');
            $table->string('file_nit')->nullable();
            $table->boolean('roe')->default(0);
            $table->string('rubro')->nullable();
            $table->text('actividad')->nullable();
            $table->string('nombre')->nullable();
            $table->string('paterno')->nullable();
            $table->string('materno')->nullable();
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            $table->boolean('validacion_funda_empresa')->default(0);            
            $table->string('estado')->default("REGISTRADO");
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('society_id')->references('id')->on('societies');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institutions');
    }
}
