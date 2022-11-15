<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'nombre_producto',
        'descripcion_producto',
        'precio_producto',
        'imagen_producto',
        'establishment_id',
        'category_id'
    ];
}
