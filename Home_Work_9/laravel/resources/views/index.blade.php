<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Work 9</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
@if(@isset($create))
    @if($create === 'category')
        <div>СОЗДАЕМ КАТЕГОРИЮ</div>
    @endif
    @if($create === 'photo')
        <div>СОЗДАЕМ ФОТО</div>
    @endif
@else
<div class="d-flex flex-column align-items-center">
    <a href="{{route('category.create')}}">Добавить категорию</a>
    <a href="{{route('photo.create')}}">Добавить фото</a>
    <a href="#">Показать фотографии</a>
</div>
@endif
</body>
</html>
