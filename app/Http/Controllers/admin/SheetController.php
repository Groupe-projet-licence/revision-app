<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SheetRequest;
use App\Models\Sheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SheetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Sheets/Index', [
            'sheets' => Sheet::latest()->where('user_id',Auth::user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
   
    public function create()
    {
        return Inertia::render('Sheets/CreateUpdate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SheetRequest $request)
    {
        $sheet= new Sheet();
        $sheet->fill($request->validated());
        $sheet->user_id=Auth::user()->id;
        $sheet->save();
        return redirect()->route('sheets.index')->with('success','Sheet succefully added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sheet $sheet)
    {
        if($sheet->user_id != Auth::user()->id){
            abort(403);
        }
        return Inertia::render('Sheets/Show',[
            'sheet'=> $sheet
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sheet $sheet)
    {
        if($sheet->user_id != Auth::user()->id){
            abort(403);
        }
        return Inertia::render('Sheets/CreateUpdate',[
            'sheet'=>$sheet
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SheetRequest $request, Sheet $sheet)
    {
        $sheet->update($request->validated());
        return redirect()->route('sheets.index')->with('success','Sheet succefully updated!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sheet $sheet)
    {
        $sheet->delete();
        return redirect()->route('sheets.index')->with('success', 'Sheet succefully deleted');
    }
}
