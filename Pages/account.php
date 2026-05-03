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

if (isset($_POST["exit_btn"])) {
        session_destroy();
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

$query = "SELECT * FROM `User` WHERE `User_id` = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$user = mysqli_fetch_assoc($result);

$gender = $user['User_gender'] ?? 'Не указан';

if (isset($_POST["back_btn"])) {
    $new_gender = $_POST['gender'] ?? null;

    if (empty($gender) || $gender == 'Не указан') {

        $updateQuery = "UPDATE `User` SET `User_gender` = ? WHERE `User_id` = ?";
        $stmt = mysqli_prepare($conn, $updateQuery);
        mysqli_stmt_bind_param($stmt, "si", $new_gender, $user_id);
        mysqli_stmt_execute($stmt);
    }

    header('Location: main.php');
    exit();
}


$birthDate = new DateTime($user['User_birthday']); 
$today = new DateTime();
$age = $today->diff($birthDate)->y;

$user_id = $_SESSION['user_id'];

$appointmentsQuery = "
    SELECT 
        a.appointment_date,
        d.Doctor_surname,
        d.Doctor_name,
        d.Doctor_patronymic,
        dt.Type_name
    FROM appointment a
    LEFT JOIN Doctor d ON a.doctor_id = d.Doctor_id
    LEFT JOIN DoctorType dt ON d.Doctor_type_id = dt.Doctor_type_id
    WHERE a.user_id = ?
    ORDER BY a.appointment_date DESC
    LIMIT 5
";

$stmt = mysqli_prepare($conn, $appointmentsQuery);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$appointmentsResult = mysqli_stmt_get_result($stmt);

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
        Пол:
        <?php if (empty($gender) || $gender == 'Не указан'): ?>
        
        <form method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'];?>">
            <select name="gender">
                <option value="Мужской">Мужской</option>
                <option value="Женский">Женский</option>
            </select>
        <?php else: ?>
            <?= $gender ?>
        <?php endif; ?>
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
            <?= $row['Doctor_surname'] . ' ' . $row['Doctor_name'] . ' ' . $row['Doctor_patronymic'] . ' ' . $row['Type_name'] ?>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <div style="font-weight: normal; margin-top: 5px;">
        Записей нет
    </div>
<?php endif; ?>
</div>
     
        <form method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'];?>">
        <input type="submit" name="back_btn" value="Назад", class="btn" formmethod="POST">
        <input type="submit" name="exit_btn" value="Выход" class="btn" >
        </form>
    </div>   
    </body> 