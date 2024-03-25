window.addEventListener('DOMContentLoaded',()=> {
    let form = document.getElementById('reg_form');
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        let email_ = document.getElementById('input_email').value;
        let password_ = document.getElementById('input_password').value;
        let name_ = document.getElementById('input_name').value;

        let result = validateForm(email_,password_,name_);

        if (result === true) {
            let data = {
                name: name_,
                email: email_,
                password: password_
            };
            console.log(data)

            // отправляем данные на сервер для создания
            let url = 'api/register';
            let options = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            };

            fetch(url, options)
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('' + response.status)
                    }
                }).then(responseData => {
                    console.log(responseData);
            }).catch(error => {
                console.error('Ошибка: ', error);
            });


        } else {
            alert(result)
        }
    });
});