<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         factory(App\Municipio::class,10)->create();
         
         factory(App\Producto::class,100)->create();
         
         factory(App\Categoria::class,50)->create();
         
	}
}
