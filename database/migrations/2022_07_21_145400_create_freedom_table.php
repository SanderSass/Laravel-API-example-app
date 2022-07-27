<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freedom', function (Blueprint $table) {
            $table->integer('year');
            $table->text('iso_code');
            $table->text('country');
            $table->float('personal_freedom_score');
            $table->float('economic_freedom_score');
            $table->float('human_freedom_score');
            $table->integer('human_freedom_rank');
            $table->integer('human_freedom_quartile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('freedom');
    }
};
