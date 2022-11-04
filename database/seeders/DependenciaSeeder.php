<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dependencia;

class DependenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* --- DEPENDENCIAS XALAPA --- */
        $dependencia1 = new Dependencia();
        $dependencia1->clave=11301;
        $dependencia1->nombre="FACULTAD DE CONTADURÍA Y ADMINISTRACIÓN";
        $dependencia1->save();

        $dependencia2 = new Dependencia();
        $dependencia2->clave=11302;
        $dependencia2->nombre="UNIDAD ACADEMICA DE ECONOMIA Y ESTADISTICA";
        $dependencia2->save();

        $dependencia3 = new Dependencia();
        $dependencia3->clave=11303;
        $dependencia3->nombre="FACULTAD DE ECONOMIA";
        $dependencia3->save();

        $dependencia4 = new Dependencia();
        $dependencia4->clave=11304;
        $dependencia4->nombre="FACULTAD DE ESTADÍSTICA E INFORMÁTICA";
        $dependencia4->save();

        $dependencia5 = new Dependencia();
        $dependencia5->clave=11308;
        $dependencia5->nombre="INTELIGENCIA ARTIFICIAL";
        $dependencia5->save();

        $dependencia6 = new Dependencia();
        $dependencia6->clave=11309;
        $dependencia6->nombre="FACULTAD DE CIENCIAS ADMINISTRATIVAS Y SOCIALES";
        $dependencia6->save();

        $dependencia7 = new Dependencia();
        $dependencia7->clave=11310;
        $dependencia7->nombre="CTRO. DE EST.DE OPIN. Y ANAL. U.V.";
        $dependencia7->save();

        /* --- DEPENDENCIAS VERACRUZ --- */

        $dependencia8 = new Dependencia();
        $dependencia8->clave=21301;
        $dependencia8->nombre="FACULTAD DE ADMINISTRACIÓN";
        $dependencia8->save();

        $dependencia9 = new Dependencia();
        $dependencia9->clave=22302;
        $dependencia9->nombre="FACULTAD DE CONTADURIA Y NEGOCIOS";
        $dependencia9->save();

        /* --- DEPENDENCIAS ORIZABA CORDOBA --- */

        $dependencia10 = new Dependencia();
        $dependencia10->clave=34301;
        $dependencia10->nombre="FACULTAD DE NEGOCIOS Y TECNOLOGÍAS";
        $dependencia10->save();

        /* --- DEPENDENCIAS POZA RICA TUXPAN --- */

        $dependencia11 = new Dependencia();
        $dependencia11->clave=42301;
        $dependencia11->nombre="FACULTAD DE CONTADURIA";
        $dependencia11->save();

        /* --- DEPENDENCIAS COATZACOALCOS MINATITLAN --- */

        $dependencia12 = new Dependencia();
        $dependencia12->clave=51301;
        $dependencia12->nombre="FACULTAD DE CONTADURÍA Y ADMINISTRACIÓN";
        $dependencia12->save();

    }
}
