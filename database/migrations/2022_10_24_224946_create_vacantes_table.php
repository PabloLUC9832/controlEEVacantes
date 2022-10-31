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
            $table->text('numZona');
            $table->text('numDependencia');
            $table->text('numArea');
            $table->text('numPrograma');
            $table->text('numPlaza');
            $table->text('numHoras');
            $table->text('numMateria');
            $table->text('nombreMateria');
            $table->text('grupo');
            $table->text('numMotivo');
            $table->text('tipoAsignacion')->nullable();
            $table->integer('numPersonalDocente')->nullable();
            $table->integer('plan')->nullable();
            $table->date('fechaApertura')->nullable();
            $table->date('fechaCierre')->nullable();
            $table->text('observaciones')->nullable();
            $table->date('fechaRenuncia')->nullable();
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
