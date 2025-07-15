<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RatingController extends Controller
{
public function index()
{
$ratings = Rating::with('user')->latest()->get();
$average = Rating::avg('stars');


    return Inertia::render('Ratings/Index', [
        'ratings' => $ratings,
        'average' => round($average, 1),
    ]);
}

public function store(Request $request)
{
    $validated = $request->validate([
        'stars' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|max:1000',
    ]);

    Rating::create([
        'user_id' => Auth::check() ? Auth::id() : null,
        'stars' => $validated['stars'],
        'comment' => $validated['comment'],
    ]);

    return redirect()->back()->with('success', 'Thank you for your feedback!');
}
}
