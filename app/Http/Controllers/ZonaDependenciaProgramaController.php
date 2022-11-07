<?php

namespace App\Http\Controllers;

use App\Models\Zona;
use App\Models\Zona_Dependencia_Programa;
use Illuminate\Http\Request;

class ZonaDependenciaProgramaController extends Controller
{
    //
    /*
     * $flights = Flight::where('active', 1)
               ->orderBy('name')
               ->take(10)
               ->get();
     */

    public static function consultaDependencias($id){
        $lista = Zona_Dependencia_Programa::where('id_zona',$id)->get();
        return $lista;
    }

}
