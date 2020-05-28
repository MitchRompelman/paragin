<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRitvaluesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ritvalues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('question')->default(NULL);
            $table->decimal('ritvalue', 4, 1)->default(NULL);
            $table->unsignedBigInteger('ritvalues_test_id_foreign');
            $table->foreign('ritvalues_test_id_foreign')->references('id')->on('tests')->onDelete('cascade');
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
        Schema::dropIfExists('ritvalues');
    }
}
