<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalRankListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_rank_lists', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('player');

            $table->integer('player_id')->nullable();
            $table->foreign('player_id')->references('id')->on('users')->onDelete('set null');

            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('personal_rank_lists');
    }
}
