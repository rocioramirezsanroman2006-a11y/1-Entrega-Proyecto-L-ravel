<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';

    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'puesto',
        'departamento',
        'fecha_contratacion',
        'salario',
    ];

    protected $casts = [
        'fecha_contratacion' => 'datetime',
    ];

    public $timestamps = true;
}
