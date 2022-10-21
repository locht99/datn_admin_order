<?php

namespace Database\Seeders;

use App\Models\PartnerModel;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        for ($i=2; $i < 99; $i++) { 
            $data = [
                'name' => Str::random(10),
                'phone' => rand(1000,2000),
                'point'=> rand(100,1000),
            ];
            PartnerModel::create($data);
        }
    }
}
