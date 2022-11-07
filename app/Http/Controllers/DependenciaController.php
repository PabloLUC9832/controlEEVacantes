<?php

namespace App\Http\Controllers;

use App\Models\Dependencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DependenciaController extends Controller
{
    public static function listaDep()
    {
        $listaDependencias = Dependencia::all();
        return $listaDependencias;
    }
}
