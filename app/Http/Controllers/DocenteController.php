<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Http\Requests\StoreDocenteRequest;
use App\Http\Requests\UpdateDocenteRequest;
use App\Providers\LogUserActivity;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //https://youtu.be/XeYd_kYkUJE
        $listaDocentes = Docente::all();
        return view('docente.index',['docentes' => $listaDocentes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('docente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDocenteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocenteRequest $request)
    {


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

        return redirect()->route('docente.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function show(Docente $docente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function edit($nPersonal)
    {
        //
        $docente = Docente::where('nPersonal',$nPersonal)->firstOrFail();
        return view('docente.edit', compact('docente'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDocenteRequest  $request
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDocenteRequest $request, $nPersonal)
    {
        $docente = Docente::where('nPersonal',$nPersonal)->firstOrFail();
        $noPersonal = $request->nPersonal;
        $nombre = $request->nombre;
        $apellidoPaterno = $request->apellidoPaterno;
        $apellidoMaterno = $request->apellidoMaterno;
        $email = $request->email;


        //$docente->update($request->all());
        $docente->update([
            'nPersonal' => $noPersonal,
            'nombre' => $nombre,
            'apellidoPaterno' => $apellidoPaterno,
            'apellidoMaterno' => $apellidoMaterno,
            'email' => $email,
        ]);

        $user = Auth::user();
        $data = $request->nPersonal ." ". $request->nombre ." ". $request->apellidoPaterno ." ". $request->apellidoMaterno ." ".$request->email;
        event(new LogUserActivity($user,"Actualización de Docente ID: $request->nPersonal",$data));

        return redirect()->route('docente.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function destroy($nPersonal)
    {
        $docente = Docente::where('nPersonal',$nPersonal)->firstOrFail();
        $docente->delete($nPersonal);

        $user = Auth::user();
        //$data = $request->nPersonal ." ". $request->nombre ." ". $request->apellidoPaterno ." ". $request->apellidoMaterno ." ".$request->email;
        $data = "Eliminación de Docente ID: $nPersonal";
        event(new LogUserActivity($user,"Eliminación de Docente ID $nPersonal",$data));

        return redirect()->route('docente.index');

    }
    /**
     * Genera el archivo pdf, a partir de la vista proporcioanda
     * https://github.com/barryvdh/laravel-dompdf
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        $listaDocentes = Docente::all();
        $pdf = Pdf::loadView('pdf.template', [
            'docentes' => $listaDocentes,
        ]);

        $user = Auth::user();
        $data = "Generación de Reporte de Docentes";
        event(new LogUserActivity($user,"Generación de Reporte de Docentes",$data));

        //lo muestra en el navegador
        return $pdf->stream();
        //descarga directa
        //return $pdf->download('Docentes.pdf');
        //return view('pdf.template',['docentes' => $listaDocentes]);
    }

}
