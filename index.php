<?php
// 設定時區列表
$timezones = timezone_identifiers_list();

// 檢查是否有提交表單
if (isset($_POST['submit'])) {
    // 獲取表單資料
    $taiwan_time = $_POST['taiwan_time'];
    $target_timezone = $_POST['target_timezone'];

    // 設定台灣時區
    date_default_timezone_set('Asia/Taipei');

    // 創建 DateTime 物件
    $date = new DateTime($taiwan_time);

    // 設定目標時區
    $date->setTimezone(new DateTimeZone($target_timezone));

    // 格式化轉換後的時間
    $converted_time = $date->format('Y-m-d H:i:s');
} else {
    $converted_time = '';
}
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>時間轉換</title>
</head>
<body>
    <h1>時間轉換</h1>
    <form method="post">
        <label for="taiwan_time">台灣時間 (格式: YYYY-MM-DD HH:MM:SS): </label>
        <input type="text" id="taiwan_time" name="taiwan_time" required>
        <br><br>
        <label for="target_timezone">選擇目標時區: </label>
        <select id="target_timezone" name="target_timezone" required>
            <?php
            foreach ($timezones as $timezone) {
                echo "<option value=\"$timezone\">$timezone</option>";
            }
            ?>
        </select>
        <br><br>
        <input type="submit" name="submit" value="轉換時間">
    </form>
    <br>
    <?php
    if (!empty($converted_time)) {
        echo "<h2>轉換後的時間: $converted_time</h2>";
    }
    ?>
</body>
</html>
