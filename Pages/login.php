<?php
    session_start();
    if (empty($_SESSION["csrf_token"])) {
    $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
    }

    $token = $_SESSION["csrf_token"];

    if (isset($_SERVER["REQUEST_METHOD"])=== 'GET'){
        if (!isset( $_GET['csrf_token']) || $_GET['csrf_token'] !== $_SESSION['csrf_token']) {
            die('csrf');
    }
    }

    if (isset($_GET["exit_btn"])) {
        session_destroy();
        header('Location: main.php');
    }
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
            $_SESSION['user_phone'] = $qwe['User_phone'];
            $_SESSION['user_password'] = $qwe['User_password'];
            $_SESSION['auth'] = true;
            header('Location: main.php');
            echo '+';
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
    <link rel="stylesheet" href="/Style/Global_css/fonts.css">
    <link rel="stylesheet" href="/Style/Components/header.css">
    <link rel="stylesheet" href="/Style/Layouts/register.css">
    
    <script src="/Style/Components/header.js"></script>
    <script src="/Scripts/fun.js"></script>
    

    </head>
<body>
    <my-header></my-header>
        <?php if(isset($_SESSION["auth"]) && $_SESSION["auth"] === true): ?>
            <form method="GET">
            <div class="container">
            <p><input type="submit" name="exit_btn" value="выйти"></p>
            </div>
        </form>
        <?php endif;?>
        
        <?php if(!isset($_SESSION["auth"]) || $_SESSION["auth"] !== true): ?>
        <form method="GET">
            <input type="hidden" name="csrf_token", value="<?php echo $_SESSION['csrf_token'];?>">
            <div class="container">
                
                <label for="phone">Телефон:</label>
                <input type="tel" id="userInput" name="phone" value="">

                <label for="password">Пароль:</label>
                <input type="password" id="userInput" name="password" value="">

                <p><input type="submit" name="btn_conf" value="Войти"></p>
            </div>
        </form>
        <?php endif;?>
</body>
</html>