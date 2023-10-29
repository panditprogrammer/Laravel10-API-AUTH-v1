<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;


class studentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $Faker): void
    {        
        foreach (range(1, 10) as $value) {

            DB::table('students')->insert([
                'name' => $Faker->name(),
                'email' => $Faker->email(),
                'address' =>$Faker->address()
            ]);
        }
    }
}
