<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Equipo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('equipo',function (Blueprint $table){
            $table->id('id_equipo');
            $table->string('nombre')->nullable();
            $table->string('tipo_equipo')->nullable();
            $table->string('ubicacion')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('firmware')->nullable();
            $table->float('frecuencia_de_envio')->nullable();
            $table->unsignedBigInteger('id_tecnico');
            $table->foreign('id_tecnico')->references('id')->on('users')->onDelete('cascade');
            $table->string('estado');
            $table->timestamp('time_create')->nullable();
            $table->timestamp('time_update')->nullable();
            $table->string('mensaje');
            
        });

        Schema::create('coordinador',function (Blueprint $table){
            $table->id('id_coordinador');
            $table->unsignedBigInteger('id_equipo');
            $table->foreign('id_equipo')->references('id_equipo')->on('equipo')->onDelete('cascade');
            $table->string('tipo_placa')->nullable();
            
        });

        Schema::create('estacion',function (Blueprint $table){
            $table->id('id_estacion');
            $table->unsignedBigInteger('id_equipo');
            $table->foreign('id_equipo')->references('id_equipo')->on('equipo')->onDelete('cascade');
            $table->string('compania3G')->nullable();
            $table->string('tipo_placa')->nullable();
        });

        Schema::create('sonda',function (Blueprint $table){
            $table->id('id_sonda');
            $table->unsignedBigInteger('id_equipo');
            $table->foreign('id_equipo')->references('id_equipo')->on('equipo')->onDelete('cascade');
            $table->string('compania3G')->nullable();
            $table->string('tipo_placa')->nullable();
            $table->string('tipo_sonda')->nullable();
            $table->float('largo_sonda')->nullable();
        });

        Schema::create('canales',function (Blueprint $table){
            $table->id('id_canales');
            $table->unsignedBigInteger('id_equipo');
            $table->foreign('id_equipo')->references('id_equipo')->on('equipo')->onDelete('cascade');
            $table->string('tipo_placa')->nullable();
            $table->float('altura_agua')->nullable();
            $table->float('altura_sensor')->nullable();
            $table->float('altura_max_canal')->nullable();
        });

        Schema::create('pozos',function (Blueprint $table){
            $table->id('id_pozos');
            $table->unsignedBigInteger('id_equipo');
            $table->foreign('id_equipo')->references('id_equipo')->on('equipo')->onDelete('cascade');
            $table->float('profundidad_pozo')->nullable();
            $table->float('nivel_estatico')->nullable();
            $table->float('nivel_dinamico')->nullable();
            $table->string('referencia_sh')->nullable();
            $table->string('tipo_sensor')->nullable();
            $table->string('tipo_energia')->nullable();
            $table->float('factor_pulsos')->nullable();
            $table->string('compania3G')->nullable();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
