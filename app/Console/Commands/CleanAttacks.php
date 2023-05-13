<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \App\Models\Technique;

class CleanAttacks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-attacks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        //
        //load all techniques
        $techniques = Technique::all();
        
        //loop through, load the attack for each technique
        foreach($techniques as $technique){
            $attack = $technique->attack;
            
            //if technique is already all lower case, skip it
            if(ctype_lower($attack)){
                continue;
            }
            
            $attack = strtolower($attack);
            $attack = str_replace('(', '', $attack);    
            $attack = str_replace(')', '', $attack);
            //echo out the attack
            echo($attack) . "\n";
            //update the technique
            $technique->attack = $attack;
            $technique->save();
        }
        
        
        
        /*
        $techniques = Technique::all();

        foreach($techniques as $technique){
            info('processing ' . $technique->name);
        }
        */
    }
}
