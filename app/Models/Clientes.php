<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Clientes extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'direccion',
        'ciudad',
        'codigo_postal',
        'empresa',
        'foto',
    ];
    
    public $timestamps = true;

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'cliente_id', 'id');
    }
}
