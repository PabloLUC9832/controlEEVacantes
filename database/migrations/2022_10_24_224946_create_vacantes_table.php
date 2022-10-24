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
        Schema::create('vacantes', function (Blueprint $table) {
            $table->id();
            $table->text('periodo');
            $table->integer('numZona');
            $table->integer('numDependencia');
            $table->integer('numPrograma');
            $table->integer('numPlaza');
            $table->integer('numHoras');
            $table->integer('numMateria');
            $table->text('nombreMateria');
            $table->text('grupo');
            $table->integer('numMotivo');
            $table->text('tipoAsignacion');                        
            $table->integer('numPersonalDocente');
            $table->integer('plan');
            $table->date('fechaApertura');
            $table->date('fechaCierre');
            $table->text('observaciones');
            $table->date('fechaRenuncia');
            $table->integer('bancoHorasDisponible');
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
        Schema::dropIfExists('vacantes');
    }
};
