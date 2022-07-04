<?php
require_once 'connect.php';
$time = intval($_COOKIE['time']);
date_default_timezone_set('Asia/Tehran');
$allstatue = false;
if ($time == date('i') + 2) {
    header("location: index.php");
}
if (array_key_exists('submit', $_POST)) {
    $cid = $_COOKIE['qid'];
    $nhsql = "SELECT * FROM words WHERE id = '$cid'";
    $nres = mysqli_query($dbcon, $nhsql);
    $nrow = mysqli_fetch_assoc($nres);
    $fc = $nrow['fc'];
    $sc = $nrow['sc'];
    $fc = $nrow['fc'];
    $tc = $nrow['tc'];
    function chck($charecter, $charecternum)
    {
        $userfc = $_POST['ufc'];
        $usersc = $_POST['usc'];
        $usertc = $_POST['utc'];
        $usercarray = array($userfc, $usersc, $usertc);
        if ($charecternum == 1) {
            $fcn = 0;
            $scn = 1;
            $tcn = 2;
        } else if ($charecternum == 2) {
            $fcn = 1;
            $scn = 2;
            $tcn = 0;
        } else {
            $fcn = 2;
            $scn = 1;
            $tcn = 0;
        }
        $fcheak = $charecter == $usercarray[$fcn];
        $scheak = $charecter == $usercarray[$scn];
        $tcheak = $charecter == $usercarray[$tcn];
        if ($fcheak == true) {
            ${'statue' . $charecternum} = 'صحیح';
        } else if ($fcheak == false && $scheak == true || $tcheak == true) {
            ${'statue' . $charecternum} = 'در کلمه وجود دارد';
        } else {
            ${'statue' . $charecternum} = 'در کلمه وجود ندارد';
        }
        return ${'statue' . $charecternum};
    }
    if (chck($fc, 1) == 'صحیح' && chck($sc, 2) == 'صحیح' && chck($tc, 3) == 'صحیح') {
        $allstatue = true;
    }
    echo 'حرف اول: ' . chck($fc, 1);
    echo '،' . " ";
    echo 'حرف دوم: ' . chck($sc, 2);
    echo '،' . " ";
    echo "حرف سوم: " . chck($tc, 3);
    if (chck($fc, 1) == 'صحیح' && chck($sc, 2) == "صحیح" && chck($tc, 3) == 'صحیح') {
        $lscore = intval($_COOKIE['score']);
        setcookie('score', $lscore + 1);
    }
    setcookie('qid', 0, time() - (86400 * 15), "/");
}
$record = intval($_COOKIE['record']);
$score = intval($_COOKIE['score']);
if ($score > $record) {
    setcookie('record', $score);
}
$sql = "SELECT * FROM `words` WHERE 1";
$rowcount = mysqli_num_rows(mysqli_query($dbcon, $sql));
$num_of_ques = rand(1, $rowcount);
$hsql = "SELECT * FROM words WHERE id = '$num_of_ques'";
$res = mysqli_query($dbcon, $hsql);
$row = mysqli_fetch_assoc($res);
$id = $row['id'];
$ainfo = $row['info'];

setcookie('qid', $id);

?>
<!DOCTYPE html>
<html lang="fa-ir" dir="rtl">

<head>
</head>
<meta charset="UTF-8">
<meta http-equiv="refresh" content="120">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="assets/css/style.css">
<title>wordgame</title>
<link rel="icon" href="assets/img/icon.png">

<body>
    <form name="jumpForm" method="post">
        <div id="clockdiv">
            <table>
                <tr>
                    <div>
                        <td> <span class="minutes"></span></td>
                        <td>
                            <div class="smalltext">دقیقه</div>
                        </td>
                        <td>
                            <p>و</p>
                        </td>
                        <td> <span class="seconds"></span></td>
                        <td>
                            <div class="smalltext">ثانیه</div>
                        </td>
                        <td>
                            <div class="smalltext">از زمان باقی مانده است.</div>
                        </td>
                    </div>
                </tr>
            </table>



        </div>
        <h6 class="info-head"><?php
                                echo "توضیح کلمه: " . $ainfo;
                                ?></h6>

        <table class="charecter">
            <tr>
                <td class="left">حرف اول</td>
                <td class="middle">حرف دوم</td>
                <td class="right">حرف سوم</td>
            </tr>
            <tr>
                <td class="left">
                    <div class="first"> <input maxlength="1" tabindex="1" name="ufc" required onkeyup="jump(this,this.value)">
                    </div>
                </td>
                <td class="middle">
                    <div class="second"> <input maxlength="1" name="usc" tabindex="1" required onkeyup="jump(this,this.value)">
                    </div>
                </td>
                <td class="right">
                    <div class="third"> <input maxlength="1" name="utc" tabindex="1" required onkeyup="jump(this,this.value)">
                    </div>
                </td>
            </tr>
        </table>
        <button name="submit">ثبت</button>
    </form>

</body>
<script src="assets/js/js.js"></script>
ّ

</html>