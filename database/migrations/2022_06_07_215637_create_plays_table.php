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
        Schema::create('plays', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('winner_id')->references('id')->on('users')->cascadeOnDelete();
            $table->date('date');
            $table->foreignId('boardgame_id')->constrained()->cascadeOnDelete();
            $table->boolean('valid')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plays');
    }
};
