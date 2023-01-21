<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    use HasFactory;

    protected $fillable = [
        'nPersonal',
        'nombre',
        'apellidoPaterno',
        'apellidoMaterno',
        'email',
    ];

    protected $guarded = [];
}
