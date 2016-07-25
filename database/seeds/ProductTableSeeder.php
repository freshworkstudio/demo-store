<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Product::create([
            'name'  => 'Producto deportivo DEMO',
            'image' => 'http://lorempixel.com/400/200/sports',
            'price' => 1500
        ]);

        \App\Product::create([
            'name'  => 'Producto para animales DEMO',
            'image' => 'http://lorempixel.com/400/200/animals',
            'price' => 2500
        ]);

        \App\Product::create([
            'name'  => 'Producto tecnológico DEMO',
            'image' => 'http://lorempixel.com/400/200/technics?id=2',
            'price' => 3000
        ]);

	    \App\Product::create([
		    'name'  => 'Producto deportivo 2 DEMO',
		    'image' => 'http://lorempixel.com/400/200/sports?id=2',
		    'price' => 5200
	    ]);

	    \App\Product::create([
		    'name'  => 'Producto para animales 2 DEMO',
		    'image' => 'http://lorempixel.com/400/200/animals?id=2',
		    'price' => 3190
	    ]);

	    \App\Product::create([
		    'name'  => 'Producto tecnológico 2 DEMO',
		    'image' => 'http://lorempixel.com/400/200/technics?id=2',
		    'price' => 12990
	    ]);

	    \App\Product::create([
		    'name'  => 'Producto para animales 3 DEMO',
		    'image' => 'http://lorempixel.com/400/200/animals?id=3',
		    'price' => 500
	    ]);

	    \App\Product::create([
		    'name'  => 'Producto tecnológico 3 DEMO',
		    'image' => 'http://lorempixel.com/400/200/technics?id=3',
		    'price' => 6800
	    ]);
    }
}
