<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Энциклопедия о заболеваниях</title>
    <link rel="stylesheet" href="/Style/Components/header.css">
    <link rel="stylesheet" href="/Style/Layouts/register.css">
    
    <script src="/Scripts/header.js"></script>
    </head>
<body>
    <my-header></my-header>
        <form>
            <div class="container">
                <label for="surname">Фамилия:</label>
                <input type="text" name="surname" value="">

                <label for="name">Имя:</label>
                <input type="text" name="name" value="">
                
                <label for="paternity">Отчество:</label>
                <input type="text" name="paternity" value="">

                <label for="phone">Телефон:</label>
                <input type="tel" name="phone" value="">

                <label for="mail">Почта:</label>
                <input type="email" name="mail" value="">

                <label for="birthdate">Дата рождения:</label>
                <input type="date" name="birthdate" value="">

                <label for="password">Пароль:</label>
                <input type="password" name="password" value="">
            </div>
        </form>
            <div class="container1">
                <p><input type="submit" name="ok_btn" value="Зарегистрироваться"></p>
                <p>Уже есть аккаунт?</p>
                <button class="btn" onclick="window.location.href='login.php'">Войти</button>
            </div>
        

</body>
</html>