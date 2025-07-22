<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Sheet;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\SheetRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SheetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Sheet::with('category')->where('user_id', Auth::id());

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        $sheets = $query->latest()->get();
        foreach ($sheets as &$sheet) {
            $sheet->last_opened_at = substr($sheet->last_opened_at, 0, 10);
        }

        return Inertia::render('Sheets/Index', [
            'sheets' => $sheets,
            'categories' => Category::orderBy('subject')->get(),
            'selectedCategory' => $request->category_id,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return Inertia::render('Sheets/CreateUpdate', [
            'categories' => Category::orderBy('subject')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SheetRequest $request)
    {
        $sheet = new Sheet();
        $sheet->fill($request->validated());
        $sheet->user_id = Auth::user()->id;
        $sheet->save();
        return redirect()->route('sheets.index')->with('success', 'Sheet added succefully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sheet $sheet)
    {
        if ($sheet->user_id != Auth::user()->id) {
            abort(403);
        }
        $sheet->last_opened_at = substr($sheet->last_opened_at, 0, 10);
        return Inertia::render('Sheets/Show', [
            'sheet' => $sheet
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sheet $sheet)
    {

        if ($sheet->user_id != Auth::user()->id) {
            abort(403);
        }

        return Inertia::render('Sheets/CreateUpdate', [
            'sheet' => $sheet,
            'categories' => Category::orderBy('subject')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SheetRequest $request, Sheet $sheet)
    {
        $sheet->update($request->validated());
        return redirect()->route('sheets.index')->with('success', 'Sheet updated succefully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sheet $sheet)
    {
        $sheet->delete();
        return redirect()->route('sheets.index')->with('success', 'Sheet deleted succefully.');
    }
    public function showSheetsToReviewed()
    {
        $sheets = Sheet::with('category')->Where('user_id', Auth()->id())
            ->where('next_revision_at', '<=', now())
            ->orderBy('next_revision_at', 'asc')->get();
        foreach ($sheets as &$sheet) {
            $sheet->last_opened_at = substr($sheet->last_opened_at, 0, 10);
        }
        return Inertia::render('Sheets/showSheetsToReviewed', [
            'sheets' => $sheets,
        ]);
    }
    public function nextRevision(sheet $sheet, Request $request)
    {
        $validated = $request->validate([
            'rate' => 'required|integer',
        ]);
        $isReviewedToDay = false;
        if ($sheet->last_opened_at) {
            $isReviewedToDay = Carbon::parse($sheet->last_opened_at)->isToday();
        }
        if (!$isReviewedToDay) {
            $sheet->last_opened_at = now();

            $rate = $validated['rate'];
            if ($rate < 30) {
                $sheet->revision_count = 0;
            } else if ($rate < 70) {
                $sheet->revision_count = 1;
            } else {
                $sheet->revision_count++;
            }


            switch ($sheet->revision_count) {
                case 0:
                    $sheet->next_revision_at = now()->addDays(1);
                    break;
                case 1:
                    $sheet->next_revision_at = now()->addDays(3);
                    break;
                case 2:
                    $sheet->next_revision_at = now()->addDays(7);
                    break;
                default:
                    $sheet->next_revision_at = now()->addDays(14);
            }
            $sheet->save();
            $sheet->last_opened_at = substr($sheet->last_opened_at, 0, 10);

        }
    }

}
