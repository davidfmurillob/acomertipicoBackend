<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cookwithus extends Model
{
    use HasFactory;

    protected $fillable = [
        'mensaje', 'contacto', 'id_user', 'id_product',  'establishment_id'
    ];
}
