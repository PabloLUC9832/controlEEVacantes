<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zona__dependencia__programas', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('user_id');
            //$table->foreign('user_id')->references('id')->on('users');
            
            $table->unsignedBigInteger('id_zona') ; 
            $table->unsignedBigInteger('clave_dependencia') ; 
            $table->unsignedBigInteger('clave_programa') ; 

            $table->foreign('id_zona')->references('id')->on('zonas');
            $table->foreign('clave_dependencia')->references('clave')->on('dependencias');
            $table->foreign('clave_programa')->references('clave')->on('programas');

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
        Schema::dropIfExists('zona__dependencia__programas');
    }
};
