<?php

namespace Database\Seeders;

use App\Models\Belt;
use App\Models\Attack;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technique;
use Illuminate\Support\Facades\File;

class TechniqueSeeder extends Seeder
{
    public function format_attack($attack){
        $attack = strtolower($attack);
        $attack = str_replace('(', '', $attack);
        $attack = str_replace(')', '', $attack);
        return $attack;
    }
    
    
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $json = File::get(base_path() . "/data/techniques.json");
        $data = json_decode($json);

        foreach ($data->{'belts'} as $belt) {
            print_r($belt);
            $beltModel = Belt::firstOrCreate([
                "name" => $belt->color,
            ]);

            foreach($belt->{'techniques'} as $technique){
                $technique = Technique::firstOrCreate([
                    "name" => $technique->name,
                    "attack" => $this->format_attack($technique->attack),
                    "defense" => "",
                    "image" => "",
                    "video" => "",
                    "tags" => "",
                    "category" => "",
                    "belt_id" => $beltModel->id,
                ]);
                
                //loop through attack models and create relations where matches attack string
                $attacks = Attack::all();
                foreach($attacks as $attack){
                    if(str_contains($technique->attack, $attack->name)){
                        $technique->attacks()->attach($attack->id);
                    }
                }
            }
        }

        //set the orders in belts table
        $belts = Belt::all();

        $i = 1;
        foreach($belts as $belt){
            $belt->order = $i;
            $belt->save();
            $i++;
        }

    }
    
    
}
