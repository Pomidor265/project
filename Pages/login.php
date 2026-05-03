<?php
    session_start();
    if (empty($_SESSION["csrf_token"])) {
    $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
    }

    $token = $_SESSION["csrf_token"];

    if (($_SERVER["REQUEST_METHOD"])=== 'POST'){
        if (!isset( $_POST['csrf_token']) || 
        $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die('csrf died');
    }
    }

    
    $host = '127.0.1.31';
    $port = 3306;
    $user = 'root';
    $password = ''; 
    $database = 'project';

    $conn = mysqli_connect($host, $user, $password, $database, $port);

    if (isset($_POST['phone']) && isset($_POST['password'])) {
    $a = $_POST['phone'];
    $b = $_POST['password']; 

    $query = "SELECT * FROM `User` WHERE `User_phone` = ? AND `User_password` = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $_POST['phone'], $_POST['password']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $qwe = mysqli_fetch_array($result);

    if ($qwe) {
        $_SESSION['user_phone'] = $qwe['User_phone'];
        $_SESSION['user_id'] = $qwe['User_id'];
        $_SESSION['auth'] = true;
        header('Location: main.php');
        exit();
        } 
        else {echo "Такого пользователя не существует";}
    }
        
        
    if (isset($_GET["exit_btn"])) {
        session_destroy();
        header('Location: main.php');
        exit();
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
    <link rel="stylesheet" href="/Style/Layouts/log.css">
    
    <script src="/Style/Components/header.js"></script>
    <script src="/Scripts/fun.js"></script>
    

    </head>
    <body>
        
    <my-header-log></my-header-log>

    <div class="page">
        <?php if(!isset($_SESSION["auth"]) || $_SESSION["auth"] !== true): ?>
            <form method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'];?>">

                <div class="field">
                    <div class="label-box">Телефон</div>
                    <input type="tel" name="phone" id="userInput">
                </div>

                <div class="field">
                    <div class="label-box">Пароль</div>
                    <input type="password" name="password" required  id="userInput">
                </div>

                    <input type="submit" value="Войти" class="btn" onclick="handleInput()">
                </div>
            </form>
        <?php endif;?>

    </div>
</body>
</html>