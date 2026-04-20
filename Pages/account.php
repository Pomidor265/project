<?php
session_start();

if (isset($_GET["exit_btn"])) {
        session_destroy();
        header('Location: main.php');
        exit();
    }

if (isset($_GET["back_btn"])) {
        header('Location: main.php');
        exit();
    }

$host = '127.0.1.31';
$port = 3306;
$user = 'root';
$password = ''; 
$database = 'project';


$conn = mysqli_connect($host, $user, $password, $database, $port);

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM `User` WHERE `User_id` = '$user_id'";
$result = mysqli_query($conn, $query);

$user = mysqli_fetch_assoc($result);

$gender = $user['User_gender'] ?? 'Не указан';


$birthDate = new DateTime($user['User_birthday']); 
$today = new DateTime();
$age = $today->diff($birthDate)->y;

$user_id = $_SESSION['user_id'];

$appointmentsQuery = "
    SELECT 
        a.appointment_date,
        d.Doctor_surname,
        d.Doctor_name,
        d.Doctor_patronymic
    FROM appointment a
    LEFT JOIN Doctor d ON a.doctor_id = d.Doctor_id
    WHERE a.user_id = '$user_id'
    ORDER BY a.appointment_date DESC
    LIMIT 5
";

$appointmentsResult = mysqli_query($conn, $appointmentsQuery);

?>

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
        <my-header-log></my-header-log>
        <div class="page">
        <div class="logo-img">
                <img src="/src/avatar.png">
        </div>
        <div class="box">
        <?php 
        echo    $user['User_surname'] . ' ' . 
                $user['User_name'] . ' ' . 
                $user['User_patronymic'];
        ?>
        </div>
        <div class="box">
            Пол: <?= htmlspecialchars($gender) ?>
        </div>

        <div class="box">
            Возраст: <?= $age ?> лет
        </div>

        <div class="box" style="flex-direction: column; height: auto; padding: 10px;">
        <div>Недавние записи:</div>

        <?php if (mysqli_num_rows($appointmentsResult) > 0): ?>
    <?php while ($row = mysqli_fetch_assoc($appointmentsResult)): ?>
        <div style="font-weight: normal; margin-top: 5px;">
            <?= $row['appointment_date'] ?> — 
            <?= $row['Doctor_surname'] . ' ' . $row['Doctor_name'] . ' ' . $row['Doctor_patronymic'] ?>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <div style="font-weight: normal; margin-top: 5px;">
        Записей нет
    </div>
<?php endif; ?>
</div>
     
        <form method="GET">
        <input type="submit" name="back_btn" value="Назад", class="btn">
        <input type="submit" name="exit_btn" value="Выход", class="btn">
        </form>
    </div>   
    </body>