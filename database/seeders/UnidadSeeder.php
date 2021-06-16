<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unidad;

class UnidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unidad::create([
            'name' => 'Gramo - gr'
        ]);

        Unidad::create([
            'name' => 'Kilogramo - kg'
        ]);

        Unidad::create([
            'name' => 'Onza - oz'
        ]);

        Unidad::create([
            'name' => 'Libra - lb'
        ]);
    }
}
