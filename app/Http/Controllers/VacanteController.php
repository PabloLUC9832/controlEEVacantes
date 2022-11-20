<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Dependencia;
use App\Models\Docente;
use App\Models\Programa;
use App\Models\Vacante;
use App\Models\Motivo;
use App\Http\Requests\StoreVacanteRequest;
use App\Http\Requests\UpdateVacanteRequest;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VacanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaVacantes = Vacante::all();
        $user = auth()->user();
        //$users = DB::table('users')
        //                ->where('votes', '=', 100)
        //                ->where('age', '>', 35)
        //                ->get();
        //$nombreZona = Zona::where('id','=',$user->zona)->get('nombre');
        //$nombreDependencia = Dependencia::all('nombre')->where('clave','=',$user->dependencia);

        $nombreZona = DB::table('zonas')->where('id','=',$user->zona)->get('nombre');
        $nombreDependencia = DB::table('dependencias')->where('clave','=',$user->dependencia)->get('nombre');


        return view('vacante.index',['vacantes' => $listaVacantes,'user' => $user,'nombreZona'=>$nombreZona,'nombreDependencia'=>$nombreDependencia]);
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
        $user = auth()->user();

        return view('vacante.create',['programas' => $listaProgramas,
                                           'user' => $user,
                                           'motivos' => $listaMotivos,
                                           'docentes' => $listaDocentes,
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
        $vacante = new Vacante();
        $vacante->periodo=$request->periodo;
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
        $user = auth()->user();

        return view('vacante.edit', compact('vacante'),['programas' => $listaProgramas,
                                                                      'user' => $user,
                                                                      'motivos' => $listaMotivos,
                                                                      'docentes' => $listaDocentes,
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
        $vacante->update($request->all());
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
        return redirect()->route("vacante.index");


    }

}
