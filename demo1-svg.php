<?php

require_once "./vendor/autoload.php";

use SVG\SVG;
use SVG\Nodes\Shapes\SVGRect;
use SVG\Nodes\Texts\SVGText;
use App\Services\HorizontalCalendar;

$year = intval(date('Y'));
$nameLength = 20;
$lang = 'vi';
$color = '#000000';
$colorSat = '#0000ff';
$colorSun = '#ff0000';

/** Check request POST */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $year = intval($_POST['year']);
    $nameLength = intval($_POST['nameLength']);
    $lang = $_POST['lang'];
    $color = $_POST['color'];
    $colorSat = $_POST['colorSat'];
    $colorSun = $_POST['colorSun'];
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

<form action="demo1-svg.php" method="post">
    <p>
        <label for="year">Năm</label>
        <input type="number" name="year" id="year" value="<?php echo $year; ?>">
    </p>
    <p>
        <label for="nameLength">Độ dài tên ngày</label>
        <input type="number" name="nameLength" id="nameLength" value="<?php echo $nameLength; ?>">
    </p>
    <p>
        <label for="color">Màu chữ</label>
        <input type="text" name="color" id="color" value="<?php echo $color; ?>">
    </p>
    <p>
        <label for="colorSat">Màu chữ thứ 7</label>
        <input type="text" name="colorSat" id="colorSat" value="<?php echo $colorSat; ?>">
    </p>
    <p>
        <label for="colorSun">Màu chữ chủ nhật</label>
        <input type="text" name="colorSun" id="colorSun" value="<?php echo $colorSun; ?>">
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
$image = $calendar->displayCalendarSvg($year, $color,$colorSat, $colorSun);
echo $image->toXMLString(false);
?>

</body>
</html>
