<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('******* CREACIÓN DE USUARIO ADMINISTRADOR *******');
        User::create([
            'name' => $this->command->ask('Nombre'),
            'email' => $this->command->ask('Email'),
            'password' => bcrypt($this->command->secret('Contraseña')),
            'role_id' => 1
        ]);

        $this->command->info('Usuario administrador creado exitosamente.');
    }
}
