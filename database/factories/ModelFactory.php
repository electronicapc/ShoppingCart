<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


	$factory->define(App\Municipio::class, function (Faker\Generator $faker) {
		return [
				'id' => $faker->stateAbbr,
				'nombre' => $faker->state,
		];
	});
	
$factory->define(App\Producto::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->word,
      'precpu' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 8),
      'costo' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 8),
      'categoria' => 1,
      'ReferenciaOEM' => $faker->randomNumber($nbDigits = 6),
      'Descripcion' => $faker->text($maxNbChars =30),
	  'DescripcionS'=> $faker->text($maxNbChars =30),
      'foto' => $faker->url,
      'fechaRetiro' => $faker->date($format = 'Y-m-d', $max = 'now'),
      'ivap' => $faker->randomDigit,
      'iva' => 'SI',
      'activo' => 'SI',
	];
});

	$factory->define(App\Categoria::class, function (Faker\Generator $faker) {
		return [
				'name' => $faker->word,
				'Descripcion' => $faker->text($maxNbChars =30),
				'foto' => $faker->url,
		];
	});