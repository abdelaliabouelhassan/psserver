<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\ServerRanking;

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
            $table->string('title')->nullable();
            $table->string('banner')->nullable();
            $table->string('category')->nullable();
            $table->string('language')->nullable();
            $table->string('maxlevel')->nullable();
            $table->string('youtube_id')->nullable();
            $table->string('rates')->nullable();
            $table->text('description')->nullable();
            $table->string('screen')->nullable();
            $table->integer('user_id');
            $table->string('slug')->nullable();
            $table->string('difficulty')->nullable();
            $table->integer('real_vote_amount')->default(0);
            $table->integer('vote_amount')->default(0);
            $table->boolean('has_votes_in_the_last_12')->default(true);
            $table->boolean('admin_active')->default(true);
            $table->boolean('server_owner_active')->default(true);
            $table->boolean('hasBacklink')->default(false);
            $table->string('upDown')->default(ServerRanking::Stable);
            $table->integer('viewd')->unsigned()->default(0);
            $table->boolean('status')->default(false);
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
