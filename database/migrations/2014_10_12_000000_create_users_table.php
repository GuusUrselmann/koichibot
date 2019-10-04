<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('discord_id')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('userlevel', ['member', 'admin', 'owner']);
            $table->integer('money');
            $table->integer('userskin_id')->unsigned()->nullable();
            $table->integer('stand_id')->unsigned()->nullable();
            $table->integer('health')->nullable();
            $table->integer('power_min')->nullable();
            $table->integer('power_max')->nullable();
            $table->string('power')->nullable();
            $table->string('speed')->nullable();
            $table->string('range')->nullable();
            $table->string('durability')->nullable();
            $table->string('precision')->nullable();
            $table->string('potential')->nullable();
            $table->text('abilities', 155)->nullable();
            $table->integer('level_id')->unsigned()->nullable();
            $table->integer('experience')->nullable();
            $table->text('unlocks_userskins')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
