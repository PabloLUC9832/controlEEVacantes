<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienciaEducativa extends Model
{
    use HasFactory;

    protected $primaryKey = 'nrc';

    protected $fillable = [
        'nrc',
        'nombre',
        'horas',
    ];

    protected $guarded = [];
}
