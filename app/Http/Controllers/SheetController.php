<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 class SheetController extends Controller
{
    public function create()
    {
        return view('sheets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $sheet = Sheet::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Fiche créée avec succès.');
    }
}

