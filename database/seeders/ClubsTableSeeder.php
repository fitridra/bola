<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Club;

class ClubsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clubsData = [
            ['name' => 'Persib', 'city' => 'Bandung'],
            ['name' => 'Arema', 'city' => 'Malang'],
            ['name' => 'Persija', 'city' => 'Jakarta'],
        ];

        foreach ($clubsData as $clubData) {
            Club::create($clubData);
        }
    }
}
