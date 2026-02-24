<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = ['Azerbaijan', 'Russia', 'China', 'USA', 'Germany', 'Japan'];
        
        foreach ($countries as $country) {
            Country::create(['name' => $country]);
        }
    }
}
