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
            $matchesAsClub = $club->matchesAsClub;

            $played = $matchesAsClub->count();
            $won = $matchesAsClub->where('score')->count();

            $goals = $matchesAsClub->sum('score');

            $points = $won * 3;

            $standings[] = [
                'club' => $club->name,
                'played' => $played,
                'won' => $won,
                'goals' => $goals,
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
