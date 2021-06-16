<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    //use HasFactory;

    protected $table = 'materiales';

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'stock_minimo_viable',
        'existencia',
        'precio',
        'foto',
        'unidad_id',
        'categoria_id'
    ];

    public function unidad()
    {
        return $this->belongsTo(Unidad::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function compras()
    {
        return $this->belongsToMany(Compra::class);
    }

    public function getFotoAttribute($value)
    {
        return \Storage::url($value);
    }
}
