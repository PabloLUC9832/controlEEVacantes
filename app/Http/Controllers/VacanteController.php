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
use App\Providers\LogUserActivity;
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
                            ->select('id','periodo','clavePeriodo','numZona','numDependencia','numArea','numPrograma',
                                'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','plan','fechaApertura','fechaCierre',
                                'observaciones','fechaRenuncia','bancoHorasDisponible','archivo')
                            ->whereNull('numPersonalDocente')
                            ->orderBy('numDependencia', 'desc')
                            ->paginate(15)
                        ;
                    break;

                    case "noVacante":
                        $vacantes = DB::table('vacantes')
                            ->select('id','periodo','clavePeriodo','numZona','numDependencia','numArea','numPrograma',
                                'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','plan','fechaApertura','fechaCierre',
                                'observaciones','fechaRenuncia','bancoHorasDisponible','archivo')
                            ->whereNotNull('numPersonalDocente')
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
                                'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','plan','fechaApertura','fechaCierre',
                                'observaciones','fechaRenuncia','bancoHorasDisponible','archivo')
                            ->where(function ($query) use ($search){
                                $query->whereNull('numPersonalDocente')
                                    ->where('numDependencia','=',auth()->user()->dependencia)
                                ;
                            })
                            ->orderBy('numPrograma', 'desc')
                            ->paginate(15)
                        ;

                    break;

                    case "noVacante":

                        $vacantes = DB::table('vacantes')
                            ->select('id','periodo','clavePeriodo','numZona','numDependencia','numArea','numPrograma',
                                'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','plan','fechaApertura','fechaCierre',
                                'observaciones','fechaRenuncia','bancoHorasDisponible','archivo')
                            ->where(function ($query) use ($search){
                                $query->whereNotNull('numPersonalDocente')
                                    ->where('numDependencia','=',auth()->user()->dependencia)
                                ;
                            })
                            ->orderBy('numPrograma', 'desc')
                            ->paginate(15)
                        ;

                    break;

                    default:
                        $vacantes = $this->busquedaEditor($search,$userE);

                }

            }


        }

        return view('vacante.index', compact('vacantes','search','radioButton'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listaProgramas = Programa::all();
        $listaMotivos = Motivo::all();
        $listaDocentes = Docente::all();
        $listaExperienciasEducativas = ExperienciaEducativa::all();
        $listaPeriodos = Periodo::all();
        $listaTiposAsignacion = TipoAsignacion::all();

        $user = auth()->user();

        return view('vacante.create',['programas' => $listaProgramas,
                                           'user' => $user,
                                           'motivos' => $listaMotivos,
                                           'docentes' => $listaDocentes,
                                           'experienciasEducativas' => $listaExperienciasEducativas,
                                           'periodos' => $listaPeriodos,
                                           'tiposAsignacion' => $listaTiposAsignacion,
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

        $periodoCompleto = $request->periodo;
        $periodoPartes = explode("-",$periodoCompleto);


        $fileName = time() ."_" . $request->file->getClientOriginalName();

        $vacante = new Vacante();
        /*
        $vacante->periodo=$request->periodo;
        $vacante->clavePeriodo=$request->clavePeriodo;
        */
        $vacante->periodo=$periodoPartes[0];
        $vacante->clavePeriodo=$periodoPartes[1];

        $vacante->numZona=$request->numZona;
        $vacante->numDependencia=$request->numDependencia;
        //$vacante->numArea=$request->numArea;
        $vacante->numArea=3;
        $vacante->numPrograma=$request->numPrograma;
        $vacante->numPlaza=$request->numPlaza;
        $vacante->numHoras=$request->numHoras;
        $vacante->numMateria=$request->numMateria;
        $vacante->nombreMateria=$request->nombreMateria;
        $vacante->grupo=$request->grupo;
        $vacante->subGrupo=$request->subGrupo;
        $vacante->numMotivo=$request->numMotivo;
        $vacante->tipoAsignacion=$request->tipoAsignacion;
        $vacante->numPersonalDocente=$request->numPersonalDocente;
        $vacante->plan=$request->plan;
        $vacante->observaciones=$request->observaciones;
        $vacante->fechaAsignacion=$request->fechaAsignacion;
        $vacante->fechaApertura=$request->fechaApertura;
        $vacante->fechaCierre=$request->fechaCierre;
        $vacante->fechaRenuncia=$request->fechaRenuncia;
        $vacante->bancoHorasDisponible=$request->bancoHorasDisponible;

        if (isset($request->file) ){
            $request->file('file')->storeAs('/', $fileName, 'azure');
            $vacante->archivo = $fileName;
        }

        $vacante->save();

        $user = Auth::user();
        $data = $request->periodo .  " " . $request->clavePeriodo . " " . $request->numZona . " " . $request->numDependencia . " " . $request->numPlaza
                . " " . $request->numHoras . " " . $request->numMateria . " " . $request->nombreMateria . " " . $request->grupo . " " . $request->subGrupo
                . " " . $request->numMotivo . " " . $request->tipoAsignacion . " " . $request->numPersonalDocente . " " . $request->plan
                . " " . $request->observaciones . " " . $request->fechaAsignacion . " " . $request->fechaApertura . " " . $request->fechaCierre . " " . $request->fechaRenuncia
                . " " . $request->bancoHorasDisponible ;



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
        $vacante = Vacante::findOrFail($id);

        $listaProgramas = Programa::all();
        $listaMotivos = Motivo::all();
        $listaDocentes = Docente::all();
        $listaExperienciasEducativas = ExperienciaEducativa::all();
        $listaPeriodos = Periodo::all();
        $listaTiposAsignacion = TipoAsignacion::all();

        $user = auth()->user();

        $userEditor = Auth::user()->hasTeamRole(auth()->user()->currentTeam, 'admin');

        if($userEditor){
            return view('vacante.edit', compact('vacante'),['programas' => $listaProgramas,
                'user' => $user,
                'motivos' => $listaMotivos,
                'docentes' => $listaDocentes,
                'experienciasEducativas' => $listaExperienciasEducativas,
                'periodos' => $listaPeriodos,
                'tiposAsignacion' => $listaTiposAsignacion,
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

        $periodoCompleto = $request->periodo;
        $periodoPartes = explode("-",$periodoCompleto);

        $periodo=$periodoPartes[0];
        $clavePeriodo=$periodoPartes[1];

        $numZona=$request->numZona;
        $numDependencia=$request->numDependencia;

        $numArea=3;
        $numPrograma=$request->numPrograma;
        $numPlaza=$request->numPlaza;
        $numHoras=$request->numHoras;
        $numMateria=$request->numMateria;
        $nombreMateria=$request->nombreMateria;
        $grupo=$request->grupo;
        $subGrupo=$request->subGrupo;
        $numMotivo=$request->numMotivo;
        $tipoAsignacion=$request->tipoAsignacion;
        $numPersonalDocente=$request->numPersonalDocente;
        $plan=$request->plan;
        $observaciones=$request->observaciones;
        $fechaAsignacion=$request->fechaAsignacion;
        $fechaApertura=$request->fechaApertura;
        $fechaCierre=$request->fechaCierre;
        $fechaRenuncia=$request->fechaRenuncia;
        $bancoHorasDisponible=$request->bancoHorasDisponible;

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
            'tipoAsignacion' => $tipoAsignacion ,
            'numPersonalDocente' => $numPersonalDocente ,
            'plan' => $plan ,
            'observaciones' => $observaciones ,
            'fechaAsignacion' => $fechaAsignacion ,
            'fechaApertura' => $fechaApertura ,
            'fechaCierre' => $fechaCierre ,
            'fechaRenuncia' => $fechaRenuncia ,
            'bancoHorasDisponible' => $bancoHorasDisponible ,
            'archivo' => $archivo ,
        ]);




        $user = Auth::user();
        $data = $request->periodo .  " " . $request->clavePeriodo . " " . $request->numZona . " " . $request->numDependencia . " " . $request->numPlaza
                . " " . $request->numHoras . " " . $request->numMateria . " " . $request->nombreMateria . " " . $request->grupo . " " . $request->subGrupo
                . " " . $request->numMotivo . " " . $request->tipoAsignacion . " " . $request->numPersonalDocente . " " . $request->plan
                . " " . $request->observaciones . " " . $request->fechaAsignacion . " " .$request->fechaApertura . " " . $request->fechaCierre . " " . $request->fechaRenuncia
                . " " . $request->bancoHorasDisponible ;
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
        $vacante->delete();

        $user = Auth::user();
        $data = "Eliminación de Vacante ID: $id";
        event(new LogUserActivity($user,"Eliminación de Vacante ID: $id",$data));

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

    public function fetchNombreExperienciaEducativa(Request $request)
    {
        $data['nombreExperienciaEducativa'] = ExperienciaEducativa::where("nrc", $request->nrc)
                                ->get(["nrc","nombre"]);

        return response()->json($data);
    }


    public function busqueda($search){

         $vacantes = DB::table('vacantes')->select('id','periodo','clavePeriodo','numZona','numDependencia','numArea','numPrograma',
            'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','plan','fechaApertura','fechaCierre',
            'observaciones','fechaRenuncia','bancoHorasDisponible','archivo')
            ->where('periodo','LIKE','%'.$search.'%')
            ->where('clavePeriodo','LIKE','%'.$search.'%')
            ->orWhere('numZona','LIKE','%'.$search.'%')
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
            ->orWhere('plan','LIKE','%'.$search.'%')
            ->orWhere('fechaApertura','LIKE','%'.$search.'%')
            ->orWhere('fechaCierre','LIKE','%'.$search.'%')
            ->orWhere('observaciones','LIKE','%'.$search.'%')
            ->orWhere('fechaRenuncia','LIKE','%'.$search.'%')
            ->orderBy('numDependencia','desc')
            ->paginate(15);

         return $vacantes;

    }

    public function busquedaEditor($search,$user){

        $vacantes = DB::table('vacantes')->select('id','periodo','clavePeriodo','numZona','numDependencia','numArea','numPrograma',
            'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','plan','fechaApertura','fechaCierre',
            'observaciones','fechaRenuncia','bancoHorasDisponible','archivo')
            ->where(function ($query) use ($search,$user){
                $query->where('periodo','LIKE','%'.$search.'%')
                    //->where('numDependencia','=',auth()->user()->dependencia)
                    ->where('numDependencia','=',$user->dependencia)
                ;
            })
            ->orWhere(function ($query) use ($search,$user){
                $query->where('clavePeriodo','LIKE','%'.$search.'%')
                    ->where('numDependencia','=',$user->dependencia)
                ;
            })
            ->orWhere(function ($query) use ($search,$user){
                $query->where('numPrograma','LIKE','%'.$search.'%')
                    ->where('numDependencia','=',$user->dependencia)
                ;
            })
            ->orWhere(function ($query) use ($search,$user){
                $query->where('numPlaza','LIKE','%'.$search.'%')
                    ->where('numDependencia','=',$user->dependencia)
                ;
            })
            ->orWhere(function ($query) use ($search,$user){
                $query->where('numHoras','LIKE','%'.$search.'%')
                    ->where('numDependencia','=',$user->dependencia)
                ;
            })
            ->orWhere(function ($query) use ($search,$user){
                $query->where('numMateria','LIKE','%'.$search.'%')
                    ->where('numDependencia','=',$user->dependencia)
                ;
            })
            ->orWhere(function ($query) use ($search,$user){
                $query->where('nombreMateria','LIKE','%'.$search.'%')
                    ->where('numDependencia','=',$user->dependencia)
                ;
            })
            ->orWhere(function ($query) use ($search,$user){
                $query->where('grupo','LIKE','%'.$search.'%')
                    ->where('numDependencia','=',$user->dependencia)
                ;
            })
            ->orWhere(function ($query) use ($search,$user){
                $query->where('subGrupo','LIKE','%'.$search.'%')
                    ->where('numDependencia','=',$user->dependencia)
                ;
            })
            ->orWhere(function ($query) use ($search,$user){
                $query->where('numMotivo','LIKE','%'.$search.'%')
                    ->where('numDependencia','=',$user->dependencia)
                ;
            })
            ->orWhere(function ($query) use ($search,$user){
                $query->where('tipoAsignacion','LIKE','%'.$search.'%')
                    ->where('numDependencia','=',$user->dependencia)
                ;
            })
            ->orWhere(function ($query) use ($search,$user){
                $query->where('numPersonalDocente','LIKE','%'.$search.'%')
                    ->where('numDependencia','=',$user->dependencia)
                ;
            })
            ->orWhere(function ($query) use ($search,$user){
                $query->where('plan','LIKE','%'.$search.'%')
                    ->where('numDependencia','=',$user->dependencia)
                ;
            })
            ->orWhere(function ($query) use ($search,$user){
                $query->where('fechaApertura','LIKE','%'.$search.'%')
                    ->where('numDependencia','=',$user->dependencia)
                ;
            })
            ->orWhere(function ($query) use ($search,$user){
                $query->where('fechaCierre','LIKE','%'.$search.'%')
                    ->where('numDependencia','=',$user->dependencia)
                ;
            })
            ->orWhere(function ($query) use ($search,$user){
                $query->where('observaciones','LIKE','%'.$search.'%')
                    ->where('numDependencia','=',$user->dependencia)
                ;
            })
            ->orWhere(function ($query) use ($search,$user){
                $query->where('fechaRenuncia','LIKE','%'.$search.'%')
                    ->where('numDependencia','=',$user->dependencia)
                ;
            })
            ->orWhere(function ($query) use ($search,$user){
                $query->where('bancoHorasDisponible','LIKE','%'.$search.'%')
                    ->where('numDependencia','=',$user->dependencia)
                ;
            })
            ->orderBy('numPrograma','desc')
            ->paginate(15)
        ;

        return $vacantes;

    }

}
