<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Photo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
            return response()->json(['ErrorMessage' => $nt], 500);
        } catch (QueryException $e) {
            return response()->json(['ErrorMessage' => $e], 500);
        } catch (Exception $ex) {
            return response()->json(['ErrorMessage', $ex], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('index')->with('create', 'photo');
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
                $exists = Photo::where('name', $image->getClientOriginalName())->exists();
                if (!$exists) {
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
                        'category_id' => $category->id,
                        'photo_id' => $photo->id
                    ]);

                    // Копируем изображение в публичную директорию
                    $image->storeAs('public/images', $image->getClientOriginalName());

                    // Завершаем транзакцию
                    DB::commit();

                    return response()->json(['message' => 'Фото успешно загружен'], 200);
                } else {
                    return response()->status(400);
                }
            } else {
                // В случае отсутствия загруженного файла возвращаем ошибку
                return response()->status(400);
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
    public function show(string $photoName)
    {
        try {
            // получаем по название фото его ID
            $photo = Photo::where('name', $photoName)->FirstOrFail();
            // получаем по ID фото его категорию
            $category_id = DB::table('categories_photos')->where('photo_id', $photo->id)->value('category_id');
            // получаем название категории по category_id
            $categoryName = Category::select('name')->where('id', $category_id)->FirstOrFail();

            return response()->json(['CategoryName' => $categoryName], 200);
        } catch (\Exception $ex) {
            return response()->json(['Error' => 'Категорий не найдена'], 404);
        }
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
    public function update(Request $request, string $photoName)
    {
//        DB::beginTransaction();
        try {
            $data = $request->json()->all();
            // получаем ID новой категории
            $NewCategory = Category::select('id')->where('name', $data['newCategory'])->FirstOrFail();
            // получаем ID фото , в котором нужно изменить категорию
            $photo = Photo::select('id')->where('name',$photoName)->FirstOrFail();
            // изменяем category_id по photo_id
            DB::table('categories_photos')->where('photo_id',$photo->id)->update(['category_id'=>$NewCategory->id]);
//            DB::table('categories_photos')->where('photo_id',$photo->id)->update(['category_id'=>$category->id]);
//            DB::commit();

//            return response()->json(['successUpdate' => 'Успешно обновлено'], 200);
            return response()->json(['successUpdate' => "Категория успешно изменена"], 200);
        } catch (\Exception $ex) {
            // В случае возникновения исключения откатываем транзакцию
//            DB::rollBack();
            return response()->json(['error' => 'Не удалось загрузить фото: ошибка сервера'], 500);
        }
    }

        /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $photoName)
    {
        try {
            // получаем модель фото из БД
            $photo = Photo::where('name', $photoName)->FirstOrFail();
            // удаляем поле из таблицы связей категории и фото
            // удаляем фото путь к фото из БД
            $photo->delete();
            // удаляем фото из хранилища
            Storage::delete('public/images/' . $photoName);
            return response()->json(['success' => 'Фото успешно удалено. ID: ' . $photo->id . 'Путь: ' . $photo->path], 200);
        } catch (\Exception $ex) {
            return response()->json(['error' => 'Ошибка удаления фото'], 400);
        }
    }
}
