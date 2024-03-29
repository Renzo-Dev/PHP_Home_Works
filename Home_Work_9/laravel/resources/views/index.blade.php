<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Work 9</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</head>
<body style="background-color: #080b7a" class="d-flex flex-column align-items-center">
<div class="topPanel">
    <a href="{{ route('api_categories.index') }}">Категории</a>
    <a href="{{ route('api_photos_web.index') }}">Фото</a>
</div>
<div class="main">

    @if(isset($success) && $success == 'category')
        <h1>Категория успешно добавлена</h1>
    @endif
    @if(isset($create) && $create == 'category')
        <div>
            <h2>Создание Категории</h2>
            <form method="post" action="{{ route('api_categories.store') }}">
                @csrf
                <input name="categoryName" type="text" autocomplete="off" placeholder="Category Name">
                <button type="submit">Создать</button>
            </form>
        </div>
    @endif
    @if(isset($component) && $component == 'photo')
        @if(isset($photos))
            <h2 id="create_photo">Добавить фото</h2>
            <div>Нажми на фото</div>
            <div>
                @foreach($photos as $photo)
                    <div id="photoWrapper" class="d-flex flex-column">
                        <img class="photo" src="{{ asset($photo->path) }}" width="300px" height="150px" alt="{{ $photo->name }}">
                    </div>
                @endforeach
            </div>
        @endif
    @endif
    @if(isset($component) && $component == 'category')
        <h2><a href="{{ route('category.create') }}">СОЗДАТЬ КАТЕГОРИЮ</a></h2>
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
    <!-- Modal 1-->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-custom">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel1">Изменения категории</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input class="changeCategory form-control" type="text"
                           autocomplete="off" placeholder="Новое название категории">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" disabled>Изменить</button>
                    <button type="button" class="btn btn-danger">Удалить</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal 2-->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-custom">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel2">Добавление фото</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="categ_wrapper_select">
                        @if((isset($categories) && count($categories) > 0))
                            @foreach($categories as $category)
                                <div class="selectCategory">{{ $category }}</div>
                            @endforeach
                        @endif
                    </div>
                    <input class="form-control-file" type="file" accept="image/jpeg, image/png" id="formFile">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success">Добавить</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal 3-->
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
    <div class="modal-dialog modal-custom">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel3">Изминить категорию фото</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="categ_wrapper_select">
                    @if((isset($categories) && count($categories) > 0))
                        @foreach($categories as $category)
                            <div class="selectCategory">{{ $category }}</div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="changeCatPhoto btn btn-secondary">Изменить</button>
                <button type="button" class="deletePhoto btn btn-danger">Удалить фото</button>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let currentCategory;
        let curSelCategory;

        let bDeletePhoto = document.querySelector('.deletePhoto')
        let selectCategories = document.querySelectorAll('.selectCategory');

        function editPhotoCategory(photoName) {
            let editButton = document.querySelector('.changeCatPhoto');
            editButton.addEventListener('click', function () {
                let data = {
                    newCategory: curSelCategory.textContent
                }
                let url = `api_photos_web/${photoName}`;
                const options = {
                    method: 'PUT', // или 'PUT', 'DELETE', 'GET' и т.д.
                    headers: {
                        'Action': 'application/json'
                    },
                    body: JSON.stringify(data), // преобразуем объект в JSON-строку
                };

                fetch(url, options)
                    .then(response => {
                        if (response.ok) {
                            return response.json();
                        } else {
                            throw new Error('Ошибка обноваления категории фото ' + response.status);
                        }
                    }).then(responseData => {
                        setTimeout(function (){
                            alert(responseData['successUpdate'])
                            window.location.replace(window.location);
                        },1000)
                }).catch(error => {
                    console.error('Ошибка: ', error)
                });
            });
        }

        function loadImageCategory(photoName) {
            let url = `api_photos_web/${photoName}`;
            let options = {
                method: "GET",
                headers: {
                    'Content-Type': 'application/json'
                }
            }
            fetch(url, options)
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Данные не получены ' + response.status);
                    }
                }).then(data => {
                // получаем список категорий
                selectCategories.forEach(category => {
                    if (category.textContent === data['CategoryName']['name']) {
                        if (curSelCategory != null) {
                            curSelCategory.classList.remove('selectCat');
                        }
                        category.classList.add('selectCat');
                        curSelCategory = category;
                    }
                });
            }).catch(error => {
                console.error('Ошибка: ', error)
            });
        }

        function changeCategorySelect(categories) {
            categories.forEach(elem => {
                elem.addEventListener('click', function () {
                    if (curSelCategory != null) {
                        curSelCategory.classList.remove('selectCat');
                    }
                    elem.classList.add('selectCat');
                    curSelCategory = elem;
                });
            });
        }

        function deletePhoto(photoName) {
            bDeletePhoto.addEventListener('click', function () {
                let url = `api_photos_web/${photoName}`;

                let options = {
                    method: "DELETE",
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }
                fetch(url, options)
                    .then(response => {
                        if (response.ok) {
                            return response.json();
                        } else {
                            throw new Error('Ошибка удаления данных')
                        }
                    }).then(data => {
                    alert(data['success']);
                    window.location.replace(window.location);
                }).catch(error => {
                    console.error('Ошибка: ', error)
                });
            });
        }

        const categories = document.querySelectorAll('.category');
        const createCategoryModal = new bootstrap.Modal(document.querySelector('#exampleModal1'));
        const createPhotoModal = new bootstrap.Modal(document.querySelector('#exampleModal2'));
        const createPhotoEditModal = new bootstrap.Modal(document.querySelector('#exampleModal3'));
        const buttonChange = document.querySelector('#exampleModal1 .btn-secondary');
        const inputChangeCategory = document.querySelector('#exampleModal1 .changeCategory');
        const photos = document.querySelectorAll('#photoWrapper .photo');
        if(photos.length > 0) {
            photos.forEach(photo => {
                photo.addEventListener('click', async function () {
                    deletePhoto(photo.getAttribute('alt'));
                    loadImageCategory(photo.getAttribute('alt'));
                    changeCategorySelect(document.querySelectorAll('.selectCategory'));
                    editPhotoCategory(photo.getAttribute('alt'));
                    createPhotoEditModal.show();
                });
            });
        }


        categories.forEach(category => {
            category.addEventListener('click', function () {
                currentCategory = category;
                document.querySelector('.modal-title').textContent = category.textContent;
                createCategoryModal.show();
            });
        });

        inputChangeCategory.addEventListener('input', function () {
            buttonChange.disabled = inputChangeCategory.value.length === 0;
        });

        buttonChange.addEventListener('click', function () {
            const url = `/api/api_categories/${currentCategory.textContent}`;
            const data = {
                name: inputChangeCategory.value,
                _token: '{{ csrf_token() }}',
            };
            const options = {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            };

            fetch(url, options)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Ошибка HTTP: ' + response.status);
                    }
                    return response.json();
                })
                .then(jsonResponse => {
                    currentCategory.textContent = jsonResponse.newName;
                    createCategoryModal.hide();
                })
                .catch(error => {
                    console.error('Ошибка при выполнении запроса:', error);
                });
        });

        const modalCreatePhoto = document.getElementById('create_photo');

        modalCreatePhoto.addEventListener('click', function () {

            if (selectCategories.length > 0) {
                changeCategorySelect(selectCategories);

                createPhotoModal.show();
                const buttonAddFile = document.querySelector('#exampleModal2 .btn-success');

                buttonAddFile.addEventListener('click', function () {
                    const fileInput = document.getElementById('formFile');
                    if (fileInput.files.length > 0) {
                        // отправка картинки на сервер
                        // создаем обьект FormData
                        const formData = new FormData();
                        // добавляем файл картинки в объект FormData
                        const file = fileInput.files[0]; // получаем выбранный файл
                        formData.append('image', file); // добавляем файл в FormData
                        formData.append('category', curSelCategory.textContent);

                        const options = {
                            method: 'POST', // или 'PUT', 'DELETE', 'GET' и т.д.
                            headers: {
                                'Action': 'application/json'
                                // Здесь вы также можете указать другие заголовки, если это необходимо
                            },
                            body: formData // преобразуем объект в JSON-строку
                        };

                        fetch('api_photos_web', options)
                            .then(response => {
                                if (!response.ok) {
                                    if (response.status === 400) {
                                        throw new Error('Ошибка загрузки файла: ' + response.status);
                                    }
                                    throw new Error('Ошибка HTTP: ' + response.status);
                                }
                                return response.json();
                            }).then(data => {
                            alert(data.message);
                            window.location.replace(window.location);
                        }).catch(error => {
                            console.clear();
                            console.error(error);
                            alert("Ошибка файла или файл уже существует")
                        });
                    }
                });
            } else {
                alert('Нету категорий , добавьте категорию!')
            }
        });
    });

</script>
</body>
</html>
