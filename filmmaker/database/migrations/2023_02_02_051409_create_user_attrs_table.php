<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAttrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_attrs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('eyecolor');
            $table->string('haircolor');
            $table->string('dresssize');
            $table->string('shoesize');
            $table->string('hairtype');
            $table->string('talent_height_in_CM');
            $table->string('waist_in_CM');
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
        Schema::dropIfExists('user_attrs');
    }
}
