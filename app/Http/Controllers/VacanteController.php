<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Dependencia;
use App\Models\Docente;
use App\Models\Periodo;
use App\Models\Programa;
use App\Models\TipoAsignacion;
use App\Models\Vacante;
use App\Models\Motivo;
use App\Models\ExperienciaEducativa;
use App\Http\Requests\StoreVacanteRequest;
use App\Http\Requests\UpdateVacanteRequest;
use App\Models\Zona;
use App\Models\Zona_Dependencia_Programa;
use App\Providers\LogUserActivity;
use App\Providers\OperacionCierreVacante;
use App\Providers\OperacionHorasVacante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VacanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //https://stackoverflow.com/questions/18564205/html-submit-form-on-radio-button-check
        $search = trim($request->get('search'));
        $radioButton = $request->get('tipoV');
        $isDeleted = false;

        $user = Auth::user()->hasTeamRole(auth()->user()->currentTeam, 'admin');

        if ($user){
            $vacantes = $this->busqueda($search);
            if(isset($radioButton)){

                switch ($radioButton){

                    case "toda":
                        $vacantes = $this->busqueda($search);
                    break;

                    case "vacante":
                        $vacantes = DB::table('vacantes')
                            ->select('vacantes.id','periodo','vacantes.clavePeriodo','numZona','numDependencia','numArea','numPrograma',
                                'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','nombreDocente','plan','fechaApertura','fechaCierre',
                                'observaciones','fechaRenuncia','archivo')
                            ->join('periodos',function ($join){
                                $join->on('vacantes.clavePeriodo','=','periodos.clavePeriodo')
                                    ->where('periodos.actual',"=",1)
                                    ->whereNull('deleted_at')
                                    ->whereNull('numPersonalDocente')
                                ;
                            })
                            ///->whereNull('numPersonalDocente')
                            ->orderBy('numDependencia', 'desc')
                            ->paginate(15)
                        ;
                    break;

                    case "noVacante":
                        $vacantes = DB::table('vacantes')
                            ->select('vacantes.id','periodo','vacantes.clavePeriodo','numZona','numDependencia','numArea','numPrograma',
                                'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','nombreDocente','plan','fechaApertura','fechaCierre',
                                'observaciones','fechaRenuncia','archivo')
                            ->join('periodos',function ($join){
                                $join->on('vacantes.clavePeriodo','=','periodos.clavePeriodo')
                                    ->where('periodos.actual',"=",1)
                                    ->whereNull('deleted_at')
                                    ->whereNotNull('numPersonalDocente')
                                ;
                            })
                            //->whereNotNull('numPersonalDocente')
                            ->orderBy('numDependencia', 'desc')
                            ->paginate(15)
                        ;
                    break;

                    case "vacanteCerrada":
                        $isDeleted = true;
                        $vacantes = DB::table('vacantes')
                            ->select('vacantes.id','periodo','vacantes.clavePeriodo','numZona','numDependencia','numArea','numPrograma',
                                'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','nombreDocente','plan','fechaApertura','fechaCierre',
                                'observaciones','fechaRenuncia','archivo')
                            ->join('periodos',function ($join){
                                $join->on('vacantes.clavePeriodo','=','periodos.clavePeriodo')
                                    ->where('periodos.actual',"=",1)
                                    ->whereNotNull('deleted_at')
                                ;
                            })
                            //->whereNotNull('deleted_at')
                            ->orderBy('numDependencia', 'desc')
                            ->paginate(15)
                        ;
                    break;

                    default:
                        $vacantes = $this->busqueda($search);
                }

            }

        }else{

            $userE = auth()->user();

            $vacantes = $this->busquedaEditor($search,$userE);

            if(isset($radioButton)){

                switch ($radioButton){

                    case "toda":

                        $vacantes = $this->busquedaEditor($search,$userE);

                    break;

                    case "vacante":

                        $vacantes = DB::table('vacantes')
                            ->select('id','periodo','clavePeriodo','numZona','numDependencia','numArea','numPrograma',
                                'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','nombreDocente','plan','fechaApertura','fechaCierre',
                                'observaciones','fechaRenuncia','archivo')
                            ->join('periodos', function($join) use ($user){
                                $join->on('vacantes.clavePeriodo','=','periodos.clavePeriodo')
                                    ->where('periodos.actual',"=",1)
                                    ->where('numDependencia','=',$user->dependencia)
                                    ->whereNull('deleted_at')
                                    ->whereNull('numPersonalDocente')
                                ;
                            })
                            ->orderBy('numPrograma', 'desc')
                            ->paginate(15)
                        ;

                    break;

                    case "noVacante":

                        $vacantes = DB::table('vacantes')
                            ->select('id','periodo','clavePeriodo','numZona','numDependencia','numArea','numPrograma',
                                'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','nombreDocente','plan','fechaApertura','fechaCierre',
                                'observaciones','fechaRenuncia','archivo')
                            ->join('periodos', function($join) use ($user){
                                $join->on('vacantes.clavePeriodo','=','periodos.clavePeriodo')
                                    ->where('periodos.actual',"=",1)
                                    ->where('numDependencia','=',$user->dependencia)
                                    ->whereNull('deleted_at')
                                    ->whereNotNull('numPersonalDocente')
                                ;
                            })
                            ->orderBy('numPrograma', 'desc')
                            ->paginate(15)
                        ;

                    break;

                    case "vacanteCerrada":
                        $isDeleted = true;
                        $vacantes = DB::table('vacantes')
                            ->select('id','periodo','clavePeriodo','numZona','numDependencia','numArea','numPrograma',
                                'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','nombreDocente','plan','fechaApertura','fechaCierre',
                                'observaciones','fechaRenuncia','archivo')
                            ->join('periodos', function($join) use ($user){
                                $join->on('vacantes.clavePeriodo','=','periodos.clavePeriodo')
                                    ->where('periodos.actual',"=",1)
                                    ->where('numDependencia','=',$user->dependencia)
                                    ->whereNotNull('deleted_at')
                                ;
                            })
                            ->orderBy('numDependencia', 'desc')
                            ->paginate(15)
                        ;
                        break;

                    default:
                        $vacantes = $this->busquedaEditor($search,$userE);

                }

            }


        }

        $user = auth()->user();

        //Obtener número y nombre de zona
        $zonaUsuario = $user->zona;
        $nombreZonaUsuario = DB::table('zonas')->where('id',$zonaUsuario)->value('nombre');

        //Obtener número y nombre de dependencia
        $dependenciaUsuario = $user->dependencia;
        $nombreDependenciaUsuario = DB::table('zona__dependencias')->where('clave_dependencia',$dependenciaUsuario)->value('nombre_dependencia');

        return view('vacante.index', compact('vacantes','search','radioButton','isDeleted','nombreZonaUsuario','nombreDependenciaUsuario'));

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
        $listaProgramas = Zona_Dependencia_Programa::where('id_zona',$zonaUsuario)->get();
        $listaMotivos = Motivo::all();
        $listaDocentes = Docente::all();
        $listaExperienciasEducativas = ExperienciaEducativa::all();
        $listaPeriodos = Periodo::all();
        $listaTiposAsignacion = TipoAsignacion::all();



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
                                          ]);
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

        $zonaCompleta = $request->numZona;
        $zonaPartes = explode("-",$zonaCompleta);

        $dependenciaCompleta = $request->numDependencia;
        $dependenciaPartes = explode("-",$dependenciaCompleta);

        $experienciaEducativaCompleta = $request->numMateria;
        $experienciaEducativaPartes = explode("~",$experienciaEducativaCompleta);

        if($request->file()){
            $fileName = time() ."_" . $request->file->getClientOriginalName();
        }

        $vacante = new Vacante();

        $vacante->periodo=$periodoPartes[0];
        $vacante->clavePeriodo=$periodoPartes[1];

        $vacante->numZona=$zonaPartes[0];
        $vacante->numDependencia=$dependenciaPartes[0];
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

        //Obtener número y nombre de zona
        $zonaUsuario = $user->zona;
        $nombreZonaUsuario = DB::table('zonas')->where('id',$zonaUsuario)->value('nombre');
        $numeroZonaUsuario = DB::table('zonas')->where('id',$zonaUsuario)->value('id');

        //Obtener número y nombre de dependencia
        $dependenciaUsuario = $user->dependencia;
        $nombreDependenciaUsuario = DB::table('zona__dependencias')->where('clave_dependencia',$dependenciaUsuario)->value('nombre_dependencia');
        $numeroDependenciaUsuario = DB::table('zona__dependencias')->where('clave_dependencia',$dependenciaUsuario)->value('clave_dependencia');

        //Obtener nombre de programa educativo
        $programaEducativoSeleccionado = DB::table('vacantes')->where('id',$id)->value('numPrograma');
        $nombreProgramaEducativo = DB::table('zona__dependencia__programas')->where('clave_programa',$programaEducativoSeleccionado)->value('nombre_programa');

        //Obtener nombre de zona del programa educativo
        $zonaProgramaEducativo = DB::table('zona__dependencia__programas')->where('clave_programa',$programaEducativoSeleccionado)->value('nombre_zona');

        $vacante = Vacante::findOrFail($id);

        //$listaProgramas = Zona_Dependencia_Programa::all();
        $listaProgramas = Zona_Dependencia_Programa::where('id_zona',$zonaUsuario)->get();
        $listaMotivos = Motivo::all();
        $listaDocentes = Docente::all();
        $listaExperienciasEducativas = ExperienciaEducativa::all();
        $listaPeriodos = Periodo::all();
        $listaTiposAsignacion = TipoAsignacion::all();



        $userEditor = Auth::user()->hasTeamRole(auth()->user()->currentTeam, 'admin');

        if($userEditor){
            return view('vacante.edit', compact('vacante'),['programas' => $listaProgramas,
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
                'nombreProgramaEducativo' => $nombreProgramaEducativo,
                'zonaProgramaEducativo' => $zonaProgramaEducativo,
            ]);
        }else{
            return view('vacante.editEditor', compact('vacante'),['programas' => $listaProgramas,
                'user' => $user,
                'motivos' => $listaMotivos,
                'docentes' => $listaDocentes,
                'experienciasEducativas' => $listaExperienciasEducativas,
                'periodos' => $listaPeriodos,
                'tiposAsignacion' => $listaTiposAsignacion,
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


    public function busqueda($search){
         /*
           select * from [dbo].[vacantes] v
           inner join [dbo].[periodos] p
           on v.clavePeriodo = p.clavePeriodo
           and p.actual = 1
         */
         $vacantes = DB::table('vacantes')->select('vacantes.id','periodo','vacantes.clavePeriodo','numZona','numDependencia','numArea','numPrograma','numPlaza','numHoras','numMateria','nombreDocente','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion', 'numPersonalDocente','plan','fechaApertura','fechaCierre','observaciones','fechaRenuncia','archivo')
            ->join('periodos', function($join){
                $join->on('vacantes.clavePeriodo','=','periodos.clavePeriodo')
                     ->where('periodos.actual',"=",1)
                     ->whereNull('deleted_at')
                     ;
            })

            ->where('numZona','LIKE','%'.$search.'%')
             ->orWhere('numDependencia','LIKE','%'.$search.'%')
             ->orWhere('numArea','LIKE','%'.$search.'%')
             ->orWhere('numPrograma','LIKE','%'.$search.'%')
             ->orWhere('numPlaza','LIKE','%'.$search.'%')
             ->orWhere('numHoras','LIKE','%'.$search.'%')
             ->orWhere('numMateria','LIKE','%'.$search.'%')
             ->orWhere('nombreMateria','LIKE','%'.$search.'%')
             ->orWhere('grupo','LIKE','%'.$search.'%')
             ->orWhere('subGrupo','LIKE','%'.$search.'%')
             ->orWhere('numMotivo','LIKE','%'.$search.'%')
             ->orWhere('tipoAsignacion','LIKE','%'.$search.'%')
             ->orWhere('numPersonalDocente','LIKE','%'.$search.'%')
             ->orWhere('nombreDocente','LIKE','%'.$search.'%')
             ->orWhere('plan','LIKE','&'.$search.'%')
             ->orWhere('observaciones','LIKE','%'.$search.'%')
             ->orWhere('fechaAsignacion','LIKE','%'.$search.'%')
             ->orWhere('fechaApertura','LIKE','%'.$search.'%')
             ->orWhere('fechaCierre','LIKE','%'.$search.'%')
             ->orWhere('fechaRenuncia','LIKE','%'.$search.'%')

            ->orderBy('numDependencia','desc')
            ->paginate(15);

         return $vacantes;

    }

    public function busquedaEditor($search,$user){

        $vacantes = DB::table('vacantes')->select('vacantes.id','periodo','vacantes.clavePeriodo','numZona','numDependencia','numArea','numPrograma',
            'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','nombreDocente','plan','fechaApertura','fechaCierre',
            'observaciones','fechaRenuncia','archivo')
            ->join('periodos', function($join) use ($user){
                $join->on('vacantes.clavePeriodo','=','periodos.clavePeriodo')
                    ->where('periodos.actual',"=",1)
                    ->where('numDependencia','=',$user->dependencia)
                    ->whereNull('deleted_at')
                ;
            })
            ->where('numPrograma','LIKE','%'.$search.'%')
            ->orWhere('numPlaza','LIKE','%'.$search.'%')
            ->orWhere('numHoras','LIKE','%'.$search.'%')
            ->orWhere('numMateria','LIKE','%'.$search.'%')
            ->orWhere('nombreMateria','LIKE','%'.$search.'%')
            ->orWhere('grupo','LIKE','%'.$search.'%')
            ->orWhere('subGrupo','LIKE','%'.$search.'%')
            ->orWhere('numMotivo','LIKE','%'.$search.'%')
            ->orWhere('tipoAsignacion','LIKE','%'.$search.'%')
            ->orWhere('numPersonalDocente','LIKE','%'.$search.'%')
            ->orWhere('nombreDocente','LIKE','%'.$search.'%')
            ->orWhere('plan','LIKE','&'.$search.'%')
            ->orWhere('observaciones','LIKE','%'.$search.'%')
            ->orWhere('fechaAsignacion','LIKE','%'.$search.'%')
            ->orWhere('fechaApertura','LIKE','%'.$search.'%')
            ->orWhere('fechaCierre','LIKE','%'.$search.'%')
            ->orWhere('fechaRenuncia','LIKE','%'.$search.'%')

            ->orderBy('numPrograma','desc')
            ->paginate(15)
        ;

        return $vacantes;

    }

}
