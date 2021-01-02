<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('title');
            $table->string('banner');
            $table->string('category');
            $table->string('language');
            $table->string('maxlevel');
            $table->string('youtube_id')->nullable();
            $table->string('rates');
            $table->text('description');
            $table->string('screen')->nullable();
            $table->integer('user_id');
            $table->string('slug');
            $table->string('difficulty');
            $table->integer('realtimeVote')->default(0);
            $table->integer('previousVote')->default(0);
            $table->string('upDown')->default('stable');
            $table->integer('viewd')->unsigned()->default(0);
            $table->string('status')->default('false');
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
        Schema::dropIfExists('servers');
    }
}
