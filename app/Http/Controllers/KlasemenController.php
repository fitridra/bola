<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Matches;

class KlasemenController extends Controller
{
    public function index()
    {
        $standings = $this->calculateStandings();
        $clubs = Club::all();

        return view('klasemen.index', compact('standings','clubs'));
    }

    private function calculateStandings()
    {
        $clubs = Club::all();

        $standings = [];

        foreach ($clubs as $club) {
            $matchesAsClub1 = $club->matchesAsClub1 ?? collect();
            $matchesAsClub2 = $club->matchesAsClub2 ?? collect();

            $played = $matchesAsClub1->count() + $matchesAsClub2->count();
            $won = $matchesAsClub1->where('score1', '>', 'score2')->count();
            $drawn = $matchesAsClub1->where('score1', '=', 'score2')->count() +
                    $matchesAsClub2->where('score2', '=', 'score1')->count();
            $lost = $matchesAsClub1->where('score1', '<', 'score2')->count();

            $goalsFor = $matchesAsClub1->sum('score1') + $matchesAsClub2->sum('score2');
            $goalsAgainst = $matchesAsClub1->sum('score2') + $matchesAsClub2->sum('score1');

            $points = $won * 3 + $drawn;

            $standings[] = [
                'club' => $club->name,
                'played' => $played,
                'won' => $won,
                'drawn' => $drawn,
                'lost' => $lost,
                'goals_for' => $goalsFor,
                'goals_against' => $goalsAgainst,
                'points' => $points,
            ];
        }

        // Sort the standings array by points in descending order
        usort($standings, function ($a, $b) {
            return $b['points'] <=> $a['points'];
        });

        // Add ranking numbers
        foreach ($standings as $key => $standing) {
            $standings[$key]['rank'] = $key + 1;
        }

        return $standings;
    }
}
