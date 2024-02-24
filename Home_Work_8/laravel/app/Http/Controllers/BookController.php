<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return view('Book.index');
    }

    public function create()
    {
        return view('Book.index')->with('addBook', true);
    }

    public function store(Request $request)
    {
        // Валидация входящих данных
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
        ]);

        $book = Book::create([
            'title' => $request->input('title'),
            'author' => $request->input('author'),
        ]);

        return view('Book.index')->with('success', 'Книга успешно добавлена');
    }

    public function show()
    {
        $books = Book::select('title', 'author')->get();
        if (isset($books) && count($books) > 0) {
            $data = view('Book.index')->with('showBooks', $books);
        } else {
            $data = view('Book.index')->with('ZeroBooks', true);
        }
        return $data;
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
