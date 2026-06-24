<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_id',
        'nombre',
        'descripcion',
        'precio',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
