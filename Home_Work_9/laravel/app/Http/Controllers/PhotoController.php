<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Photo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Mockery\Exception;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = Category::select('name')->get()->map(function ($category) {
                return $category->name;
            });
            $data = Photo::select('id', 'path', 'name')->get();
            return view('index')->with([
                'component' => 'photo',
                'photos' => $data,
                'categories' => $categories
            ]);
        } catch (ModelNotFoundException $nt) {
            return response()->json(['ErrorMessage' => $nt]);
        } catch (Exception $ex) {
            return response()->json('ErrorMessage', $ex);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('index')->with('create','photo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        return response()->json(['error' => 'не удалось загрузить фото'], 422);
        return response()->json(['message' => 'Фото успешно загружено'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
