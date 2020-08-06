<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            //Attach
            $table->timestamp('ban_time')->nullable();
            $table->integer("ban_type")->default(10000);
            $table->string("reg_ip");
            $table->string("last_ip");
            $table->timestamp('register_timestamp')->nullable();
            $table->boolean("isBanned")->default(false);
            $table->boolean("isAdmin")->default(false);

            $database = DB::connection("game")->getDatabaseName();
            $table->integer('game_id')->nullable();
            $table->foreign('game_id')->references('usr_id')->on(new Expression($database . '.users'))->onDelete('cascade');
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
