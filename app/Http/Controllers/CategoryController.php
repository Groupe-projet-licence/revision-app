<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Question;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }




public function create()
{
    $categories = Category::all();
    $questions = Question::all();
    return view('categories.create', compact('categories', 'questions'));
}



    public function store(Request $request)
    {
        $validated = $request->validate(['subject' => 'required|string']);
        Category::create($validated);
        return redirect()->route('categories.index')->with('success', 'Category added successfully.');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show', compact('category'));
    }

    public function edit($id)
    {
         $categories = Category::all();
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->validate(['subject' => 'required|string']));
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category removed successfully.');
    }
}
