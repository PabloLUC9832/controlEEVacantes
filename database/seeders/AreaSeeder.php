<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Area;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        $area1= new Area();
        $area1->descripcion_larga = "TECNICA";
        $area1->descripcion_corta = "TECNICA";
        $area1->save();
        //2
        $area2= new Area();
        $area2->descripcion_larga = "HUMANIDADES";
        $area2->descripcion_corta = "HUMANIDADES";
        $area2->save();
        //3
        $area3= new Area();
        $area3->descripcion_larga = "ECONOMICO ADMINISTRATIVA";
        $area3->descripcion_corta = "ECO-ADMVA";
        $area3->save();
        //4
        $area4= new Area();
        $area4->descripcion_larga = "CIENCIAS DE LA SALUD";
        $area4->descripcion_corta = "CS. DE SALUD";
        $area4->save();
        //5
        $area5= new Area();
        $area5->descripcion_larga = "CIENCIAS BIOLOGICAS Y AGROPECUARIAS";
        $area5->descripcion_corta = "BIOL-AGRO";
        $area5->save();
        //6
        $area6= new Area();
        $area6->descripcion_larga = "ARTES";
        $area6->descripcion_corta = "ARTES";
        $area6->save();
        //7
        $area7= new Area();
        $area7->descripcion_larga = "MULTIDISCIPLINARIA";
        $area7->descripcion_corta = "MULTIDISCIPLINARIA";
        $area7->save();
        //8
        $area8= new Area();
        $area8->descripcion_larga = "DIFUSION CULTURAL Y EXTENSION UNIVERSITARIA";
        $area8->descripcion_corta = "D.C.Y EXT.UV";
        $area8->save();
        //9
        $area9= new Area();
        $area9->descripcion_larga = "AREA ADMINISTRATIVA";
        $area9->descripcion_corta = "AREA ADMVA";
        $area9->save();
        //10
        $area10= new Area();
        $area10->descripcion_larga = "FORMACION BASICA GENERAL";
        $area10->descripcion_corta = "FORM. BASICA GRAL";
        $area10->save();
        //11
        $area11= new Area();
        $area11->descripcion_larga = "INVESTIGACION";
        $area11->descripcion_corta = "INVESTIGACION";
        $area11->save();
        //12
        $area12= new Area();
        $area12->descripcion_larga = "RELACIONES INTERNACIONALES";
        $area12->descripcion_corta = "RELACIONES INTERNAC";
        $area12->save();
    }
}
