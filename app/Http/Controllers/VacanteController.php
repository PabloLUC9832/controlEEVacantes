<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Dependencia;
use App\Models\Docente;
use App\Models\Periodo;
use App\Models\Programa;
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
        $search = trim($request->get('search'));
        $radioButton = $request->get('tipo');
        $type = $request->get('type');

        $user = Auth::user()->hasTeamRole(auth()->user()->currentTeam, 'admin');

        if ($user){

            if(isset($type)){
                //https://laravel.com/docs/9.x/queries
                switch ($type){

                    case 'todo':

                    break;


                }

            }




        }else{

        }

        return view('vacante.index', compact('vacantes','search'));
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

        $user = auth()->user();

        return view('vacante.create',['programas' => $listaProgramas,
                                           'user' => $user,
                                           'motivos' => $listaMotivos,
                                           'docentes' => $listaDocentes,
                                           'experienciasEducativas' => $listaExperienciasEducativas,
                                           'periodos' => $listaPeriodos,
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

        $user = auth()->user();

        return view('vacante.edit', compact('vacante'),['programas' => $listaProgramas,
                                                                      'user' => $user,
                                                                      'motivos' => $listaMotivos,
                                                                      'docentes' => $listaDocentes,
                                                                      'experienciasEducativas' => $listaExperienciasEducativas,
                                                                      'periodos' => $listaPeriodos,
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
