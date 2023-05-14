<?php

namespace Database\Seeders;

use App\Models\Abonnement;
use App\Models\Responsable;
use App\Models\UserModels\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['title' => 'client']);
        Role::create(['title' => 'Administrator']);
        Role::create(['title' => 'responsable']);
        Role::create(['title' => 'employeur']);
        Responsable::create(['abonnement_id'=>1]) ;
        Abonnement::create(['type_abonnement_id'=>1 ]);
    }
}
