<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FormaPago;

class FormaPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FormaPago::create(['name' => 'Al contado']);
        FormaPago::create(['name' => 'Al crédito']);
    }
}
