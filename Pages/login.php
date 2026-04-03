<?php
    session_start();
    
    $host = '127.0.1.31';
    $port = 3306;
    $user = 'root';
    $password = ''; 
    $database = 'project';

    $conn = mysqli_connect($host, $user, $password, $database, $port);

    if (isset($_GET['phone']) && isset($_GET['password'])) {
        $a = $_GET['phone'];
        $b = $_GET['password'];

        $query = "SELECT * FROM `User` WHERE `User_phone`='$a' AND `User_password`='$b'";
        $result = mysqli_query($conn, $query);
        $qwe = mysqli_fetch_array($result); 

        if ($qwe) {
            echo '+';
            $_SESSION['user_phone'] = $qwe['User_phone'];
            $_SESSION['user_password'] = $qwe['User_password'];
        } else {
            echo "-";
        }
    }
    ?>
    
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
        <form method="GET">
            <div class="container">
                
                <label for="phone">Телефон:</label>
                <input type="text" name="phone" value="">

                <label for="password">Пароль:</label>
                <input type="password" name="password" value="">

                <p><input type="submit" name="btn_conf" value="Войти"></p>
            </div>
        </form>
</body>
</html>