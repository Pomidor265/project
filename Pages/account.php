<?php
session_start();

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

$query = "SELECT * FROM `User`";
$result = mysqli_query($conn, $query);

$prod = mysqli_fetch_all($result, MYSQLI_ASSOC);

foreach($prod as $item) {


?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Энциклопедия о заболеваниях</title>
    <link rel="stylesheet" href="/Style/Global_css/fonts.css">
    <link rel="stylesheet" href="/Style/Components/header.css">
    <link rel="stylesheet" href="/Style/Layouts/register.css">
    
    <script src="/Style/Components/header.js"></script>
    </head>
    <body>
        <my-header></my-header>

        <div class="logo-img">
                <img src="/src/avatar.png">
        </div>
        <p><?=$item['User_surname']?> <?$item=['User_name']?> <?=$item['User_patronymic']?></p>
        <?php
        };
        ?>
        
        <form method="GET">
        <p><input type="submit" name="exit_btn" value="выйти"></p>
        </form>
   
    </body>