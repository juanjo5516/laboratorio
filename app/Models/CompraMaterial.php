<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraMaterial extends Model
{
    // use HasFactory;

    protected $table = 'compras_materiales';

    protected $fillable = [
        'cantidad',
        'precio',
        'compra_id',
        'material_id'
    ];
}
