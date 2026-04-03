<?php
session_start();

$conn = mysqli_connect('127.0.1.31','root','','project',3306);

$query = "SELECT * FROM Disease";
$result = mysqli_query($conn, $query);
$dis = mysqli_fetch_all($result, MYSQLI_ASSOC);


$selected = $_GET['disease'] ?? null;


$category_map = [
    1 => 'Легкие заболевания',
    2 => 'Средние заболевания',
    3 => 'Тяжелые заболевания',
    4 => 'Онкологические заболевания',
    5 => 'Генетические заболевания'
];


$categories = [];
foreach($dis as $item){
    $cat_id = $item['Category_id']; 
    $categories[$cat_id][] = $item;
}


$selected_disease = null;
if ($selected) {
    foreach($dis as $item){
        if ($item['Disease_id'] == $selected){
            $selected_disease = $item;
            break;
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
    <link rel="stylesheet" href="/Style/Components/header.css">
    <link rel="stylesheet" href="/Style/Layouts/main.css">
    
    <script src="/Scripts/header.js"></script>
    </head>
<body>

    <my-header></my-header>
        <div class="cont">

    <div class="container">
        <button class="btn" onclick="window.location.href='register.php'">Зарегистрироваться</button>
    </div>


    <form method="GET">
        <?php foreach ($category_map as $cat_id => $cat_name): ?>
            <label><?= $cat_name ?></label>
            <select name="disease" onchange="this.form.submit()">
                <option disabled selected>Выберите заболевание</option>
                <?php if(isset($categories[$cat_id])): ?>
                    <?php foreach($categories[$cat_id] as $d): ?>
                        <option value="<?= $d['Disease_id'] ?>" <?= ($selected == $d['Disease_id']) ? 'selected' : '' ?>>
                            <?= $d['Disease_name'] ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
            <br><br>
        <?php endforeach; ?>
    </form>
</div>

    <div class="right">
    <?php if($selected_disease): ?>
        <div class="card">
            <h3><?=$selected_disease['Disease_name']?></h3>
            <p><?=$selected_disease['Disease_description']?></p>
            <p><b>Симптомы:</b> <?=$selected_disease['Disease_symptoms']?></p>
            <p><b>Причина:</b> <?=$selected_disease['Disease_cause']?></p>
        </div>
    <?php else: ?>
        <p>Выберите заболевание из списка</p>
    <?php endif; ?>
</div>

</div>

</div>

</body>