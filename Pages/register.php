<?php
session_start();


$host = '127.0.1.31';
$port = 3306;
$user = 'root';
$password = '';
$database = 'project';

$conn = mysqli_connect($host, $user, $password, $database, $port);


if (isset($_POST['ok_btn'])) {

    $surname = $_POST['surname'];
    $name = $_POST['name'];
    $patronymic = $_POST['patronymic'];
    $phone = $_POST['phone'];
    $mail = $_POST['mail'];
    $birthday = $_POST['birthday'];
    $password = $_POST['password'];


    if (empty($surname) || empty($name) || empty($mail) || empty($password)) {
        echo "Заполните обязательные поля!";
    } else {

        $query = "SELECT * FROM User WHERE User_email = '$mail'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "Пользователь уже существует!";
        } else {

          
            $insertQuery = "INSERT INTO User 
            (User_surname, User_name, User_patronymic, User_phone, User_email, User_birthday, User_password) 
            VALUES 
            ('$surname', '$name', '$patronymic', '$phone', '$mail', '$birthday', '$password')";

            if (mysqli_query($conn, $insertQuery)) {
                header('Location: main.php');
                echo "Регистрация успешна!";
            } else {
                echo "Ошибка: " . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Энциклопедия о заболеваниях</title>
    <link rel="stylesheet" href="/Style/Global_css/fonts.css">
    <link rel="stylesheet" href="/Style/Components/header.css">
    <link rel="stylesheet" href="/Style/Layouts/register.css">
    
    <script src="/Style/Components/header.js"></script>
    <script src="/Scripts/fun.js"></script>

    </head>
<body>
    <my-header></my-header>
       <form method="POST">
    <div class="container">
        <label>Фамилия:</label>
        <input type="text" id="userInput" name="surname" required>

        <label>Имя:</label>
        <input type="text" id="userInput" name="name" required>
        
        <label>Отчество:</label>
        <input type="text" name="patronymic">

        <label>Телефон:</label>
        <input type="tel" id="userInput" name="phone">

        <label>Почта:</label>
        <input type="email" id="userInput" name="mail" required>

        <label>Дата рождения:</label>
        <input type="date" name="birthday">

        <label>Пароль:</label>
        <input type="password" id="userInput" name="password" required>
    </div>

    <div class="container1">
        <input type="submit" name="ok_btn" value="Зарегистрироваться">
        <p>Уже есть аккаунт?</p>
        <button type="button" onclick="window.location.href='login.php'">Войти</button>
    </div>
</form>
               
</body>
</html>