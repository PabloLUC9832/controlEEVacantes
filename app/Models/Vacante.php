<?php

namespace App\Models;

use App\Jobs\ProcessCSVUploadVacamte;
use App\Jobs\ProcessCSVUploadVacante;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacante extends Model{

    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'periodo',
        'clavePeriodo',
        'numZona',
        'numDependencia',
        'numArea',
        'numPrograma',
        'numPlaza',
        'numHoras',
        'numMateria',
        'nombreMateria',
        'grupo',
        'subGrupo',
        'numMotivo',
        'tipoAsignacion',
        'numPersonalDocente',
        'plan',
        'observaciones',
        'fechaAsignacion',
        'fechaApertura',
        'fechaCierre',
        'fechaRenuncia',
        'bancoHorasDisponible',
        'archivo',
    ];

    protected $guarded = [];
    public function importToDB(){
        $path = resource_path('pending-files/*.csv');
        $files = glob($path);
        foreach ($files as $file){

            ProcessCSVUploadVacante::dispatch($file);

        }

    }


}
