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
            $table->text('clavePeriodo');
            $table->integer('numZona');
            $table->integer('numDependencia');
            $table->integer('numArea');
            $table->integer('numPrograma');
            $table->integer('numPlaza');
            $table->integer('numHoras');
            $table->integer('numMateria');
            $table->text('nombreMateria');
            $table->text('grupo');
            $table->text('subGrupo');
            $table->integer('numMotivo');
            $table->text('tipoAsignacion')->nullable();
            $table->integer('numPersonalDocente')->nullable();
            $table->integer('plan')->nullable();
            $table->text('observaciones')->nullable();
            $table->text('fechaAsignacion')->nullable();
            $table->text('fechaApertura')->nullable();
            $table->text('fechaCierre')->nullable();
            $table->text('fechaRenuncia')->nullable();
            $table->integer('bancoHorasDisponible')->nullable();
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
