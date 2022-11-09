<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zona_Dependencia;

class ZonaDependenciaController extends Controller
{
    //
    public function fetchDependencia(Request $request)
    {
        $data['dependencias'] = Zona_Dependencia::where("id_zona", $request->id_zona)
                                ->get(["clave_dependencia","nombre"]);
  
        return response()->json($data);
    }
}
