<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';

    protected $fillable = [
        'nombre',
        'apellido',
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

    /**
     * Accessor: permite usar $empleado->fecha_inicio como alias de fecha_contratacion
     */
    public function getFechaInicioAttribute()
    {
        return $this->fecha_contratacion;
    }
}
