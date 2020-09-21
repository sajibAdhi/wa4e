<?php
// Can't have any output before session_start().
session_start();

if (!isset($_SESSION['count'])) {
    $msg = "Session is Empty";
    $_SESSION['count'] = 0;
} elseif ($_SESSION['count'] < 3) {
    $_SESSION['count'] = $_SESSION['count'] + 1;
    $msg = "Added One Session";
} else {
    session_destroy();
    session_start();
    $msg = "Session Restarted";
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Session Fun</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>
    <h1>Message : <?= $msg ?></h1>
    <p>Our Session ID : <?= $_SESSION['count'] ?></p>
    <p>
        <a href="SessionFun.php">Restart Session</a>
    </p>

    <p>
        <?= print_r($_SESSION)?>
    </p>
</body>

</html>