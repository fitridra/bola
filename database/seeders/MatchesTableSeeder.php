<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Matches;

class MatchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $matchesData = [
            ['club_id' => 1, 'score' => 2],
            ['club_id' => 2, 'score' => 1],
        ];

        foreach ($matchesData as $matchData) {
            Matches::create($matchData);
        }
    }
}
