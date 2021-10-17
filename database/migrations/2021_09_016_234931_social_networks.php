<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SocialNetworks extends Migration{

    public function up(){
        Schema::create('social_networks', function (Blueprint $table) {
            $table->id();
            $table->string('username',150);
            $table->string('url',250);
            $table->string('img',250);
            $table->string('type',50);
            $table->timestamps();
            $table->unsignedBigInteger('ally_id')->nullable();

        });

        Schema::table('social_networks', function (Blueprint $table) {
            $table->foreign('ally_id')->references('id')->on('allianses')
            ->onDelete('set null');
        });


    }

    public function down(){
        Schema::dropIfExists('social_networks', function(Blueprint $table){
            $table->dropForeign(['ally_id']);
            $table->dropColumn('ally_id');
        });

    }
}
