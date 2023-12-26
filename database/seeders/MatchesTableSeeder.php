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
            ['club1_id' => 1, 'club2_id' => 2, 'score1' => 2, 'score2' => 1, 'count' => 1],
            ['club1_id' => 2, 'club2_id' => 3, 'score1' => 1, 'score2' => 1, 'count' => 1],
        ];

        foreach ($matchesData as $matchData) {
            Matches::create($matchData);
        }
    }
}
