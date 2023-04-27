<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create an entry for each attack
        //upper right
        \App\Models\Attack::firstOrCreate([
            'name' => 'upper right',
        ]);

        //upper left
        \App\Models\Attack::firstOrCreate([
            'name' => 'upper left',
        ]);

        //lower right
        \App\Models\Attack::firstOrCreate([
            'name' => 'lower right',
        ]);

        //lower left
        \App\Models\Attack::firstOrCreate([
            'name' => 'lower left',
        ]);

        //front
        \App\Models\Attack::firstOrCreate([
            'name' => 'front',
        ]);

        //rear
        \App\Models\Attack::firstOrCreate([
            'name' => 'rear',
        ]);

        //side
        \App\Models\Attack::firstOrCreate([
            'name' => 'side',
        ]);

        //kick
        \App\Models\Attack::firstOrCreate([
            'name' => 'kick',
        ]);

        //roundhouse
        \App\Models\Attack::firstOrCreate([
            'name' => 'roundhouse',
        ]);

        //punch
        \App\Models\Attack::firstOrCreate([
            'name' => 'punch',
        ]);

        //grab
        \App\Models\Attack::firstOrCreate([
            'name' => 'grab',
        ]);

        //two-hand
        \App\Models\Attack::firstOrCreate([
            'name' => 'two-hand',
        ]);

        //push
        \App\Models\Attack::firstOrCreate([
            'name' => 'push',
        ]);

        //pull
        \App\Models\Attack::firstOrCreate([
            'name' => 'pull',
        ]);

        //choke
        \App\Models\Attack::firstOrCreate([
            'name' => 'choke',
        ]);

        //headlock
        \App\Models\Attack::firstOrCreate([
            'name' => 'headlock',
        ]);

        //bear hug
        \App\Models\Attack::firstOrCreate([
            'name' => 'bear hug',
        ]);

        //arms pinned
        \App\Models\Attack::firstOrCreate([
            'name' => 'arms pinned',
        ]);

        //arms free
        \App\Models\Attack::firstOrCreate([
            'name' => 'arms free',
        ]);

        //full nelson
        \App\Models\Attack::firstOrCreate([
            'name' => 'full nelson',
        ]);

        //belt grab
        \App\Models\Attack::firstOrCreate([
            'name' => 'belt grab',
        ]);

        //hair grab
        \App\Models\Attack::firstOrCreate([
            'name' => 'hair grab',
        ]);

        //wrist grab
        \App\Models\Attack::firstOrCreate([
            'name' => 'wrist grab',
        ]);

        //tackle
        \App\Models\Attack::firstOrCreate([
            'name' => 'tackle',
        ]);

        //knife
        \App\Models\Attack::firstOrCreate([
            'name' => 'knife',
        ]);

        //gun
        \App\Models\Attack::firstOrCreate([
            'name' => 'gun',
        ]);

        //club
        \App\Models\Attack::firstOrCreate([
            'name' => 'club',
        ]);

    }
}
