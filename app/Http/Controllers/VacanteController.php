<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexVacanteRequest;
use App\Http\Requests\StoreDocenteRequest;
use App\Http\Requests\StoreExperienciaEducativaRequest;
use App\Models\Area;
use App\Models\Docente;
use App\Models\HistoricoDocente;
use App\Models\Periodo;
use App\Models\SearchVacante;
use App\Models\TipoAsignacion;
use App\Models\Vacante;
use App\Models\Motivo;
use App\Models\ExperienciaEducativa;
use App\Http\Requests\StoreVacanteRequest;
use App\Models\Zona;
use App\Models\Zona_Dependencia;
use App\Models\Zona_Dependencia_Programa;
use App\Providers\LogUserActivity;
use App\Providers\OperacionCierreVacante;
use App\Providers\OperacionHorasVacante;
use App\Providers\RenunciaDocente;
use App\Providers\SelectVacanteIndex;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


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
        $vacantes = [];
        $countVacantes = 0;

        $nombreZona = "";
        $nombreDependencia = "";
        $nombrePrograma = "";

        $listaDependenciasSelect = "";
        $listaProgramasSelect = "";

        $userSelect = SearchVacante::where('id_user',$user)->first();
        $programasEducUsuario = [];

        $userRol = Auth::user()->hasTeamRole(auth()->user()->currentTeam, 'admin');
        //Si el rol es admin
        if($userRol){

            $vac= SearchVacante::where('id_user',$user)->get();
            if (count($vac) === 0 ){
                $programasEducUsuario = [];
                $zona = "";
                $dependencia = "";
                $programa = "";
                $filtro = "";
                $busqueda = "";
                $isDeleted = false;
                $vacantes = DB::table('vacantes')
                    ->join('periodos',function($join){
                        $join->on('vacantes.clavePeriodo','=','periodos.clavePeriodo')
                            ->where('periodos.actual',"=",1)
                            ->whereNull('deleted_at');
                    })
                    ->paginate('15')
                ;
            }else{

                $zona = $userSelect->id_zona;
                $dependencia = $userSelect->clave_dependencia;
                $programa = $userSelect->clave_programa;
                $filtro = $userSelect->filtro;
                $busqueda = $userSelect->busqueda;
                $isDeleted = $filtro=="VacantesCerradas";

                $vacantes = $this->busquedaVacante($zona,$dependencia,$programa,$filtro,$busqueda);
                $countVacantes = $vacantes->count();

                $nombreZona = DB::table('zonas')->where('id',$zona)->value('nombre');
                $nombreDependencia = DB::table('zona__dependencias')->where('clave_dependencia',$dependencia)->value('nombre_dependencia');
                $nombrePrograma = DB::table('zona__dependencia__programas')->where('clave_programa',$programa)->value('nombre_programa');

                $listaDependenciasSelect = Zona_Dependencia::all()->where('id_zona',$zona);
                $listaProgramasSelect = Zona_Dependencia_Programa::all()->where('clave_dependencia',$dependencia);
            }

        }else{

            $vac= SearchVacante::where('id_user',$user)->get();

            $user = auth()->user();
            $zona = $user->zona;
            $dependencia = $user->dependencia;
            $programasEducUsuario = DB::table('zona__dependencia__programas')
                ->where('id_zona','=',$zona)
                ->where('clave_dependencia','=',$dependencia)
                ->get();

            if (count($vac) === 0 ){

                $programa = "";
                $filtro = "";
                $busqueda = "";
                $isDeleted = false;

                $vacantes = DB::table('vacantes')
                    ->join('periodos',function($join) use ($zona,$dependencia){
                        $join->on('vacantes.clavePeriodo','=','periodos.clavePeriodo')
                            ->where('periodos.actual',"=",1)
                            ->whereNull('deleted_at')
                            ->where('numZona','=',$zona)
                            ->where('numDependencia','=',$dependencia);
                    })
                    ->paginate('15')
                ;

            }else{

                $programa = $userSelect->clave_programa;
                $filtro = $userSelect->filtro;
                $busqueda = $userSelect->busqueda;
                $isDeleted = $filtro=="VacantesCerradas";

                $vacantes = $this->busquedaVacante($zona,$dependencia,$programa,$filtro,$busqueda);
                $countVacantes = $vacantes->count();

                $nombrePrograma = DB::table('zona__dependencia__programas')->where('clave_programa',$programa)->value('nombre_programa');
            }

        }

        $zonas = Zona::all();

        return view('vacante.index',compact(
            'vacantes',
            'isDeleted',
            'zonas',
            'countVacantes',
            'zona',
            'dependencia',
            'programa',
            'filtro',
            'programasEducUsuario',
            'nombreZona',
            'nombreDependencia',
            'nombrePrograma',
            'listaDependenciasSelect',
            'listaProgramasSelect'
        ));
    }

    /**
     * Retorna variables al index para cargar los resultados de la búsqueda
     * @access public
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function search(Request $request){

        $user = auth()->user()->id;
        //$idUsuario = $user->id;
        $zona = $request->get('zona');
        $dependencia = $request->get('dependencia');
        $programa = $request->get('programa');
        $filtro = $request->get('filtro');
        $busqueda = $request->get('search');

        $nombreZona = DB::table('zonas')->where('id',$zona)->value('nombre');
        $nombreDependencia = DB::table('zona__dependencias')->where('clave_dependencia',$dependencia)->value('nombre_dependencia');
        $nombrePrograma = DB::table('zona__dependencia__programas')->where('clave_programa',$programa)->value('nombre_programa');

        $listaDependenciasSelect = Zona_Dependencia::all()->where('id_zona',$zona);
        $listaProgramasSelect = Zona_Dependencia_Programa::all()->where('clave_dependencia',$dependencia);

        $zonas = Zona::all();

        event(new SelectVacanteIndex($user,$zona,$dependencia,$programa,$filtro,$busqueda));
        $isDeleted = $filtro=="VacantesCerradas";
        $vacantes = $this->busquedaVacante($zona,$dependencia,$programa,$filtro,$busqueda);
        $countVacantes = $vacantes->count();

        $programasEducUsuario = DB::table('zona__dependencia__programas')
            ->where('id_zona','=',$zona)
            ->where('clave_dependencia','=',$dependencia)
            ->get();

        return view('vacante.index', compact(
                'vacantes','zona','zonas','dependencia','programa','filtro','isDeleted','countVacantes',
                'programasEducUsuario', 'nombreZona', 'nombreDependencia', 'nombrePrograma', 'listaDependenciasSelect',
                'listaProgramasSelect'
            )
        );

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
        /*
        if($request->file()){
            $fileName = time() ."_" . $request->file->getClientOriginalName();
        }
        */
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

        $lastID = DB::select("SELECT IDENT_CURRENT('vacantes')");
        $myArr = get_object_vars($lastID[0]);
        $oo = $myArr[""];
        $ulti = $oo + 1;

        //$vacante->archivo = "vac-{$ulti}";
        $vacante->archivo = "Inexistente";

        if($request->hasFile('files')){
            $directory="vac-{$ulti}";
            $vacante->archivo = "vac-{$ulti}";
            Storage::makeDirectory($directory);
            foreach ($request->file('files') as $file){
                $fileName = time() ."_" . $file->getClientOriginalName();
                $file->storeAs('/'.$directory.'/', $fileName, 'azure');
            }
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

        return redirect()->route('vacante.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDocenteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeDocente(StoreDocenteRequest $request){

        $docente = new Docente();
        $docente->nPersonal = $request->nPersonal;
        $docente->nombre = $request->nombre;
        $docente->apellidoPaterno = $request->apellidoPaterno;
        $docente->apellidoMaterno = $request->apellidoMaterno;
        $docente->email = $request->email;

        $docente->save();

        $user = Auth::user();
        $data = $request->nPersonal ." ". $request->nombre ." ". $request->apellidoPaterno ." ". $request->apellidoMaterno ." ".$request->email;
        event(new LogUserActivity($user,"Creación de Docente",$data));

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExperienciaEducativaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeEe(StoreExperienciaEducativaRequest $request){

        $ee = new ExperienciaEducativa();
        $ee->numMateria = $request->numMateria;
        $ee->nrc = $request->nrc;
        $ee->nombre = $request->nombre;
        $ee->horas = $request->horas;

        $ee->save();

        $user = Auth::user();
        $data = $request->numMateria ." " . $request->nrc ." ". $request->nombre ." ". $request->horas;
        event(new LogUserActivity($user,"Creación de Experiencia Educativa",$data));

        return redirect()->back();
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

            //obtener histórico docentes
            $listaDocentesHistorico = DB::table('historico_docentes')->where('vacanteID',$id)->get();

            /*
            *Obtener los archivos
            *@link https://www.jhanley.com/blog/laravel-adding-azure-blob-storage/
            */
            $path = "vac-{$id}";
            $disk = Storage::disk('azure');
            $files = $disk->files($path);
            $filesList = array();
            foreach ($files as $file){
                //$filename = "$path/$file";
                $filename = "$file";
                $item = array(
                    'name' => $filename,
                );
                array_push($filesList,$item);
            }


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
                    'listaDocentesHistorico' => $listaDocentesHistorico,
                    'files' => $filesList,
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

        $docenteCompleto = $request->numPersonalDocente;
        $docentePartes = explode("-",$docenteCompleto);
        $nombreDocente= $docentePartes[0];
        $numDocente = $docentePartes[1] ;

        //comparar nombre actual en la
        $numPersonalDocenteActual = $vacante->numPersonalDocente;
        $nombreDocenteActual = $vacante->nombreDocente;
        $fechaAvisoActual = $vacante->fechaAviso;
        $fechaAsignacionActual = $vacante->fechaAsignacion;

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
        //$archivo = "vac-{$id}";
        $archivo = $vacante->archivo;

        if($request->hasFile('files')){
            $directory="vac-{$vacante->id}";
            $archivo = $directory;
            foreach ($request->file('files') as $file){
                $fileName = time() ."_" . $file->getClientOriginalName();
                $file->storeAs('/'.$directory.'/', $fileName, 'azure');
            }
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

        if($nombreDocenteActual != $nombreCDocente && $nombreDocenteActual != ""){
            event(new RenunciaDocente($id,$numPersonalDocenteActual,$nombreDocenteActual,$fechaAvisoActual,$fechaAsignacionActual,$fechaRenuncia));
        }

        $user = Auth::user();
        $data = $request->periodo .  " " . $request->clavePeriodo . " " . $request->numZona . " " . $request->numDependencia . " " . $request->numPlaza
            . " " . $request->numHoras . " " . $request->numMateria . " " . $request->nombreMateria . " " . $request->grupo . " " . $request->subGrupo
            . " " . $request->numMotivo . " " . $request->tipoAsignacion . " " . $request->numPersonalDocente . " " . $request->plan
            . " " . $request->observaciones . " " . $request->fechaAsignacion . " " .$request->fechaApertura . " " . $request->fechaCierre . " " . $request->fechaRenuncia;
        event(new LogUserActivity($user,"Actualización de Vacante ID $id ",$data));

        return redirect()->route('vacante.index');


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

    public function deleteFile($id,$file)
    {
        $directory = $id.'/'.$file;
        //dd($d);
        Storage::disk('azure')->delete($directory);
        //Storage::disk('azure')->delete('vac-223/1678734935_matricula.pdf');

        $archivoPartes = explode("-",$id);
        $vacanteArchivo= $archivoPartes[0];
        $idVac = $archivoPartes[1] ;

        $vacante = Vacante::findOrFail($idVac);

        $path = "vac-" . $vacante->id;
        $disk = Storage::disk('azure');
        $files = $disk->files($path);
        $filesList = array();
        foreach ($files as $file){
            $filename = "$file";
            $item = array(
                'name' => $filename,
            );
            array_push($filesList,$item);
        }

        $nFile = count($filesList);
        if(empty($nFile) ){
            $vacante->update([
                'archivo' => "Inexistente" ,
            ]);
        }
        //dd($filesList);
        //die();
        //dd($vacante);
        //die();

        return redirect()->back();
    }

    /**
     * Mostrar la vista para importar el CSV
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

    /**
     * Función para buscar las horas de la experiencia educativa de acuerdo al option del select seleccionado.
     * Trabajo en conjunto con JS, en las vistas: vacante.SelectNrcNombreCreate , vacante.SelectNrcNombreEdit
     *
     * @link https://programmingpot.com/dependent-droop-down-in-laravel/
     * @link https://www.itsolutionstuff.com/post/how-to-make-simple-dependent-dropdown-using-jquery-ajax-in-laravel-5example.html
     * @link https://youtu.be/CBCo5wgiPs8
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchHorasExperienciaEducativa(Request $request)
    {
        $data['horasExperienciaEducativa'] = ExperienciaEducativa::where("nrc", $request->nrc)
            ->get(["nrc","horas"]);

        return response()->json($data);
    }

    /**
     *
     * Función para buscar las dependencias de las respectivas dependencias
     *
     * @link https://programmingpot.com/dependent-droop-down-in-laravel/
     * @link https://www.itsolutionstuff.com/post/how-to-make-simple-dependent-dropdown-using-jquery-ajax-in-laravel-5example.html
     * @link https://youtu.be/CBCo5wgiPs8
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchDependenciaVacante(Request $request)
    {
        $data['dependenciaVacante'] = Zona_Dependencia::where("id_zona", $request->idZona)
            ->get(["clave_dependencia","nombre_dependencia"]);

        return response()->json($data);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchProgramaVacante(Request $request)
    {
        $data['programaVacante'] = Zona_Dependencia_Programa::where("clave_dependencia", $request->idDependencia)
            ->get(["clave_programa","nombre_programa"]);

        return response()->json($data);
    }

    /**
     * Función para realizar las búsquedas usadas en el método de index y search
     *
     * @link https://laravel.com/docs/9.x/queries#joins
     * @link https://laravel.com/docs/9.x/queries#conditional-clauses
     *
     * @param $userSelectZona
     * @param $userSelectDependencia
     * @param $userSelectPrograma
     * @param $userSelectFiltro
     * @param $userSelectSearch
     * @return \Illuminate\Support\Collection
     */
    public function busquedaVacante($userSelectZona,$userSelectDependencia,$userSelectPrograma,$userSelectFiltro,$userSelectSearch){

        $vacantes = DB::table('vacantes')
            ->select('vacantes.id','periodo','vacantes.clavePeriodo','numZona','numDependencia','numArea','numPrograma',
                'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoContratacion',
                'tipoAsignacion', 'numPersonalDocente','nombreDocente','plan','observaciones','fechaAviso','fechaAsignacion',
                'fechaApertura','fechaCierre','fechaRenuncia','archivo')
            ->join('periodos', function($join)
            use ($userSelectZona,$userSelectDependencia,$userSelectPrograma,$userSelectFiltro,$userSelectSearch){
                $join->on('vacantes.clavePeriodo','=','periodos.clavePeriodo')
                    ->where('periodos.actual',"=",1)
                    ->where('numZona','=',$userSelectZona)
                    ->where('numDependencia','=',$userSelectDependencia)
                    ->where('numPrograma','=',$userSelectPrograma)
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
                    ->when( $userSelectFiltro == "VacantesCerradas" ,function($query)  {
                        $query->whereNotNull('deleted_at')
                        ;
                    })
                    ->when( $userSelectFiltro == "VacantesArchivos" ,function($query){
                        $query->whereNull('deleted_at')
                            //->whereNotNull('archivo')
                            ->where('archivo','<>','Inexistente')
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

        return $vacantes;

    }

}
