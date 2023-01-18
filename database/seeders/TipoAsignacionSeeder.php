<?php

namespace Database\Seeders;

use App\Models\tipoAsignacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoAsignacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tipoAsignacion = new tipoAsignacion();
        $tipoAsignacion->tipo = "Art 70";
        $tipoAsignacion->save();

        $tipoAsignacion1 = new tipoAsignacion();
        $tipoAsignacion1->tipo = "Art 73";
        $tipoAsignacion1->save();

        $tipoAsignacion2 = new tipoAsignacion();
        $tipoAsignacion2->tipo = "Art 70 y 73";
        $tipoAsignacion2->save();

        $tipoAsignacion3 = new tipoAsignacion();
        $tipoAsignacion3->tipo = "Convocada";
        $tipoAsignacion3->save();

        $tipoAsignacion4 = new tipoAsignacion();
        $tipoAsignacion4->tipo = "Complemento de carga";
        $tipoAsignacion4->save();

        $tipoAsignacion5 = new tipoAsignacion();
        $tipoAsignacion5->tipo = "Carga obligatoria";
        $tipoAsignacion5->save();
    }
}
