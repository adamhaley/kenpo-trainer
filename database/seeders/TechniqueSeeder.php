<?php

namespace Database\Seeders;

use App\Models\Belt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technique;
use Illuminate\Support\Facades\File;

class TechniqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $json = File::get(base_path() . "/data/techniques.json");
        $data = json_decode($json);

        $beltOrder = 1;
        foreach ($data->{'belts'} as $belt) {
            print_r($belt);

            $beltModel = Belt::create([
                "name" => $belt->color,
                "image" => "",
                "order" => $beltOrder,
            ]);

            foreach($belt->{'techniques'} as $technique){
                Technique::create([
                    "name" => $technique->name,
                    "attack" => $technique->attack,
                    "defense" => "",
                    "image" => "",
                    "video" => "",
                    "tags" => "",
                    "category" => "",
                    "belt_id" => $beltModel->id,
                ]);
            }
            $beltOrder++;
        }
    }
}
