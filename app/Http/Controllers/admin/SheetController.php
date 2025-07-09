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

        if($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        $sheets= $query->latest()->get();
        foreach ($sheets as &$sheet) {
            $sheet->last_opened_at = substr($sheet->last_opened_at, 0, 10);
        }
        
        //dd($query->get());
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
        dd($request->content);
        $sheet = new Sheet();
        $sheet->fill($request->validated());
        $sheet->user_id = Auth::user()->id;
        $sheet->save();
        return redirect()->route('sheets.index')->with('success', 'Sheet succefully added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sheet $sheet)
    {
        if ($sheet->user_id != Auth::user()->id) {
            abort(403);
        }
        $isReviewedToDay = false;
        if ($sheet->last_opened_at) {
            $isReviewedToDay = Carbon::parse($sheet->last_opened_at)->isToday();
        }
        if (!$isReviewedToDay) {
            $sheet->last_opened_at = now();
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
            $sheet->revision_count++;
            $sheet->save();
        }
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
        return redirect()->route('sheets.index')->with('success', 'Sheet succefully updated!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sheet $sheet)
    {
        $sheet->delete();
        dd('');
        return redirect()->route('sheets.index')->with('success', 'Sheet succefully deleted');
    }
    public function showSheetsToReviewed()
    {
        $sheets = Sheet::Where('user_id', Auth()->id())
            ->where('next_revision_at', '<=', now())
            ->orderBy('next_revision_at', 'asc')->get();
        foreach ($sheets as &$sheet) {
            $sheet->last_opened_at = substr($sheet->last_opened_at, 0, 10);
        }
        return Inertia::render('Sheets/showSheetsToReviewed', [
            'sheets' => $sheets,
        ]);
    }
}
