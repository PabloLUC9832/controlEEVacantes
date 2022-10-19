<?php

namespace App\Jobs;

use App\Models\Motivo;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Redis;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCSVUpload implements ShouldQueue
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
            //dd($row);

            /*echo '<pre>';
            print_r($row[1]);
            die();
            echo '</pre>';*/


            Motivo::updateOrCreate(
            [
                'numeroMotivo'=>$row[0],
                //'nombre'=>$row[1],
                //'concepto'=>$row[2]
            ],[
                'nombre'=>$row[1],
                'concepto'=>$row[2]

            ]
            );

        }
        unlink($this->file);
    }
}
