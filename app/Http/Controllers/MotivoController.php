<?php

namespace App\Http\Controllers;

use App\Models\Motivo;
use App\Http\Requests\StoreMotivoRequest;
use App\Http\Requests\UpdateMotivoRequest;

class MotivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('import');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMotivoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMotivoRequest $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        $file = file($request->file->getRealPath());
        $data = array_slice($file,1);

        $parts = (array_chunk($data,80));

        foreach($parts as $index=>$part){
            $fileName = resource_path('pending-files/'.date('y-m-d-H-i-s').$index. '.csv');
            file_put_contents($fileName,$part);
        }
        (new Motivo())->importToDB();
        session()->flash('status','esparando por importar');
        return redirect("import");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Motivo  $motivo
     * @return \Illuminate\Http\Response
     */
    public function show(Motivo $motivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Motivo  $motivo
     * @return \Illuminate\Http\Response
     */
    public function edit(Motivo $motivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMotivoRequest  $request
     * @param  \App\Models\Motivo  $motivo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMotivoRequest $request, Motivo $motivo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Motivo  $motivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Motivo $motivo)
    {
        //
    }
}
