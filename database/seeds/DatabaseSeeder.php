<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // La creación de datos de roles debe ejecutarse primero
        $this->call(RoleTableSeeder::class);
        // Los usuarios necesitarán los roles previamente generados
        $this->call(UserTableSeeder::class);
        // Los usuarios necesitarán los roles previamente generados
        $this->call(EntradaSeeder::class);
        // Criptomonedas
        //$this->call(CriptomonedaSeeder::class);
    }
}
