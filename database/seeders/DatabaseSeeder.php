<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AbonnementType ;
use Database\Seeders\UserSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      

        AbonnementType::create(['price' => 41 ]);
        AbonnementType::create(['price' => 417 ]);
        $this->call(UserSeeder::class);

    }
}
