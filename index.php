<?php
if (array_key_exists('strtbtn', $_POST)) {
    setcookie('score', 0);
    date_default_timezone_set('Asia/Tehran');
    $sdate = date('i');
    setcookie('time', $sdate);
    header("location: question.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fa-ir">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>wordgame</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div>
        <h5>
            <?php
            if (isset($_COOKIE['record'])) {
                echo "بیشترین امتیاز شما: " . $_COOKIE['record'];
            } else {
                setcookie('record', 0);
            }
            echo '<br>';
            if (isset($_COOKIE['score'])) {
                echo "آخرین امتیاز شما: " . $_COOKIE['score'];
            }
            ?>
        </h5>

        <form method="post">
            <h3>
                پس از کلیک بر روی دکمه با توجه به توضیح هر کلمه را حدس بزنید.
            </h3>
            <div class="alert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                در این سامانه از کوکی‌ها استفاده می‌شود!
            </div>
            <button name="strtbtn" class="strb">ورود</button>
        </form>

    </div>
</body>
<script src="assets/js/js.js"></script>

</html>