<?php
session_start();

$host = '127.0.1.31';
$port = 3306;
$user = 'root';
$password = ''; 
$database = 'project';

$conn = mysqli_connect($host, $user, $password, $database, $port);

if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

$user_id = $_SESSION['user_id'] ?? null;



$doctorsQuery = "
    SELECT d.Doctor_id, d.Doctor_surname, d.Doctor_name, d.Doctor_patronymic, 
           d.Doctor_type_id, d.Hospital_id, dt.type_name
    FROM Doctor d
    JOIN DoctorType dt ON d.Doctor_type_id = dt.doctor_type_id
";
$doctorsResult = mysqli_query($conn, $doctorsQuery);



if (isset($_POST['app_btn'])) {

    $region = mysqli_real_escape_string($conn, $_POST['region']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $fio = mysqli_real_escape_string($conn, $_POST['fio']);
    $doctor_id = (int)$_POST['doctor_id'];

    $doctorQuery = "
        SELECT Doctor_type_id, Hospital_id 
        FROM doctor 
        WHERE Doctor_id = $doctor_id
    ";
    $doctorResult = mysqli_query($conn, $doctorQuery);
    $doctorData = mysqli_fetch_assoc($doctorResult);

    $doctor_type_id = $doctorData['Doctor_type_id'];
    $hospital_id = $doctorData['Hospital_id'];

   $query = "INSERT INTO appointment 
    (Region, doctor_id, doctor_type, User_id, FIO, hospital_id, address, Appointment_date)
    VALUES 
    ('$region', '$doctor_id', '$doctor_type_id', '$user_id', '$fio', '$hospital_id', '$address', NOW())";

   if (mysqli_query($conn, $query)) {
    header("Location: main.php");
    exit;
}


}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Запись к врачу</title>

    <link rel="stylesheet" href="/Style/Global_css/fonts.css">
    <link rel="stylesheet" href="/Style/Components/header.css">
    <link rel="stylesheet" href="/Style/Layouts/app.css">
    
    <script src="/Style/Components/header.js"></script>
</head>

<body>

<my-header-log></my-header-log>

<div class="page">

    <form method="POST">

        <div class="field">
            <div class="label-box">Регион</div>
            <input type="text" name="region" required>
        </div>

        <div class="field">
            <div class="label-box">Адрес</div>
            <input type="text" name="address" required>
        </div>

        <div class="field">
            <div class="label-box">Телефон</div>
            <input type="text" name="phone" required>
        </div>

        <div class="field">
            <div class="label-box">ФИО</div>
            <input type="text" name="fio" required>
        </div>

        <div class="field">
            <div class="label-box">Врач</div>
            <select name="doctor_id" required>
                <option value="">Выберите врача</option>
                <?php while ($doc = mysqli_fetch_assoc($doctorsResult)): ?>
                    <option value="<?= $doc['Doctor_id'] ?>">
                        <?= $doc['Doctor_surname'] . ' ' . $doc['Doctor_name'] . ' ' . $doc['Doctor_patronymic'] ?>
                        (<?= $doc['type_name'] ?>)
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <input type="submit" name="app_btn" value="Записаться" class="btn">

    </form>

</div>

</body>
</html>