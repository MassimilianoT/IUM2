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
        Schema::create('author_boardgame', function (Blueprint $table) {
            $table->foreignId('author_id')->references('id')->on('authors')->cascadeOnDelete();
            $table->foreignId('boardgame_id')->references('id')->on('boardgames')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('author_boardgame');
    }
};
