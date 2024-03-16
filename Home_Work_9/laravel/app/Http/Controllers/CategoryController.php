<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::select('name')->get()->map(function ($category) {
            return $category->name;
        });

        return view('index')->with([
            'component' => 'category',
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('index')->with('create', 'category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'categoryName' => 'required|unique:categories,name|max:255',
        ]);

        try {
            Category::create([
                'name' => $request->input('categoryName'),
            ]);
            return view('index')->with('success', 'category');
        } catch (QueryException $e) {
            dd('Произошла ошибка при добавлении категории: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $categoryName)
    {
        $jsonData = $request->json()->all();

        $category = Category::where('name', $categoryName)->first();

        if (isset($category) && isset($jsonData['name'])) {
            $category->name = $jsonData['name'];
        }
        $category->save();

        return response()->json(['newName' => $jsonData['name']]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $destroyCategory)
    {
        $category = Category::where('name', $destroyCategory)->first()->delete();

        return response()->json(['success' => 'category destroy']);
    }
}
