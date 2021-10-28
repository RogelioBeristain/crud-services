<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Allianses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allianses', function (Blueprint $table) {
            $table->id();
            $table->string('name',250);
            $table->string('web',150);
            $table->string('img',2500);
            $table->string('description',2500);
            $table->string('cover',2500);
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
        Schema::dropIfExists('allianses');
    }
}
