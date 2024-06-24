<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Super;
use Illuminate\Support\Facades\Hash;
use DB;

class SupersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('supers')->insert([

            [
                'fullname' => 'Abdullah',
                'username' => 'Super',
                'photo' => '',
                'phone' => '01815141595',
                'email' => 'ahsum1558@gmail.com',
                'password' => Hash::make('12345'),
                'type' => 'super',
            ],
        ]);
        // $password = Hash::make('12345');
        // $superRecords = ['id'=>1,'fullname'=>'Abdullah','username'=>'Super','photo'=>'','phone'=>'01815141595','email'=>'ahsum1558@gmail.com','password'=>$password,'type'=>'super','status'=>1];
        // Super::insert($superRecords);
    }
}
