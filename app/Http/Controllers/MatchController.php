<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Matches;

class MatchController extends Controller
{
    public function create()
    {
        $clubs = Club::all();
        return view('match.create', compact('clubs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'club1_id' => 'required',
            'club2_id' => 'required',
            'score1' => 'required',
            'score2' => 'required',
            'count' => 'required',
            
            'club1_id.*' => 'required|exists:clubs,id',
            'club2_id.*' => 'required|exists:clubs,id|different:club1_id.*',
            'score1.*' => 'required|integer|min:0',
            'score2.*' => 'required|integer|min:0',
            'count.*' => 'required|integer|min:1',
        ]);

        Matches::create($request->all());

        return redirect()->route('klasemen.index')->with('success', 'Match added successfully');
    }
}
