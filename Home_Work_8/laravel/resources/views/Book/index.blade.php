<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Work 8</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<div class="d-flex full-width align-items-center flex-column">
    <a href="{{route('book.index')}}">Главная</a>
    <a href="{{route('book.add')}}">Добавить книгу</a>
    <a href="{{route('book.show')}}">Показать все книги</a>
@if(isset($addBook) && $addBook)
    <h2>Добавить книгу в БД</h2>
    <form class="mb-3 d-flex flex-column" action="{{route('api.addBook')}}" method="post">
        @csrf
        <input style="width: 300px" type="text" name="title" autocomplete="off" placeholder="Title">
        <input style="width: 300px;" type="text" name="author" autocomplete="off" placeholder="Author">
        <button style="margin-top: 10px" class="btn btn-dark" type="submit">Добавить</button>
    </form>
@endif
@if(isset($success))
    <h1 class="text-green-700">{{$success}}</h1>
@endif
@if(isset($showBooks) && $showBooks)
    @foreach($showBooks as $book)
        <div style="margin-bottom: 5px">
            <div>Title: {{$book->title}}</div>
            <div>Author: {{$book->author}}</div>
        </div>
    @endforeach
@endif
@if(isset($ZeroBooks) && $ZeroBooks)
    <h2>В Базе данных , нету книг</h2>
@endif
</div>
</body>
</html>
