<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cmspage;
use DB;

class CmspagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cmspages')->insert([

            [
                'title' => 'Recruiting Agencies',
                'description' => 'Best Solution Of Recruiting Agencies',
                'url' => 'bsra.info',
                'meta_title' => 'About Us',
                'meta_description' => 'About Us Content',
                'meta_keywords' => 'Recruiting, Agency, Bangladesh, RL, bsra, Travel, IATA, Visa, Account, Solution, Agencies, Recruitment, Saudi, Embassy, BMET, Airport, Airline',
                'status' => 1,
            ],
        ]);
    }
}
