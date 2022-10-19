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
/*        Redis::throttle('upload-csv')->allow(1)->every(20)->then(function (){
        //JOB LOGIC
            dump('processing this file:---', $this->file);
            $data = array_map('str_getcsv',file($this->file));

                foreach ($data as $row){
                    //dd($row);
                    Motivo::updateOrCreate(
                    [
                        'numeroMotivo'=>$row[0]
                    ],[
                        'nombre'=>$row[1],
                        'concepto'=>$row[2]
                    ]
                    );
                }
                dump('terminado:---', $this->file);
                unlink($this->file);

        }, function (){
            return $this->release(10);
        });*/



        $data = array_map('str_getcsv',file($this->file));

        foreach ($data as $row){
            //dd($row);
            
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
