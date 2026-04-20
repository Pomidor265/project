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

    if (isset($_POST['phone']) && isset($_POST['password'])) {
    $a = $_POST['phone'];
    $b = $_POST['password']; 

    $query = "SELECT * FROM `User` WHERE `User_phone`='$a' AND `User_password`='$b'";
    $result = mysqli_query($conn, $query);
    $qwe = mysqli_fetch_array($result); 

    if ($qwe) {
        $_SESSION['user_phone'] = $qwe['User_phone'];
        $_SESSION['user_id'] = $qwe['User_id'];
        $_SESSION['auth'] = true;
        header('Location: main.php');
        exit();
        } 
        else {echo "-";}
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

        <?php if(isset($_SESSION["auth"]) && $_SESSION["auth"] === true): ?>
            <form method="GET">
                <div class="container">
                    <p><input type="submit" name="exit_btn" value="выйти"></p>
                </div>
            </form>
        <?php endif;?>

        <?php if(!isset($_SESSION["auth"]) || $_SESSION["auth"] !== true): ?>
            <form method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'];?>">

                <div class="field">
                    <div class="label-box">Телефон</div>
                    <input type="tel" name="phone">
                </div>

                <div class="field">
                    <div class="label-box">Пароль</div>
                    <input type="password" name="password" required>
                </div>

                    <input type="submit" value="Войти" class="btn">
                </div>
            </form>
        <?php endif;?>

    </div>
</body>
</html>