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
            $table->id();
            $table->string('username');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('phonenumber');
            $table->string('password');
            $table->enum('gender', ['male', 'female']);
            $table->integer('telent_categories');
            $table->integer('state_id');
            $table->integer('city_id');
            $table->integer('language_id');
            $table->date('birthdate');
            $table->date('telent_skills_id');
            $table->date('year_of_experience');
            $table->date('about_you');
            $table->date('social_id');
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
