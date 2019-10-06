<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            $table->text('description_win');
            $table->text('description_lose');
            $table->integer('money_spread');
            $table->integer('experience_spread');
            $table->enum('rarity', ['common', 'uncommon', 'rare', 'epic', 'legendary', 'ascended']);
            $table->enum('rarity_loot', ['common', 'uncommon', 'rare', 'epic', 'legendary', 'ascended']);
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
        Schema::dropIfExists('quests');
    }
}
