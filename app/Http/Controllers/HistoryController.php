<?php

namespace App\Http\Controllers;


use App\Models\QuizSubmission;
use App\Models\Sheet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Inertia\Inertia;

class HistoryController extends Controller
{
public function index()
{
$userId = Auth::id();


    // Quiz
    $submissions = QuizSubmission::with('quiz')
        ->where('user_id', $userId)
        ->orderByDesc('created_at')
        ->get()
        ->map(function ($s) {
            return [
                'type' => 'quiz',
                'title' => $s->quiz->title ?? 'Quiz supprimé',
                'date' => substr($s->created_at, 0, 10),
                'score' => $s->score,
                'id' => $s->id,
            ];
        });

    // Fiches
    $sheets = Sheet::where('user_id', $userId)
        ->whereNotNull('last_opened_at')
        ->orderByDesc('last_opened_at')
        ->get()
        ->map(function ($sheet) {
            return [
                'type' => 'sheet',
                'title' => $sheet->title,
                'date' => substr($sheet->last_opened_at, 0, 10),
                'id' => $sheet->id,
            ];
        });

    // Fusion & regroupement par date
    $all = $submissions->concat($sheets)->sortByDesc('date')->values();
    $grouped = [];

    foreach ($all as $item) {
        $key = Carbon::parse($item['date'])->isToday() ? "Today" :
               (Carbon::parse($item['date'])->isYesterday() ? "Hier" :
               Carbon::parse($item['date'])->translatedFormat('d F Y'));

        $grouped[$key][] = $item;
    }

    return Inertia::render('History/Index', [
        'history' => $grouped,
    ]);
}

public function destroy($type, $id)
{
    if ($type === 'quiz') {
        $submission = QuizSubmission::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        $submission->delete();
    } elseif ($type === 'sheet') {
        $sheet = Sheet::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        $sheet->delete();
    }

    return redirect()->back()->with('success', 'Element deleted sucessfully.');
}
}
