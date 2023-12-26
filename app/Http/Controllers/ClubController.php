<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;

class ClubController extends Controller
{
    public function create()
    {
        return view('club.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:clubs',
            'city' => 'required',
        ]);

        Club::create($request->all());

        return redirect()->route('klasemen.index')->with('success', 'Club added successfully');
    }
}
