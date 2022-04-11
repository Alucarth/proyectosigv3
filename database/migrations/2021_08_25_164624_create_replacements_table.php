<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReplacementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replacements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contract_id');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->date('fecha_periodo');
            $table->integer('nro_pago');
            $table->integer('dias_cotizados');
            $table->float('monto', 10, 2);
            $table->float('descuentos_bonos', 10, 2);
            $table->float('total_ganado', 10, 2);
            $table->float('salario_basico', 10, 2);
            $table->float('salario_basico2', 10, 2);
            $table->float('monto_incentivo', 10, 2);
            $table->string('c31')->nullable();
            $table->unsignedBigInteger('official_id');
            $table->timestamps();

            $table->foreign('contract_id')->references('id')->on('contracts');
            $table->foreign('official_id')->references('id')->on('officials');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replacements');
    }
}
