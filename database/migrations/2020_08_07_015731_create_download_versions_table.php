<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDownloadVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('download_versions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('title');
            $table->string('url');
            $table->string('version')->unique();
            $table->boolean('isPatch')->default(false);
            $table->boolean('isOnline')->default(true);

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
        Schema::dropIfExists('download_versions');
    }
}
