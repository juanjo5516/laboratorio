<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    // use HasFactory;

    protected $table = 'unidades';

    protected $fillable = ['name'];

    public function materiales()
    {
        return $this->hasMany(Material::class);
    }
}
