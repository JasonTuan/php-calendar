<?php

require_once "./vendor/autoload.php";

use App\Services\GridCalendar;

$year = intval(date('Y'));
$lang = 'en';

/** Check request POST */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $year = intval($_POST['year']);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .table thead tr th {
            text-align: center;
        }
        .table thead tr th.weekend {
            background-color: var(--bs-danger);
            color: var(--bs-white);
        }

        .table tbody tr td {
            height: 100px;
            text-align: right;
        }
        .table tbody tr td.weekend {
            color: var(--bs-danger);
        }
        .table tbody tr td.other {
            background-color: var(--bs-gray-100);
        }
    </style>
    <title>Demo</title>
</head>
<body>

<form action="demo2.php" method="post">
    <p>
        <label for="year">Năm</label>
        <input type="number" name="year" id="year" value="<?php echo $year; ?>">
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
$calendar = new GridCalendar($lang);
echo $calendar->displayCalendar($year);
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
