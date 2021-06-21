<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    // use HasFactory;

    protected $fillable = [
        'beneficiario',
        'monto',
        'compra_id',
        'cuenta_id',
        'mes'
    ];

    public function compra()
    {
        return $this->belongsTo(Compra::class);
    }

    public function cuenta()
    {
        return $this->belongsTo(Cuenta::class);
    }
}
