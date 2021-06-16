<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banco;

class BancoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Banco::create(['name' => 'Banco de América Central - BAC']);
        Banco::create(['name' => 'Banco Agromercantil - BAM']);
        Banco::create(['name' => 'Banco de Desarrollo Rural - BANRURAL']);
        Banco::create(['name' => 'Banco G&T Continental']);
        Banco::create(['name' => 'Banco Industrial - BI']);
        Banco::create(['name' => 'Banco Mundial']);
        Banco::create(['name' => 'Banco Reformador - BANCOR']);
        Banco::create(['name' => 'Credito Hipotecario Nacional']);
        Banco::create(['name' => 'Banco de Guatemala']);
        Banco::create(['name' => 'Banco de Antigua']);
        Banco::create(['name' => 'Banco de los Trabajadores - BANTRAB']);
        Banco::create(['name' => 'Banco Inmobiliario']);
        Banco::create(['name' => 'Banco Internacional']);
        Banco::create(['name' => 'Vivibanco']);
    }
}
