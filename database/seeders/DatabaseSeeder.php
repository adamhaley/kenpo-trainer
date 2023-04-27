<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\TrainingSession;
use App\Models\Technique;
use App\Models\Belt;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        //call technique seeder
        $this->call(TechniqueSeeder::class);

        //call training session seeder
        $this->call(TrainingSessionSeeder::class);

        //call purples and blues session seeder
        $this->call(PurplesAndBluesSessionSeeder::class);

        //attack seeder
        $this->call(AttackSeeder::class);

    }
}
