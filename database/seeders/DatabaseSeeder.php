<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
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

        Belt::factory()
            ->count(7)
            ->sequence(
                ['name' => 'Yellow','order' => 0],
                ['name' => 'Orange','order' => 1],
                ['name' => 'Purple','order' => 2],
                ['name' => 'Blue','order' => 3],
                ['name' => 'Green','order' => 4],
                ['name' => '3rd Brown','order' => 5],
                ['name' => '2nd Brown','order' => 6]
        )->create();
    }
}
