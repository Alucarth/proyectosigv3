<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('people_id');
            $table->unsignedBigInteger('institution_id');
            $table->unsignedBigInteger('vacancy_id');
            $table->boolean('is_selected')->default(false);
            $table->foreign('people_id')->references('id')->on('people');
            $table->foreign('institution_id')->references('id')->on('institutions');
            $table->foreign('vacancy_id')->references('id')->on('vacancies');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_lists');
    }
}
