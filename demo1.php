<?php

require_once "./vendor/autoload.php";

use App\Services\HorizontalCalendar;

$year = intval(date('Y'));
$nameLength = 12;
$lang = 'en';

/** Check request POST */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $year = intval($_POST['year']);
    $nameLength = intval($_POST['nameLength']);
    $lang = $_POST['lang'];
}
?>

<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Demo</title>
</head>
<body>

<form action="demo1.php" method="post">
    <p>
        <label for="year">Năm</label>
        <input type="number" name="year" id="year" value="<?php echo $year; ?>">
    </p>
    <p>
        <label for="nameLength">Độ dài tên ngày</label>
        <input type="number" name="nameLength" id="nameLength" value="<?php echo $nameLength; ?>">
    </p>
    <p>
        <label for="lang">Ngôn ngữ</label>
        <select name="lang" id="lang">
            <option value="vi" <?php echo $lang == 'vi' ? 'selected' : ''; ?>>Tiếng Việt</option>
            <option value="en" <?php echo $lang == 'en' ? 'selected' : ''; ?>>English</option>
        </select>
    </p>
    <p>
        <button type="submit">Xem</button>
    </p>
</form>

<hr/>

<?php
$calendar = (new HorizontalCalendar($lang))->setNameLength($nameLength);
echo $calendar->displayCalendar($year);
?>

</body>
</html>
