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

                case "programa":
                    $vacantes = DB::table('vacantes')
                        ->select('id','periodo','clavePeriodo','numZona','numDependencia','numArea','numPrograma',
                        'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','plan','fechaApertura','fechaCierre',
                        'observaciones','fechaRenuncia','bancoHorasDisponible')
                        ->where('numPrograma','LIKE','%'.$search.'%')
                        ->orderBy('numPrograma', 'desc')
                        ->paginate(15)
                    ;
                break;

                case "experienciaEducativa":
                    $vacantes = DB::table('vacantes')
                        ->select('id','periodo','clavePeriodo','numZona','numDependencia','numArea','numPrograma',
                        'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','plan','fechaApertura','fechaCierre',
                        'observaciones','fechaRenuncia','bancoHorasDisponible')
                        ->where('nombreMateria','LIKE','%'.$search.'%')
                        ->orderBy('nombreMateria', 'desc')
                        ->paginate(15)
                    ;
                break;

                case "horas":
                    $vacantes = DB::table('vacantes')
                        ->select('id','periodo','clavePeriodo','numZona','numDependencia','numArea','numPrograma',
                        'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','plan','fechaApertura','fechaCierre',
                        'observaciones','fechaRenuncia','bancoHorasDisponible')
                        ->where('numHoras','LIKE','%'.$search.'%')
                        ->orderBy('numHoras', 'desc')
                        ->paginate(15)
                    ;
                break;

                case "grupo":
                    $vacantes = DB::table('vacantes')
                        ->select('id','periodo','clavePeriodo','numZona','numDependencia','numArea','numPrograma',
                        'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','plan','fechaApertura','fechaCierre',
                        'observaciones','fechaRenuncia','bancoHorasDisponible')
                        ->where('grupo','LIKE','%'.$search.'%')
                        ->orderBy('grupo', 'desc')
                        ->paginate(15)
                    ;
                break;

                case "plan":
                    $vacantes = DB::table('vacantes')
                        ->select('id','periodo','clavePeriodo','numZona','numDependencia','numArea','numPrograma',
                        'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','plan','fechaApertura','fechaCierre',
                        'observaciones','fechaRenuncia','bancoHorasDisponible')
                        ->where('plan','LIKE','%'.$search.'%')
                        ->orderBy('plan', 'desc')
                        ->paginate(15)
                    ;
                break;

                case "plaza":
                    $vacantes = DB::table('vacantes')
                        ->select('id','periodo','clavePeriodo','numZona','numDependencia','numArea','numPrograma',
                        'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','plan','fechaApertura','fechaCierre',
                        'observaciones','fechaRenuncia','bancoHorasDisponible')
                        ->where('numPlaza','LIKE','%'.$search.'%')
                        ->orderBy('numPlaza', 'desc')
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

            $vacantes = DB::table('vacantes')->select('id','periodo','clavePeriodo','numZona','numDependencia','numArea','numPrograma',
        'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','plan','fechaApertura','fechaCierre',
        'observaciones','fechaRenuncia','bancoHorasDisponible')
        ->where(function ($query) use ($search){
            $query->where('numPrograma','LIKE','%'.$search.'%')
                ->where('numDependencia','=',auth()->user()->dependencia)
            ;
        })
        ->orWhere(function ($query) use ($search){
            $query->where('numHoras','LIKE','%'.$search.'%')
                ->where('numDependencia','=',auth()->user()->dependencia)
            ;
        })
        ->orWhere(function ($query) use ($search){
            $query->where('periodo','LIKE','%'.$search.'%')
                ->where('numDependencia','=',auth()->user()->dependencia)
            ;
        })
        ->orWhere(function ($query) use ($search){
            $query->where('clavePeriodo','LIKE','%'.$search.'%')
                ->where('numDependencia','=',auth()->user()->dependencia)
            ;
        })        
        ->orWhere(function ($query) use ($search){
            $query->where('numZona','LIKE','%'.$search.'%')
                ->where('numDependencia','=',auth()->user()->dependencia)
            ;
        })
        ->orWhere(function ($query) use ($search){
            $query->where('numArea','LIKE','%'.$search.'%')
                ->where('numDependencia','=',auth()->user()->dependencia)
            ;
        })
        ->orWhere(function ($query) use ($search){
            $query->where('numPrograma','LIKE','%'.$search.'%')
                ->where('numDependencia','=',auth()->user()->dependencia)
            ;
        })
        ->orWhere(function ($query) use ($search){
            $query->where('numPlaza','LIKE','%'.$search.'%')
                ->where('numDependencia','=',auth()->user()->dependencia)
            ;
        })
        ->orWhere(function ($query) use ($search){
            $query->where('numHoras','LIKE','%'.$search.'%')
                ->where('numDependencia','=',auth()->user()->dependencia)
            ;
        })
        ->orWhere(function ($query) use ($search){
            $query->where('numMateria','LIKE','%'.$search.'%')
                ->where('numDependencia','=',auth()->user()->dependencia)
            ;
        })
        ->orWhere(function ($query) use ($search){
            $query->where('nombreMateria','LIKE','%'.$search.'%')
                ->where('numDependencia','=',auth()->user()->dependencia)
            ;
        })
        ->orWhere(function ($query) use ($search){
            $query->where('grupo','LIKE','%'.$search.'%')
                ->where('numDependencia','=',auth()->user()->dependencia)
            ;
        })
        ->orWhere(function ($query) use ($search){
            $query->where('subGrupo','LIKE','%'.$search.'%')
                ->where('numDependencia','=',auth()->user()->dependencia)
            ;
        })        
        ->orWhere(function ($query) use ($search){
            $query->where('numMotivo','LIKE','%'.$search.'%')
                ->where('numDependencia','=',auth()->user()->dependencia)
            ;
        })
        ->orWhere(function ($query) use ($search){
            $query->where('tipoAsignacion','LIKE','%'.$search.'%')
                ->where('numDependencia','=',auth()->user()->dependencia)
            ;
        })
        ->orWhere(function ($query) use ($search){
            $query->where('numPersonalDocente','LIKE','%'.$search.'%')
                ->where('numDependencia','=',auth()->user()->dependencia)
            ;
        })
        ->orWhere(function ($query) use ($search){
            $query->where('plan','LIKE','%'.$search.'%')
                ->where('numDependencia','=',auth()->user()->dependencia)
            ;
        })
        ->orWhere(function ($query) use ($search){
            $query->where('fechaApertura','LIKE','%'.$search.'%')
                ->where('numDependencia','=',auth()->user()->dependencia)
            ;
        })
        ->orWhere(function ($query) use ($search){
            $query->where('fechaCierre','LIKE','%'.$search.'%')
                ->where('numDependencia','=',auth()->user()->dependencia)
            ;
        })
        ->orWhere(function ($query) use ($search){
            $query->where('observaciones','LIKE','%'.$search.'%')
                ->where('numDependencia','=',auth()->user()->dependencia)
            ;
        })
        ->orWhere(function ($query) use ($search){
            $query->where('observaciones','LIKE','%'.$search.'%')
                ->where('fechaRenuncia','=',auth()->user()->dependencia)
            ;
        })
        ->orderBy('nombreMateria','desc')
        ->paginate(15)
            ;

        if(isset($radioButton)){

            switch ($radioButton){

                case "programa":

                    $vacantes = DB::table('vacantes')
                        ->select('id','periodo','clavePeriodo','numZona','numDependencia','numArea','numPrograma',
                        'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','plan','fechaApertura','fechaCierre',
                        'observaciones','fechaRenuncia','bancoHorasDisponible')
                        ->where(function ($query) use ($search){
                            $query->where('numPrograma','LIKE','%'.$search.'%')
                                ->where('numDependencia','=',auth()->user()->dependencia)
                            ;
                        })
                        ->orderBy('numPrograma', 'desc')
                        ->paginate(15)
                        ;
                break;

                case "experienciaEducativa":
                    $vacantes = DB::table('vacantes')
                        ->select('id','periodo','clavePeriodo','numZona','numDependencia','numArea','numPrograma',
                        'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','plan','fechaApertura','fechaCierre',
                        'observaciones','fechaRenuncia','bancoHorasDisponible')
                        ->where(function ($query) use ($search){
                            $query->where('nombreMateria','LIKE','%'.$search.'%')
                                ->where('numDependencia','=',auth()->user()->dependencia)
                            ;
                        })
                        ->orderBy('nombreMateria', 'desc')
                        ->paginate(15)
                    ;
                break;

                case "horas":
                        $vacantes = DB::table('vacantes')
                        ->select('id','periodo','clavePeriodo','numZona','numDependencia','numArea','numPrograma',
                        'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','plan','fechaApertura','fechaCierre',
                        'observaciones','fechaRenuncia','bancoHorasDisponible')
                        ->where(function ($query) use ($search){
                            $query->where('numHoras','LIKE','%'.$search.'%')
                                ->where('numDependencia','=',auth()->user()->dependencia)
                            ;
                        })
                        ->orderBy('numHoras', 'desc')
                        ->paginate(15)
                    ;
                break;

                case "grupo":
                        $vacantes = DB::table('vacantes')
                        ->select('id','periodo','numZona','numDependencia','numArea','numPrograma',
                        'numPlaza','numHoras','numMateria','nombreMateria','grupo','numMotivo','tipoAsignacion','numPersonalDocente','plan','fechaApertura','fechaCierre',
                        'observaciones','fechaRenuncia','bancoHorasDisponible')
                        ->where(function ($query) use ($search){
                            $query->where('grupo','LIKE','%'.$search.'%')
                                ->where('numDependencia','=',auth()->user()->dependencia)
                            ;
                        })
                        ->orderBy('grupo', 'desc')
                        ->paginate(15)
                    ;
                break;

                case "plan":
                        $vacantes = DB::table('vacantes')
                        ->select('id','periodo','clavePeriodo','numZona','numDependencia','numArea','numPrograma',
                        'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','plan','fechaApertura','fechaCierre',
                        'observaciones','fechaRenuncia','bancoHorasDisponible')
                        ->where(function ($query) use ($search){
                            $query->where('plan','LIKE','%'.$search.'%')
                                ->where('numDependencia','=',auth()->user()->dependencia)
                            ;
                        })
                        ->orderBy('plan', 'desc')
                        ->paginate(15)
                    ;
                break;

                case "plaza":
                        $vacantes = DB::table('vacantes')
                        ->select('id','periodo','clavePeriodo','numZona','numDependencia','numArea','numPrograma',
                        'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','plan','fechaApertura','fechaCierre',
                        'observaciones','fechaRenuncia','bancoHorasDisponible')
                        ->where(function ($query) use ($search){
                            $query->where('numPlaza','LIKE','%'.$search.'%')
                                ->where('numDependencia','=',auth()->user()->dependencia)
                            ;
                        })
                        ->orderBy('numPlaza', 'desc')
                        ->paginate(15)
                    ;
                break;

                default:
                        $vacantes = DB::table('vacantes')
                        ->select('id','periodo','clavePeriodo','numZona','numDependencia','numArea','numPrograma',
                        'numPlaza','numHoras','numMateria','nombreMateria','grupo','subGrupo','numMotivo','tipoAsignacion','numPersonalDocente','plan','fechaApertura','fechaCierre',
                        'observaciones','fechaRenuncia','bancoHorasDisponible')

                        ->where(function ($query) use ($search){
                            $query->where('numPrograma','LIKE','%'.$search.'%')
                                ->where('numDependencia','=',auth()->user()->dependencia)
                            ;
                        })
                        ->orWhere(function ($query) use ($search){
                            $query->where('numHoras','LIKE','%'.$search.'%')
                                ->where('numDependencia','=',auth()->user()->dependencia)
                            ;
                        })
                        ->orWhere(function ($query) use ($search){
                            $query->where('periodo','LIKE','%'.$search.'%')
                                ->where('numDependencia','=',auth()->user()->dependencia)
                            ;
                        })
                        ->orWhere(function ($query) use ($search){
                            $query->where('clavePeriodo','LIKE','%'.$search.'%')
                                ->where('numDependencia','=',auth()->user()->dependencia)
                            ;
                        })                        
                        ->orWhere(function ($query) use ($search){
                            $query->where('numZona','LIKE','%'.$search.'%')
                                ->where('numDependencia','=',auth()->user()->dependencia)
                            ;
                        })
                        ->orWhere(function ($query) use ($search){
                            $query->where('numArea','LIKE','%'.$search.'%')
                                ->where('numDependencia','=',auth()->user()->dependencia)
                            ;
                        })
                        ->orWhere(function ($query) use ($search){
                            $query->where('numPrograma','LIKE','%'.$search.'%')
                                ->where('numDependencia','=',auth()->user()->dependencia)
                            ;
                        })
                        ->orWhere(function ($query) use ($search){
                            $query->where('numPlaza','LIKE','%'.$search.'%')
                                ->where('numDependencia','=',auth()->user()->dependencia)
                            ;
                        })
                        ->orWhere(function ($query) use ($search){
                            $query->where('numHoras','LIKE','%'.$search.'%')
                                ->where('numDependencia','=',auth()->user()->dependencia)
                            ;
                        })
                        ->orWhere(function ($query) use ($search){
                            $query->where('numMateria','LIKE','%'.$search.'%')
                                ->where('numDependencia','=',auth()->user()->dependencia)
                            ;
                        })
                        ->orWhere(function ($query) use ($search){
                            $query->where('nombreMateria','LIKE','%'.$search.'%')
                                ->where('numDependencia','=',auth()->user()->dependencia)
                            ;
                        })
                        ->orWhere(function ($query) use ($search){
                            $query->where('grupo','LIKE','%'.$search.'%')
                                ->where('numDependencia','=',auth()->user()->dependencia)
                            ;
                        })
                        ->orWhere(function ($query) use ($search){
                            $query->where('subGrupo','LIKE','%'.$search.'%')
                                ->where('numDependencia','=',auth()->user()->dependencia)
                            ;
                        })                        
                        ->orWhere(function ($query) use ($search){
                            $query->where('numMotivo','LIKE','%'.$search.'%')
                                ->where('numDependencia','=',auth()->user()->dependencia)
                            ;
                        })
                        ->orWhere(function ($query) use ($search){
                            $query->where('tipoAsignacion','LIKE','%'.$search.'%')
                                ->where('numDependencia','=',auth()->user()->dependencia)
                            ;
                        })
                        ->orWhere(function ($query) use ($search){
                            $query->where('numPersonalDocente','LIKE','%'.$search.'%')
                                ->where('numDependencia','=',auth()->user()->dependencia)
                            ;
                        })
                        ->orWhere(function ($query) use ($search){
                            $query->where('plan','LIKE','%'.$search.'%')
                                ->where('numDependencia','=',auth()->user()->dependencia)
                            ;
                        })
                        ->orWhere(function ($query) use ($search){
                            $query->where('fechaApertura','LIKE','%'.$search.'%')
                                ->where('numDependencia','=',auth()->user()->dependencia)
                            ;
                        })
                        ->orWhere(function ($query) use ($search){
                            $query->where('fechaCierre','LIKE','%'.$search.'%')
                                ->where('numDependencia','=',auth()->user()->dependencia)
                            ;
                        })
                        ->orWhere(function ($query) use ($search){
                            $query->where('observaciones','LIKE','%'.$search.'%')
                                ->where('numDependencia','=',auth()->user()->dependencia)
                            ;
                        })
                        ->orWhere(function ($query) use ($search){
                            $query->where('observaciones','LIKE','%'.$search.'%')
                                ->where('fechaRenuncia','=',auth()->user()->dependencia)
                            ;
                        })
                        
                        ->orderBy('nombreMateria','desc')
                        ->paginate(15)
                    ;
                }

            }

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

        $user = Auth::user();
        $data = $request->periodo .  " " . $request->numZona . " " . $request->numDependencia . " " . $request->numPlaza
                . " " . $request->numHoras . " " . $request->numMateria . " " . $request->nombreMateria . " " . $request->grupo
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

        $user = Auth::user();
        $data = $request->periodo .  " " . $request->numZona . " " . $request->numDependencia . " " . $request->numPlaza
                . " " . $request->numHoras . " " . $request->numMateria . " " . $request->nombreMateria . " " . $request->grupo
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

}
