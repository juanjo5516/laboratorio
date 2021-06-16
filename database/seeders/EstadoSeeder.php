<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estado;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::create(['name' => 'Por pagar']);
        Estado::create(['name' => 'En emisión de cheque']);
        Estado::create(['name' => 'Pagado']);
    }
}
