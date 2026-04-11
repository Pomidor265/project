<!-- <?php
    session_start();
    

    $host = '127.0.1.31';
    $port = 3306;
    $user = 'root';
    $password = ''; 
    $database = 'project';

    $conn = mysqli_connect($host, $user, $password, $database, $port);
    // $a = $_GET['Type'];

    $query = "SELECT * FROM `Doctor_type`";
    $result = mysqli_query($conn, $query);
    $qwe = mysqli_fetch_array($result); 

    ?> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Энциклопедия о заболеваниях</title>
    <link rel="stylesheet" href="/Style/Global_css/fonts.css">
    <link rel="stylesheet" href="/Style/Components/header.css">
    <link rel="stylesheet" href="/Style/Layouts/app.css">
    
    <script src="/Style/Components/header.js"></script>
    </head>
<body>
    <my-header></my-header>
        <div class="box">Регион</div>
        <div class="box">Адрес</div>
        <div class="box">Телефон</div>
        <div class="box">ФИО</div>
        <div class="box">Врач</div>
</body>
</html>