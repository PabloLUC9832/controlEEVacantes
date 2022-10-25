<?php

namespace App\Jobs;

use App\Models\Vacante;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCSVUploadVacante implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $file;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = array_map('str_getcsv',file($this->file));

        foreach ($data as $row){

            Vacante::updateOrCreate(
                [
                    'periodo' => $row[0],
                    'numZona' => $row[1],
                    'numDependencia' => $row[2],
                    'numArea' => $row[3],
                    'numPrograma' => $row[4],
                    'numPlaza' => $row[5],
                    'numHoras' => $row[6],
                    'numMateria' => $row[7],
                    'nombreMateria' => $row[8],
                    'grupo' => $row[9],
                    'numMotivo' => $row[10]
                ], [
                    /*'tipoAsignacion' => $row[11],
                    'numPersonalDocente' => $row[12],
                    'plan' => $row[13],
                    'fechaApertura' => $row[14],
                    'fechaCierre' => $row[15],
                    'observaciones' => $row[16],
                    'fechaRenuncia' => $row[17],
                    'bancoHorasDisponible' => $row[18] */
                ]
                
            );

        }
        unlink($this->file);
        
    }
}