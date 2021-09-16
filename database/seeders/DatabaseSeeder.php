<?php

namespace Database\Seeders;

use App\Models\Produit;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Produit::create([
            'name' => 'test'.rand(0,100),
            'price' => rand(5,10),
        ]);
    }
}
