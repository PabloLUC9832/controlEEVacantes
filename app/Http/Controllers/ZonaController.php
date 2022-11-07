<?php

namespace App\Http\Controllers;

use App\Models\Zona;
use Illuminate\Http\Request;

class ZonaController extends Controller
{
    public static function listaZona()
    {
        $listaZonas = Zona::all();
        return $listaZonas;
    }
}
