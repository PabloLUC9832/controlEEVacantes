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

            $vacantes = DB::table('vacantes')->select('id','periodo','clavePeriodo','numZona','numDependencia','numArea','numPrograma',
                'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','plan','fechaApertura','fechaCierre',
                'observaciones','fechaRenuncia','bancoHorasDisponible')
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
                ->orderBy('nombreMateria','desc')
                ->paginate(15);

            if(isset($radioButton)){

                switch ($radioButton){

                    case "toda":
                        $vacantes = DB::table('vacantes')
                            ->select('id','periodo','clavePeriodo','numZona','numDependencia','numArea','numPrograma',
                                'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','plan','fechaApertura','fechaCierre',
                                'observaciones','fechaRenuncia','bancoHorasDisponible')
                            ->where('numPrograma','LIKE','%'.$search.'%')
                            ->orderBy('numPrograma', 'desc')
                            ->paginate(15)
                        ;
                        break;

                    case "vacante":
                        $vacantes = DB::table('vacantes')
                            ->select('id','periodo','clavePeriodo','numZona','numDependencia','numArea','numPrograma',
                                'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','plan','fechaApertura','fechaCierre',
                                'observaciones','fechaRenuncia','bancoHorasDisponible')
                            ->where(function ($query) use ($search){
                                $query->whereNull('numPersonalDocente')
                                       ->where('nombreMateria','LIKE','%'.$search.'%')
                                       ;
                            })
                            //->where('nombreMateria','LIKE','%'.$search.'%')
                            ->orderBy('nombreMateria', 'desc')
                            ->paginate(15)
                        ;
                        break;

                    case "noVacante":
                        $vacantes = DB::table('vacantes')
                            ->select('id','periodo','clavePeriodo','numZona','numDependencia','numArea','numPrograma',
                                'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','plan','fechaApertura','fechaCierre',
                                'observaciones','fechaRenuncia','bancoHorasDisponible')
                            ->where(function ($query) use ($search){
                                $query->whereNotNull('numPersonalDocente')
                                    ->where('nombreMateria','LIKE','%'.$search.'%')
                                ;
                            })
                            ->orderBy('numHoras', 'desc')
                            ->paginate(15)
                        ;
                        break;


                    default:
                        $vacantes = DB::table('vacantes')
                            ->select('id','periodo','clavePeriodo','numZona','numDependencia','numArea','numPrograma',
                                'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','plan','fechaApertura','fechaCierre',
                                'observaciones','fechaRenuncia','bancoHorasDisponible')
                            ->where('periodo','LIKE','%'.$search.'%')
                            ->orWhere('numZona','LIKE','%'.$search.'%')
                            ->orWhere('numDependencia','LIKE','%'.$search.'%')
                            ->orWhere('numArea','LIKE','%'.$search.'%')
                            ->orWhere('numPrograma','LIKE','%'.$search.'%')
                            ->orWhere('numPlaza','LIKE','%'.$search.'%')
                            ->orWhere('numHoras','LIKE','%'.$search.'%')
                            ->orWhere('numMateria','LIKE','%'.$search.'%')
                            ->orWhere('nombreMateria','LIKE','%'.$search.'%')
                            ->orWhere('grupo','LIKE','%'.$search.'%')
                            ->orWhere('numMotivo','LIKE','%'.$search.'%')
                            ->orWhere('tipoAsignacion','LIKE','%'.$search.'%')
                            ->orWhere('numPersonalDocente','LIKE','%'.$search.'%')
                            ->orWhere('plan','LIKE','%'.$search.'%')
                            ->orWhere('fechaApertura','LIKE','%'.$search.'%')
                            ->orWhere('fechaCierre','LIKE','%'.$search.'%')
                            ->orWhere('observaciones','LIKE','%'.$search.'%')
                            ->orWhere('fechaRenuncia','LIKE','%'.$search.'%')
                            ->orderBy('nombreMateria','desc')
                            ->paginate(15)
                        ;
                }

            }

        }else{


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
        $vacante->fechaApertura=$request->fechaApertura;
        $vacante->fechaCierre=$request->fechaCierre;
        $vacante->fechaRenuncia=$request->fechaRenuncia;
        $vacante->bancoHorasDisponible=$request->bancoHorasDisponible;

        $vacante->save();

        $user = Auth::user();
        $data = $request->periodo .  " " . $request->clavePeriodo . " " . $request->numZona . " " . $request->numDependencia . " " . $request->numPlaza
                . " " . $request->numHoras . " " . $request->numMateria . " " . $request->nombreMateria . " " . $request->grupo . " " . $request->subGrupo
                . " " . $request->numMotivo . " " . $request->tipoAsignacion . " " . $request->numPersonalDocente . " " . $request->plan
                . " " . $request->observaciones . " " . $request->fechaApertura . " " . $request->fechaCierre . " " . $request->fechaRenuncia
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

        return view('vacante.edit', compact('vacante'),['programas' => $listaProgramas,
                                                                      'user' => $user,
                                                                      'motivos' => $listaMotivos,
                                                                      'docentes' => $listaDocentes,
                                                                      'experienciasEducativas' => $listaExperienciasEducativas,
                                                                      'periodos' => $listaPeriodos,
                                                                      'tiposAsignacion' => $listaTiposAsignacion,
                                                                     ]);
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
        //$vacante->update($request->all());
        //dd($request);

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
        $fechaApertura=$request->fechaApertura;
        $fechaCierre=$request->fechaCierre;
        $fechaRenuncia=$request->fechaRenuncia;
        $bancoHorasDisponible=$request->bancoHorasDisponible;



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
            'fechaApertura' => $fechaApertura ,
            'fechaCierre' => $fechaCierre ,
            'fechaRenuncia' => $fechaRenuncia ,
            'bancoHorasDisponible' => $bancoHorasDisponible ,
        ]);




        $user = Auth::user();
        $data = $request->periodo .  " " . $request->clavePeriodo . " " . $request->numZona . " " . $request->numDependencia . " " . $request->numPlaza
                . " " . $request->numHoras . " " . $request->numMateria . " " . $request->nombreMateria . " " . $request->grupo . " " . $request->subGrupo
                . " " . $request->numMotivo . " " . $request->tipoAsignacion . " " . $request->numPersonalDocente . " " . $request->plan
                . " " . $request->observaciones . " " . $request->fechaApertura . " " . $request->fechaCierre . " " . $request->fechaRenuncia
                . " " . $request->bancoHorasDisponible ;
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

    public function fetchNombreExperienciaEducativa(Request $request)
    {
        $data['nombreExperienciaEducativa'] = ExperienciaEducativa::where("nrc", $request->nrc)
                                ->get(["nrc","nombre"]);

        return response()->json($data);
    }

    public function category(){

        return view('vacante.category');

    }

}
