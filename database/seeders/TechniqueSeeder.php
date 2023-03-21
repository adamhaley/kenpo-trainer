<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technique;

class TechniqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $json = File::get("/data/techniques.json");
        $belts = json_decode($json);

        foreach ($belts as $belt) {
            foreach($belt['techniques' as $technique]){
                $belt = Belt::where('name', '=', $technique->belt)->firstOrFail();
                Technique::create([
                    "name" => $technique->name,
                    "attack" => $technique->attack,
                    "belt_id" => $belt->id,
                ]);
            }
        }
    }
}
