<?php

namespace App\Models;

use App\Jobs\ProcessCSVUploadVacamte;
use App\Jobs\ProcessCSVUploadVacante;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacante extends Model{
    use HasFactory;

    protected $fillable = [
        'id',
        'periodo',
        'numZona',
        'numDependencia',
        'numArea',
        'numPrograma',
        'numPlaza',
        'numHoras',
        'numMateria',
        'nombreMateria',
        'grupo',
        'numMotivo',
        'tipoAsignacion',
        'numPersonalDocente',
        'plan',
        'fechaApertura',
        'fechaCierre',
        'observaciones',
        'fechaRenuncia',
        'bancoHorasDisponible'
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
