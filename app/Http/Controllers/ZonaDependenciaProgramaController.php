<?php

namespace App\Http\Controllers;

use App\Models\Zona;
use App\Models\Zona_Dependencia;
use App\Models\Zona_Dependencia_Programa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreZonaDependenciaProgramaRequest;
use Illuminate\Support\Facades\Auth;
use App\Providers\LogUserActivity;


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

        $listaZonaDependenciaPrograma = DB::table('zona__dependencia__programas')
            ->select('id','id_zona','nombre_zona','clave_dependencia','nombre_dependencia','clave_programa','nombre_programa','horasIniciales','horasUtilizadas','horasDisponibles')
            ->where('id_zona','LIKE','%'.$search.'%')
            ->orWhere('clave_dependencia','LIKE','%'.$search.'%')
            ->orWhere('clave_programa','LIKE','%'.$search.'%')
            ->orWhere('horasIniciales','LIKE','%'.$search.'%')
            ->orWhere('horasUtilizadas','LIKE','%'.$search.'%')
            ->orderBy('id_zona','asc')
            ->paginate(15);

        return view('zonaDependenciaPrograma.index', compact('listaZonaDependenciaPrograma','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $zonas = Zona_Dependencia::distinct('id_zona')->get();
        $listaZonas = $zonas->unique('id_zona');
        //$listaDependencias =

        $user = auth()->user();

        return view('zonaDependenciaPrograma.create',
            [
                'user' => $user,
                'zonas' => $listaZonas,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreZonaDependenciaProgramaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreZonaDependenciaProgramaRequest $request)
    {
        $programa = new Zona_Dependencia_Programa();
        $programa->id_zona = $request->idZona;
        $programa->nombre_zona = $request->nombreZona;
        $programa->clave_dependencia = $request->claveDependencia;
        $programa->nombre_dependencia = $request->nombreDependencia;
        $programa->clave_programa = $request->clavePrograma;
        $programa->nombre_programa = $request->nombrePrograma;

        //dd($dependencia);

        $programa->save();

        $user = Auth::user();
        $data = $request->idZona ." ". $request->nombreZona ." ". $request->claveDependencia ." ". $request->nombreDependencia ." ". $request->clavePrograma ." ". $request->nombrePrograma ;
        event(new LogUserActivity($user,"Creación de Programa Educativo",$data));

        return redirect()->route('zonaDependenciaPrograma.index');
    }

    public static function consultaDependencias($id){
        $lista = Zona_Dependencia_Programa::where('id_zona',$id)->get();
        return $lista;
    }

    public function fetchZonaDependencia(Request $request)
    {
        $data['zonaDependencias'] = Zona_Dependencia::where("id_zona", $request->idZona)
            ->get(["id_zona","nombre_zona","clave_dependencia","nombre_dependencia"]);

        return response()->json($data);
    }

    public function fetchNombreDependencia(Request $request)
    {
        $data['nombre'] = Zona_Dependencia::where("clave_dependencia", $request->claveDependencia)
            ->get(["nombre_dependencia"]);

        return response()->json($data);
    }



}
