<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/registration.css') }}" rel="stylesheet" type="text/css">
    <title>Registration</title>
</head>
<body>
<h1>Регистрация</h1>
<form id="formInputData">
    @csrf
    <input type="text" name="name" placeholder="Name">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" autocomplete="off" placeholder="Password">
    <button type="submit">Регистрация</button>
</form>
<a href="{{route('login')}}">Вход</a>
<script src="{{ asset('js/registration.js') }}"></script>
</body>
</html>
