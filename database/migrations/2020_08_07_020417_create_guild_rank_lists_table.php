<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuildRankListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guild_rank_lists', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('guild');
            //$table->integer('player_id')->nullable();
            //$table->foreign('player_id')->references('id')->on('users')->onDelete('set null');


            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guild_rank_lists');
    }
}
