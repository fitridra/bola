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
            'club_id' => 'required',
            'score' => 'required',
            
            'club_id.*' => 'required|exists:clubs,id',
            'score.*' => 'required|integer|min:0'
        ]);

        Matches::create($request->all());

        return redirect()->route('klasemen.index')->with('success', 'Match added successfully');
    }
}
