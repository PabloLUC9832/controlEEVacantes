<?php

namespace App\Http\Controllers;

use App\Models\Zona;
use App\Models\Zona_Dependencia_Programa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ZonaDependenciaProgramaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = trim($request->get('search'));

        $listaZonaDependenciaPrograma = DB::table('v_zona_dependencia_programa')
            ->select('id_zona','nombre_zona','clave_dependencia','nombre_dependencia','clave_programa','nombre_programa','horasIniciales','horasUtilizadas','horasDisponibles')
            ->where('id_zona','LIKE','%'.$search.'%')
            ->orWhere('clave_dependencia','LIKE','%'.$search.'%')
            ->orWhere('clave_programa','LIKE','%'.$search.'%')
            ->orWhere('horasIniciales','LIKE','%'.$search.'%')
            ->orWhere('horasUtilizadas','LIKE','%'.$search.'%')
            ->orderBy('id_zona','asc')
            ->paginate(15);

        return view('zonaDependenciaPrograma.index', compact('listaZonaDependenciaPrograma','search'));
    }
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
