function validateForm(email,password,name) {

    // Проверка наличия значений в полях
    if (email === "" || password === "" || name === "") {
        return '"Пожалуйста, заполните все поля."';
    }

    // Проверка формата email
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        return 'Пожалуйста, введите корректный адрес электронной почты.'
    }

    // Проверка на длину пароля
    if (password.length < 6) {
        return 'Пароль должен содержать не менее 6 символов.'
    }

    // Если все проверки пройдены, форма валидна
    return true;
}