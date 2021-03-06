<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('lore');
            $table->string('image');
            $table->enum('type', ['standard', 'custom']);
            $table->enum('rarity', ['common', 'uncommon', 'rare', 'epic', 'legendary', 'ascended']);
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
        Schema::dropIfExists('stands');
    }
}
