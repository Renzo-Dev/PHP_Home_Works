<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Work 9</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body style="background-color: #080b7a" class="d-flex flex-column align-items-center">
<div class="topPanel">
    <a href="{{route('api_categories.index')}}">Категории</a>
    <a href="#">Фото</a>
</div>
<div class="main">
@if(isset($success) && $success == 'category')
    <h1>Категория успешно добавлена</h1>
@endif
@if(isset($create) && $create == 'category')
    <div>
    <h2>Создание Категории</h2>
        <form method="post" action="{{route('api_categories.store')}}">
            <input name="categoryName" type="text" autocomplete="off" placeholder="Category Name">
            <button type="submit">Создать</button>
        </form>
    </div>
@endif
@if(isset($component) && $component == 'category')
    <h2><a href="{{route('category.create')}}">СОЗДАТЬ КАТЕГОРИЮ</a></h2>
    <h3>КАТЕГОРИИ</h3>
    <div class="categories_wrapper">
    @if(isset($categories) && count($categories) > 0)
        @foreach($categories as $category)
            <div class="category">{{ $category }}</div>
        @endforeach
    @else
        НЕТУ КАТЕГОРИЙ
    @endif
    </div>
@endif
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-custom">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Изминения категории</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input class="changeCategory" style="width: 100%; text-align: left;padding: 10px" type="text" autocomplete="off" placeholder="Новое название категории">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" disabled>Изминить</button>
                    <button type="button" class="btn btn-danger">Удалить</button>
                </div>
            </div>
        </div>
    </div>
<script>
    window.addEventListener('DOMContentLoaded',function(){
        let categories = document.querySelectorAll('.category');
        categories.forEach(category=>{
            category.addEventListener('click',function () {
                var myModal = document.querySelector('.modal');
                document.querySelector('.modal-title').textContent = category.textContent;
                myModal.style.display = "block"; // Показать модальное окно
                let changeModal = new bootstrap.Modal(myModal);
                changeModal.show();

                let input = document.querySelector('.changeCategory');
                input.addEventListener("input", function() {
                    var button = document.querySelector('.btn-secondary');
                    if(input.value.length === 0){
                        button.setAttribute('disabled', 'disabled');
                    } else {
                        button.removeAttribute('disabled');
                    }
                });
            });
        });
    });
</script>
</div>
</body>
</html>
