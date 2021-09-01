<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('id_rol')->nullable();
            $table->integer('id_plan')->nullable();
            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->string('tipo_identificacion')->nullable();
            $table->string('numero_identificacion')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('telefono1');
            $table->string('telefono2')->nullable();
            $table->string('direccion1')->nullable();
            $table->string('direccion2')->nullable();
            $table->string('congregacion')->nullable();
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
