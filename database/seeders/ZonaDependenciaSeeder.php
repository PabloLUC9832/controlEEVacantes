<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Zona_Dependencia;

class ZonaDependenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $zonaDependencia = new Zona_Dependencia();
        $zonaDependencia->id_zona = 1;
        $zonaDependencia->clave_dependencia = 01;
        $zonaDependencia->nombre = "DIRECCIÓN GENERAL DEL ÁREA ACADÉMICA ECONÓMICO ADMINISTRATIVA";
        $zonaDependencia->save();

        $zonaDependencia1 = new Zona_Dependencia();
        $zonaDependencia1->id_zona = 1;
        $zonaDependencia1->clave_dependencia = 11301;
        $zonaDependencia1->nombre = "FACULTAD DE CONTADURÍA Y ADMINISTRACIÓN";
        $zonaDependencia1->save();

        $zonaDependencia2 = new Zona_Dependencia();
        $zonaDependencia2->id_zona = 1;
        $zonaDependencia2->clave_dependencia = 11303;
        $zonaDependencia2->nombre = "FACULTAD DE ECONOMIA";
        $zonaDependencia2->save();

        $zonaDependencia3 = new Zona_Dependencia();
        $zonaDependencia3->id_zona = 1;
        $zonaDependencia3->clave_dependencia = 11304;
        $zonaDependencia3->nombre = "FACULTAD DE ESTADÍSTICA E INFORMÁTICA";
        $zonaDependencia3->save();

        $zonaDependencia4 = new Zona_Dependencia();
        $zonaDependencia4->id_zona = 1;
        $zonaDependencia4->clave_dependencia = 11309;
        $zonaDependencia4->nombre = "FACULTAD DE CIENCIAS ADMINISTRATIVAS Y SOCIALES";
        $zonaDependencia4->save();

        $zonaDependencia5 = new Zona_Dependencia();
        $zonaDependencia5->id_zona = 1;
        $zonaDependencia5->clave_dependencia = 11701;
        $zonaDependencia5->nombre = "DIRECCIÓN GENERAL DEL SISTEMA DE ENSEÑANZA ABIERTA";
        $zonaDependencia5->save();

        /*PROGRAMAS EN LA ZONA 2 (VERACRUZ)*/

        $zonaDependencia6 = new Zona_Dependencia();
        $zonaDependencia6->id_zona = 2;
        $zonaDependencia6->clave_dependencia = 21301;
        $zonaDependencia6->nombre = "FACULTAD DE ADMINISTRACIÓN";
        $zonaDependencia6->save();

        $zonaDependencia7 = new Zona_Dependencia();
        $zonaDependencia7->id_zona = 2;
        $zonaDependencia7->clave_dependencia = 22302;
        $zonaDependencia7->nombre = "FACULTAD DE CONTADURIA Y NEGOCIOS";
        $zonaDependencia7->save();

        $zonaDependencia8 = new Zona_Dependencia();
        $zonaDependencia8->id_zona = 2;
        $zonaDependencia8->clave_dependencia = 22701;
        $zonaDependencia8->nombre = "COORDINACION ACADEMICA REG. DE ENSEÑANZA ABIERTA";
        $zonaDependencia8->save();

        /* PROGRAMAS EN LA ZONA 3 (ORIZABA CORDOBA) */

        $zonaDependencia9 = new Zona_Dependencia();
        $zonaDependencia9->id_zona = 3 ;
        $zonaDependencia9->clave_dependencia = 31701;
        $zonaDependencia9->nombre = "COORDINACION ACADEMICA REG. DE ENSEÑANZA ABIERTA";
        $zonaDependencia9->save();

        $zonaDependencia10 = new Zona_Dependencia();
        $zonaDependencia10->id_zona = 3 ;
        $zonaDependencia10->clave_dependencia = 34301;
        $zonaDependencia10->nombre = "FACULTAD DE NEGOCIOS Y TECNOLOGÍAS";
        $zonaDependencia10->save();

        /* PROGRAMAS EN LA ZONA 4 (POZA RICA - TUXPAN) */

        $zonaDependencia11 = new Zona_Dependencia();
        $zonaDependencia11->id_zona =  4 ;
        $zonaDependencia11->clave_dependencia = 41701 ;
        $zonaDependencia11->nombre = "COORDINACION ACADEMICA REG. DE ENSEÑANZA ABIERTA";
        $zonaDependencia11->save();

        $zonaDependencia12 = new Zona_Dependencia();
        $zonaDependencia12->id_zona =  4 ;
        $zonaDependencia12->clave_dependencia = 42301;
        $zonaDependencia12->nombre = "FACULTAD DE CONTADURIA";
        $zonaDependencia12->save();

        /* PROGRAMAS EN LA ZONA 5 (COATZACOALCOS-MINATITLAN) */

        $zonaDependencia13 = new Zona_Dependencia();
        $zonaDependencia13->id_zona = 5 ;
        $zonaDependencia13->clave_dependencia = 51301;
        $zonaDependencia13->nombre = "FACULTAD DE CONTADURÍA Y ADMINISTRACIÓN";
        $zonaDependencia13->save();

        $zonaDependencia14 = new Zona_Dependencia();
        $zonaDependencia14->id_zona = 5 ;
        $zonaDependencia14->clave_dependencia = 51701;
        $zonaDependencia14->nombre = "COORDINACION ACADEMICA REG. DE ENSEÑANZA ABIERTA";
        $zonaDependencia14->save();
    }
}
