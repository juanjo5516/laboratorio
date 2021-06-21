<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cxc extends Model
{
    // use HasFactory;

    protected $table = 'cxc';

    protected $fillable = [
        'plazo',
        'fecha_pago',
        'compra_id',
        'estado_id',
        'mes'
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }
}
