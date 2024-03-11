<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Photo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        try {
            DB::beginTransaction();

            // Проверяем наличие файла изображения
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                // Определяем путь к сохраняемому изображению
                $photoPath = 'storage/images/' . $image->getClientOriginalName();
                $photoName = $image->getClientOriginalName();

                // Создаем запись о фото в базе данных
                $photo = Photo::create([
                    'name' => $photoName,
                    'path' => $photoPath
                ]);

                // Получаем ID категории
                $category = Category::select('id')->where('name', $request->input('category'))->first();

                // Сохраняем связь фото и категории в промежуточной таблице
                DB::table('categories_photos')->insert([
                    'category_id'=>$category->id,
                    'photo_id'=>$photo->id
                ]);

                // Копируем изображение в публичную директорию
                $image->storeAs('public/images', $image->getClientOriginalName());

                // Завершаем транзакцию
                DB::commit();

                return response()->json(['message' => 'Фото успешно загружено'], 200);
            } else {
                // В случае отсутствия загруженного файла возвращаем ошибку
                return response()->json(['error' => 'Не удалось загрузить фото: файл не найден'], 400);
            }
        } catch (\Exception $ex) {
            // В случае возникновения исключения откатываем транзакцию
            DB::rollBack();

            return response()->json(['error' => 'Не удалось загрузить фото: ошибка сервера'], 500);
        }
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
