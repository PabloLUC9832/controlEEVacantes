<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexVacanteRequest;
use App\Models\Area;
use App\Models\Dependencia;
use App\Models\Docente;
use App\Models\Periodo;
use App\Models\Programa;
use App\Models\SearchVacante;
use App\Models\TipoAsignacion;
use App\Models\Vacante;
use App\Models\Motivo;
use App\Models\ExperienciaEducativa;
use App\Http\Requests\StoreVacanteRequest;
use App\Http\Requests\UpdateVacanteRequest;
use App\Models\Zona;
use App\Models\Zona_Dependencia;
use App\Models\Zona_Dependencia_Programa;
use App\Providers\LogUserActivity;
use App\Providers\OperacionCierreVacante;
use App\Providers\OperacionHorasVacante;
use App\Providers\SelectVacanteIndex;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class VacanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function index(Request $request)*/
    public function index(IndexVacanteRequest $request)
    {

        $user = auth()->user()->id;
        $userSelect = SearchVacante::where('id_user',$user)->first();
        $userSearchCount = $userSelect->count();
        $userSelectZona = $userSelect->id_zona;
        $userSelectDependencia = $userSelect->clave_dependencia;
        $userSelectPrograma = $userSelect->clave_programa;
        $userSelectFiltro = $userSelect->filtro;
        $userSelectSearch = $userSelect->search;


        $vacantes = "";
        $countVacantes = 0;
        $isDeleted = false;

        if ($userSearchCount == 0){
            $vacantes = Vacante::all();
        }else{

            $vacantes = DB::table('vacantes')
                ->select('vacantes.id','periodo','vacantes.clavePeriodo','numZona','numDependencia','numArea','numPrograma',
                    'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoContratacion',
                    'tipoAsignacion', 'numPersonalDocente','nombreDocente','plan','observaciones','fechaAviso','fechaAsignacion',
                    'fechaApertura','fechaCierre','fechaRenuncia','archivo')
                ->join('periodos', function($join) use ($userSelectZona,$userSelectDependencia,$userSelectPrograma,$userSelectSearch,$userSelectFiltro){
                    $join->on('vacantes.clavePeriodo','=','periodos.clavePeriodo')
                        ->where('periodos.actual',"=",1)
                        ->where('numZona','=',$userSelectZona)
                        ->where('numDependencia','=',$userSelectDependencia)
                        ->where('numPrograma','=',$userSelectPrograma)
                        //->whereNull('deleted_at')
                        ->when( $userSelectFiltro == "Todas" ,function($query){
                            $query->whereNull('deleted_at');
                        })
                        ->when( $userSelectFiltro == "Vacantes" ,function($query){
                            $query->whereNull('deleted_at')
                                  ->whereNull('numPersonalDocente')
                                  ;
                        })
                        ->when( $userSelectFiltro == "NoVacantes" ,function($query){
                            $query->whereNull('deleted_at')
                                  ->whereNotNull('numPersonalDocente')
                                  ;
                        })
                        ->when( $userSelectFiltro == "VacantesCerradas" ,function($query){
                            $query->whereNotNull('deleted_at')
                                  ;
                        })
                        ->when( $userSelectFiltro == "VacantesArchivos" ,function($query){
                            $query->whereNull('deleted_at')
                                  ->whereNotNull('archivo')
                                  ;
                        })
                        ->when( $userSelectFiltro == "ComplementoCarga" ,function($query){
                            $query->whereNull('deleted_at')
                                  ->where('tipoAsignacion','=','Complemento de carga')
                                  ;
                        })
                        ->when( $userSelectFiltro == "CargaObligatoria" ,function($query){
                            $query->whereNull('deleted_at')
                                  ->where('tipoAsignacion','=','Carga obligatoria')
                                  ;
                        })
                        ->where(function ($query) use ($userSelectSearch){
                            $query->where('numPlaza','LIKE','%'.$userSelectSearch.'%')
                                ->orWhere('numHoras','LIKE','%'.$userSelectSearch.'%')
                                ->orWhere('numMateria','LIKE','%'.$userSelectSearch.'%')
                                ->orWhere('nombreMateria','LIKE','%'.$userSelectSearch.'%')
                                ->orWhere('grupo','LIKE','%'.$userSelectSearch.'%')
                                ->orWhere('subGrupo','LIKE','%'.$userSelectSearch.'%')
                                ->orWhere('numMotivo','LIKE','%'.$userSelectSearch.'%')
                                ->orWhere('tipoContratacion','LIKE','%'.$userSelectSearch.'%')
                                ->orWhere('tipoAsignacion','LIKE','%'.$userSelectSearch.'%')
                                ->orWhere('numPersonalDocente','LIKE','%'.$userSelectSearch.'%')
                                ->orWhere('nombreDocente','LIKE','%'.$userSelectSearch.'%')
                                ->orWhere('plan','LIKE','%'.$userSelectSearch.'%')
                                ->orWhere('observaciones','LIKE','%'.$userSelectSearch.'%')
                                ->orWhere('fechaAviso','LIKE','%'.$userSelectSearch.'%')
                                ->orWhere('fechaAsignacion','LIKE','%'.$userSelectSearch.'%')
                                ->orWhere('fechaApertura','LIKE','%'.$userSelectSearch.'%')
                                ->orWhere('fechaCierre','LIKE','%'.$userSelectSearch.'%')
                                ->orWhere('fechaRenuncia','LIKE','%'.$userSelectSearch.'%')
                            ;
                        })
                    ;
                })
            ->get()
            ;

            $countVacantes = $vacantes->count();

        }

        //dd($userSearchPrograma);
        $zonas = Zona::all();

        return view('vacante.index',compact(
            'vacantes',
            'isDeleted',
            'zonas',
            'countVacantes'
        ));
    }

    public function search(Request $request){

        $zona = $request->get('zona');
        $dependencia = $request->get('dependencia');
        $programa = $request->get('programa');
        $filtro = $request->get('filtro');
        $busqueda = $request->get('search');

        $user = auth()->user();
        //id del usuario sesión actual
        $idUsuario = $user->id;

        $zonas = Zona::all();
        $vacantes = Vacante::all();
        $isDeleted = false;

        //obtener id_zona
        $busquedaUsuario = SearchVacante::where('id_user',$idUsuario)->get();
        event(new SelectVacanteIndex($user->id,$zona,$dependencia,$programa,$filtro,$busqueda));

        return view('vacante.index', compact('zonas','vacantes','isDeleted'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();

        //Obtener número y nombre de zona
        $zonaUsuario = $user->zona;
        $nombreZonaUsuario = DB::table('zonas')->where('id',$zonaUsuario)->value('nombre');
        $numeroZonaUsuario = DB::table('zonas')->where('id',$zonaUsuario)->value('id');

        //Obtener número y nombre de dependencia
        $dependenciaUsuario = $user->dependencia;
        $nombreDependenciaUsuario = DB::table('zona__dependencias')->where('clave_dependencia',$dependenciaUsuario)->value('nombre_dependencia');
        $numeroDependenciaUsuario = DB::table('zona__dependencias')->where('clave_dependencia',$dependenciaUsuario)->value('clave_dependencia');

        //$listaProgramas = Zona_Dependencia_Programa::all();
        $zonas = Zona::all();
        $listaProgramas = Zona_Dependencia_Programa::where('clave_dependencia',$numeroDependenciaUsuario)->get();
        $listaMotivos = Motivo::all();
        $listaDocentes = Docente::all();
        $listaExperienciasEducativas = ExperienciaEducativa::all();
        $listaPeriodos = Periodo::all();
        $listaTiposAsignacion = TipoAsignacion::all();

        $userAdmin = Auth::user()->hasTeamRole(auth()->user()->currentTeam, 'admin');

        if($userAdmin){

        return view('vacante.create',['programas' => $listaProgramas,
                                           'user' => $user,
                                           'motivos' => $listaMotivos,
                                           'docentes' => $listaDocentes,
                                           'experienciasEducativas' => $listaExperienciasEducativas,
                                           'periodos' => $listaPeriodos,
                                           'tiposAsignacion' => $listaTiposAsignacion,
                                           'nombreZonaUsuario' => $nombreZonaUsuario,
                                           'numeroZonaUsuario' => $numeroZonaUsuario,
                                           'nombreDependenciaUsuario' => $nombreDependenciaUsuario,
                                           'numeroDependenciaUsuario' => $numeroDependenciaUsuario,
                                           'zonas' => $zonas,
                                          ]);
        }else{
                return view('vacante.createEditor',['programas' => $listaProgramas,
                    'user' => $user,
                    'motivos' => $listaMotivos,
                    'docentes' => $listaDocentes,
                    'experienciasEducativas' => $listaExperienciasEducativas,
                    'periodos' => $listaPeriodos,
                    'tiposAsignacion' => $listaTiposAsignacion,
                    'nombreZonaUsuario' => $nombreZonaUsuario,
                    'numeroZonaUsuario' => $numeroZonaUsuario,
                    'nombreDependenciaUsuario' => $nombreDependenciaUsuario,
                    'numeroDependenciaUsuario' => $numeroDependenciaUsuario,
                ]);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVacanteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVacanteRequest $request)
    {
        $docenteCompleto = $request->numPersonalDocente;
        $docentePartes = explode("-",$docenteCompleto);
        $nombreDocente= $docentePartes[0];
        $numDocente = $docentePartes[1] ;
        //dd($docenteCompleto);
        if(empty($numDocente)){
            $numDocente= "";
        }

        $periodoCompleto = $request->periodo;
        $periodoPartes = explode("-",$periodoCompleto);

        $experienciaEducativaCompleta = $request->numMateria;
        $experienciaEducativaPartes = explode("~",$experienciaEducativaCompleta);

        if($request->file()){
            $fileName = time() ."_" . $request->file->getClientOriginalName();
        }

        $vacante = new Vacante();

        $vacante->periodo=$periodoPartes[0];
        $vacante->clavePeriodo=$periodoPartes[1];

        $vacante->numZona=$request->numZona;
        $vacante->numDependencia=$request->numDependencia;
        $vacante->numArea=3;
        $vacante->numPrograma=$request->numPrograma;
        $vacante->numPlaza=$request->numPlaza;
        $vacante->numHoras=$request->numHoras;
        $vacante->numMateria=$experienciaEducativaPartes[0];
        $vacante->nombreMateria=$experienciaEducativaPartes[1];
        $vacante->grupo=$request->grupo;
        $vacante->subGrupo=$request->subGrupo;
        $vacante->numMotivo=$request->numMotivo;
        $vacante->tipoContratacion=$request->tipoContratacion;
        $vacante->tipoAsignacion=$request->tipoAsignacion;
        $vacante->nombreDocente=$nombreDocente;
        $vacante->numPersonalDocente=$numDocente;
        $vacante->plan=$request->plan;
        $vacante->observaciones=$request->observaciones;
        $vacante->fechaAviso=$request->fechaAviso;
        $vacante->fechaAsignacion=$request->fechaAsignacion;
        $vacante->fechaAsignacion=$request->fechaAsignacion;
        $vacante->fechaApertura=$request->fechaApertura;
        $vacante->fechaCierre=$request->fechaCierre;
        $vacante->fechaRenuncia=$request->fechaRenuncia;

        if (isset($request->file) ){
            $request->file('file')->storeAs('/', $fileName, 'azure');
            $vacante->archivo = $fileName;
        }

        $vacante->save();

        if (!empty($request->numHoras) && !empty($request->tipoAsignacion)){
            event(new OperacionHorasVacante($request->numHoras,$request->numPrograma,$request->tipoContratacion,$request->tipoAsignacion));
        }

        $user = Auth::user();
        $data = $request->periodo .  " " . $request->clavePeriodo . " " . $request->numZona . " " . $request->numDependencia . " " . $request->numPlaza
                . " " . $request->numHoras . " " . $request->numMateria . " " . $request->nombreMateria . " " . $request->grupo . " " . $request->subGrupo
                . " " . $request->numMotivo . " " . $request->tipoAsignacion . " " . $request->numPersonalDocente . " " . $request->plan
                . " " . $request->observaciones . " " . " ". $request->fechaAviso . $request->fechaAsignacion . " " . $request->fechaApertura . " " . $request->fechaCierre . " " . $request->fechaRenuncia;



        event(new LogUserActivity($user,"Creación de Vacante",$data));

        //return redirect()->route('dashboard');
        return redirect()->route('vacante.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function show(Vacante $vacante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = auth()->user();

        $vacante = Vacante::findOrFail($id);

        $listaMotivos = Motivo::all();
        $listaDocentes = Docente::all();
        $listaExperienciasEducativas = ExperienciaEducativa::all();
        $listaPeriodos = Periodo::all();
        $listaTiposAsignacion = TipoAsignacion::all();

        $zonas = Zona::all();

        $userAdmin = Auth::user()->hasTeamRole(auth()->user()->currentTeam, 'admin');

        if($userAdmin){

            //Obtener nombre de la zona de la vacante
            $idZonaVacante = DB::table('vacantes')->where('id',$id)->value('numZona');
            $nombreZonaVacante = DB::table('zonas')->where('id',$idZonaVacante)->value('nombre');

            //Obtener nombre de la dependencia de la vacante
            $claveDependenciaVacante = DB::table('vacantes')->where('id',$id)->value('numDependencia');
            $nombreDependenciaVacante = DB::table('zona__dependencias')->where('clave_dependencia',$claveDependenciaVacante)->value('nombre_dependencia');
            //Lista de dependencias ligadas a la zona al editar vacante para corregir el dropdown
            $listaDependencias = Zona_Dependencia::all()->where('id_zona',$idZonaVacante);

            //Obtener nombre de programa educativo
            $programaEducativoSeleccionado = DB::table('vacantes')->where('id',$id)->value('numPrograma');
            $nombreProgramaEducativo = DB::table('zona__dependencia__programas')->where('clave_programa',$programaEducativoSeleccionado)->value('nombre_programa');
            //Lista de programas ligados a la dependencia al editar vacante para corregir el dropdown
            $listaProgramas = Zona_Dependencia_Programa::all()->where('clave_dependencia',$claveDependenciaVacante);

            return view('vacante.edit', compact('vacante'),
                ['user' => $user,
                'motivos' => $listaMotivos,
                'docentes' => $listaDocentes,
                'experienciasEducativas' => $listaExperienciasEducativas,
                'periodos' => $listaPeriodos,
                'tiposAsignacion' => $listaTiposAsignacion,
                'nombreProgramaEducativo' => $nombreProgramaEducativo,
                'nombreZonaVacante' => $nombreZonaVacante,
                'nombreDependenciaVacante' => $nombreDependenciaVacante,
                'zonas' => $zonas,
                    'listaDependencias' => $listaDependencias,
                    'listaProgramas' => $listaProgramas,
            ]);
        }else{
            //Obtener número y nombre de zona
            $zonaUsuario = $user->zona;
            $nombreZonaUsuario = DB::table('zonas')->where('id',$zonaUsuario)->value('nombre');
            $numeroZonaUsuario = DB::table('zonas')->where('id',$zonaUsuario)->value('id');
            $listaProgramasEditor = Zona_Dependencia_Programa::where('id_zona',$zonaUsuario)->get();

            return view('vacante.editEditor', compact('vacante'),
                ['programas' => $listaProgramasEditor,
                'user' => $user,
            ]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVacanteRequest  $request
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vacante = Vacante::findOrFail($id);

        $zonaAnterior=$vacante->numZona;
        $dependenciaAnterior=$vacante->numDependencia;
        $programaAnterior=$vacante->numPrograma;

        $docenteCompleto = $request->numPersonalDocente;
        $docentePartes = explode("-",$docenteCompleto);
        $nombreDocente= $docentePartes[0];
        $numDocente = $docentePartes[1] ;

        if(empty($numDocente)){
            $numDocente= "";
        }

        $zonaCompleta = $request->numZona;
        $zonaPartes = explode("-",$zonaCompleta);

        $dependenciaCompleta = $request->numDependencia;
        $dependenciaPartes = explode("-",$dependenciaCompleta);

        $periodoCompleto = $request->periodo;
        $periodoPartes = explode("-",$periodoCompleto);

        $periodo=$periodoPartes[0];
        $clavePeriodo=$periodoPartes[1];

        $numZona=$zonaPartes[0];
        $numDependencia=$dependenciaPartes[0];

        $experienciaEducativaCompleta = $request->numMateria;
        $experienciaEducativaPartes = explode("~",$experienciaEducativaCompleta);

        $numArea=3;
        $numPrograma=$request->numPrograma;
        $numPlaza=$request->numPlaza;
        $numHoras=$request->numHoras;
        $numMateria=$experienciaEducativaPartes[0];
        $nombreMateria=$experienciaEducativaPartes[1];
        $grupo=$request->grupo;
        $subGrupo=$request->subGrupo;
        $numMotivo=$request->numMotivo;
        $tipoContratacion=$request->tipoContratacion;
        $tipoAsignacion=$request->tipoAsignacion;
        $numPersonalDocente = $numDocente;
        $nombreCDocente = $nombreDocente;
        $plan=$request->plan;
        $observaciones=$request->observaciones;
        $fechaAviso=$request->fechaAviso;
        $fechaAsignacion=$request->fechaAsignacion;
        $fechaApertura=$request->fechaApertura;
        $fechaCierre=$request->fechaCierre;
        $fechaRenuncia=$request->fechaRenuncia;

        if (isset($request->file) ){
            $fileName = time() ."_" . $request->file->getClientOriginalName();
            $request->file('file')->storeAs('/', $fileName, 'azure');
            $archivo = $fileName;
        }else{
            $archivo = $vacante->archivo;
        }

        $vacante->update([
            'periodo' => $periodo ,
            'clavePeriodo' => $clavePeriodo ,
            'numZona' => $numZona ,
            'numDependencia' => $numDependencia ,
            'numArea' => 3 ,
            'numPrograma' => $numPrograma ,
            'numPlaza' => $numPlaza ,
            'numHoras' => $numHoras ,
            'numMateria' => $numMateria ,
            'nombreMateria' => $nombreMateria ,
            'grupo' => $grupo ,
            'subGrupo' => $subGrupo ,
            'numMotivo' => $numMotivo ,
            'tipoContratacion' => $tipoContratacion ,
            'tipoAsignacion' => $tipoAsignacion ,
            'numPersonalDocente' => $numPersonalDocente ,
            'nombreDocente' => $nombreCDocente,
            'plan' => $plan ,
            'observaciones' => $observaciones ,
            'fechaAviso' => $fechaAviso ,
            'fechaAsignacion' => $fechaAsignacion ,
            'fechaApertura' => $fechaApertura ,
            'fechaCierre' => $fechaCierre ,
            'fechaRenuncia' => $fechaRenuncia ,
            'archivo' => $archivo ,
        ]);

        if (!empty($numHoras) && !empty($tipoAsignacion) && !empty($tipoContratacion)){
            event(new OperacionHorasVacante($numHoras,$numPrograma,$tipoContratacion,$tipoAsignacion));
        }

        $user = Auth::user();
        $data = $request->periodo .  " " . $request->clavePeriodo . " " . $request->numZona . " " . $request->numDependencia . " " . $request->numPlaza
                . " " . $request->numHoras . " " . $request->numMateria . " " . $request->nombreMateria . " " . $request->grupo . " " . $request->subGrupo
                . " " . $request->numMotivo . " " . $request->tipoAsignacion . " " . $request->numPersonalDocente . " " . $request->plan
                . " " . $request->observaciones . " " . $request->fechaAsignacion . " " .$request->fechaApertura . " " . $request->fechaCierre . " " . $request->fechaRenuncia;
        event(new LogUserActivity($user,"Actualización de Vacante ID $id ",$data));

        //return redirect()->route('vacante.index');
       //return back()->withInput();
        //dd($request);
        return to_route('vacante.index', [
            /*'zona' => $_GET['zona'],*/
            'zona' => $zonaAnterior,
            'dependencia' => $dependenciaAnterior,
            'programa' => $programaAnterior,
            'filtro' => 'Todas',
            'search' => '',
        ]);


    }

    public function updateE(Request $request, $id)
    {
        $vacante = Vacante::findOrFail($id);

        $observaciones=$request->observaciones;
        $fechaAsignacion=$request->fechaAsignacion;
        $fechaCierre=$request->fechaCierre;
        $fechaRenuncia=$request->fechaRenuncia;

        $vacante->update([
            'observaciones' => $observaciones ,
            'fechaAsignacion' => $fechaAsignacion ,
            'fechaCierre' => $fechaCierre ,
            'fechaRenuncia' => $fechaRenuncia ,
        ]);

        $user = Auth::user();
        $data = $request->observaciones . " " . $request->fechaAsignacion . " " . $request->fechaCierre . " " . $request->fechaRenuncia ;
        event(new LogUserActivity($user,"Actualización de Vacante ID $id ",$data));

        return redirect()->route('vacante.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vacante = Vacante::findOrFail($id);

        $numMotivo = $vacante->numMotivo;
        $numHoras = $vacante->numHoras;
        $numPrograma = $vacante->numPrograma;

        $vacante->delete();

        $user = Auth::user();
        $data = "Eliminación de Vacante ID: $id";
        event(new LogUserActivity($user,"Eliminación de Vacante ID: $id",$data));

        event(new OperacionCierreVacante($numMotivo,$numHoras,$numPrograma));

        return redirect()->route('vacante.index');
    }

    /**
     * Mostrar la vista
     */
    public function import(Request $request){

        return view('vacante.import');

    }

    /**
     * Carga el archivo CSV
     */
    public function uploadCSV(Request $request){

        //https://stackoverflow.com/questions/28757076/php-how-to-return-false-with-file-for-an-empty-csv-file
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        $file = file($request->file->getRealPath());
        $data = array_slice($file,1);

        $parts = (array_chunk($data,11));

        foreach($parts as $index=>$part){
            $fileName = resource_path('pending-files/'.date('y-m-d-H-i-s').$index. '.csv');
            file_put_contents($fileName,$part);
        }
        (new Vacante())->importToDB();
        session()->flash('status','esparando por importar');

        $user = Auth::user();
        $data = $request->file->getClientOriginalName();
        //var_dump($request->file);
        event(new LogUserActivity($user,"Importación de archivo CSV",$data));

        return redirect()->route("vacante.index");


    }

    public function uploadFile(Request $request){

        /*$request->validate([
            'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048'
        ]);*/

        if($request->file()) {
            //$fileName = time().'_'.$request->file->getClientOriginalName();
            $fileName = $request->file->getClientOriginalName();
            // save file to azure blob virtual directory uplaods in your container
            $filePath = $request->file('file')->storeAs('/', $fileName, 'azure');

            return back()
                ->with('success','File has been uploaded.');

        }
    }

    public function fetchHorasExperienciaEducativa(Request $request)
    {
        $data['horasExperienciaEducativa'] = ExperienciaEducativa::where("nrc", $request->nrc)
                                ->get(["nrc","horas"]);

        return response()->json($data);
    }


    public function fetchDependenciaVacante(Request $request)
    {
        $data['dependenciaVacante'] = Zona_Dependencia::where("id_zona", $request->idZona)
            ->get(["clave_dependencia","nombre_dependencia"]);

        return response()->json($data);
    }

    public function fetchProgramaVacante(Request $request)
    {
        $data['programaVacante'] = Zona_Dependencia_Programa::where("clave_dependencia", $request->idDependencia)
            ->get(["clave_programa","nombre_programa"]);

        return response()->json($data);
    }

}

