<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use App\Http\Requests\StoreVacanteRequest;
use App\Http\Requests\UpdateVacanteRequest;
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
        //
        $vacantes = DB::table('vacantes')->get();
        $listaVacantes = Vacante::all();
        //$motivos = DB::table('motivos')->select();
        return view('vacantesIndex', ['vacantes' => $vacantes], compact('listaVacantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('importVacantes');
        return view('crearVacante');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVacanteRequest  $request
     * @return \Illuminate\Http\Response
     */
    /*public function store(StoreVacanteRequest $request)
    {

        //
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
        return redirect("importVacantes");
    }*/

    public function store(Request $request){

        //return 'store';
        $vacante = new Vacante();

        $vacante->periodo=$request->periodo;
        $vacante->numZona=$request->numZona;
        $vacante->numDependencia=$request->numDependencia;
        $vacante->numArea=$request->numArea;
        $vacante->numPrograma=$request->numPrograma;
        $vacante->numPlaza=$request->numPlaza;
        $vacante->numHoras=$request->numHoras;
        $vacante->numMateria=$request->numMateria;
        $vacante->nombreMateria=$request->nombreMateria;
        $vacante->grupo=$request->grupo;
        $vacante->numMotivo=$request->numMotivo;

        $vacante->save();

        return redirect()->route('vacantes.index');
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
        //
        $vacante = Vacante::find($id);
        return view('editarVacante', compact('vacante'));
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
        //
        $vacante = Vacante::find($id);
        $vacante->update($request->all());
        return redirect()->route('vacantes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $vacante = Vacante::find($id);

        $vacante->delete();

        return redirect()->route('vacantes.index');
    }
}
