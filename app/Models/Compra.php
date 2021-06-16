<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    // use HasFactory;

    protected $fillable = [
        'factura',
        'total',
        'proveedor_id',
        'forma_pago_id'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function forma()
    {
        return $this->belongsTo(FormaPago::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }

    public function materiales()
    {
        return $this->belongsToMany(Material::class);
    }
}
