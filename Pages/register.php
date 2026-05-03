<?php
session_start();

if (empty($_SESSION["csrf_token"])) {
    $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
    }

    $token = $_SESSION["csrf_token"];

    if (($_SERVER["REQUEST_METHOD"])=== 'POST'){
        if (!isset( $_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die('csrf died');
    }
    }


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
        $checkQuery = "SELECT * FROM User WHERE User_email = ?";
        $checkStmt = mysqli_prepare($conn, $checkQuery);
        mysqli_stmt_bind_param($checkStmt, "s", $mail);
        mysqli_stmt_execute($checkStmt);
        $result = mysqli_stmt_get_result($checkStmt);

        if (mysqli_num_rows($result) > 0) {
            echo "Пользователь уже существует!";
        } else {
            $insertQuery = "INSERT INTO User 
            (User_surname, User_name, User_patronymic, User_phone, User_email, User_birthday, User_password) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = mysqli_prepare($conn, $insertQuery);
            mysqli_stmt_bind_param($stmt, "sssssss", $surname, $name, $patronymic, $phone, $mail, $birthday, $password);
            
            if (mysqli_stmt_execute($stmt)) {
                header('Location: main.php');
                exit();
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
    <my-header-log></my-header-log>
    <div class="page">
    <form method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'];?>">
    <div class="form-wrapper">
        
        <div class="fields">
            <div class="field">
                <div class="label-box">Фамилия</div>
                <input type="text" name="surname" required id="userInput">
            </div>

            <div class="field">
                <div class="label-box">Имя</div>
                <input type="text" name="name" required id="userInput">
            </div>

            <div class="field">
                <div class="label-box">Отчество</div>
                <input type="text" name="patronymic" id="userInput">
            </div>

            <div class="field">
                <div class="label-box">Телефон</div>
                <input type="tel" name="phone" id="userInput">
            </div>

            <div class="field">
                <div class="label-box">Почта</div>
                <input type="email" name="mail" required id="userInput">
            </div>

            <div class="field">
                <div class="label-box">Дата рождения</div>
                <input type="date" name="birthday" id="userInput">
            </div>

            <div class="field">
                <div class="label-box">Пароль</div>
                <input type="password" name="password" required id="userInput">
            </div>
        </div>

        <div class="container1">
            <input type="submit" name="ok_btn" value="Зарегистрироваться" class="btn" onclick="handleInput()">
            <p>Уже есть аккаунт?</p>
            <button type="button" onclick="window.location.href='login.php'" class="btn">Войти</button>
        </div>

    </div>
</form>
</div>
               
</body>
</html>