<?php

namespace App\Models;

use App\Jobs\ProcessCSVUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motivo extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function importToDB(){
        $path = resource_path('pending-files/*.csv');
        //$g = glob($path);
        //foreach (array_slice($g,0,1) as $file){
        $files = glob($path);
        foreach ($files as $file){
            /*
            $data = array_map('str_getcsv',file($file));

            foreach ($data as $row){
                //dd($row);
                self::updateOrCreate(
                [
                    'numeroMotivo'=>$row[0]
                ],[
                    'nombre'=>$row[1],
                    'concepto'=>$row[2]
                ]
                );
            }
            unlink($file);*/

            ProcessCSVUpload::dispatch($file);

        }




    }

}
