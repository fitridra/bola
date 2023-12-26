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
            $matches = Matches::where('club1_id', $club->id)
                ->orWhere('club2_id', $club->id)
                ->get();

            $won = $matches->filter(function ($match) use ($club) {
                return ($match->club1_id == $club->id && $match->score1 > $match->score2) ||
                    ($match->club2_id == $club->id && $match->score2 > $match->score1);
            })->count();

            $drawn = $matches->filter(function ($match) use ($club) {
                return ($match->score1 == $match->score2) &&
                    (($match->club1_id == $club->id) || ($match->club2_id == $club->id));
            })->count();

            $lost = $matches->filter(function ($match) use ($club) {
                return ($match->club1_id == $club->id && $match->score1 < $match->score2) ||
                       ($match->club2_id == $club->id && $match->score2 < $match->score1);
            })->count();            

            $played = $matches->count();

            $goalsFor = $matches->where('club1_id', $club->id)->sum('score1') +
                        $matches->where('club2_id', $club->id)->sum('score2');

            $goalsAgainst = $matches->where('club1_id', $club->id)->sum('score2') +
                            $matches->where('club2_id', $club->id)->sum('score1');


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