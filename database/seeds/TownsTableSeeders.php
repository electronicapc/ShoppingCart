<?php

use Illuminate\Database\Seeder;

class TownsTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          factory(App\Municipio::class, 2)->create()->each(function($u) {
		    $u->issues()->save(factory(App\Municipio::class)->make());
		  });
    }
}
