<?php
$guess = '';
session_start();

$message = FALSE;

if (isset($_POST['guess'])) {

    $guess = $_POST['guess'] + 0;
    $_SESSION['guess'] = $guess;

    $randomValue = rand(0, 20);
    if ($guess == $randomValue) {
        $message = $_SESSION['message'] = "Great job, your guess is right.";
    } elseif ($guess < $randomValue) {
        $message = $_SESSION['message'] = "Your Guess is too Low";
    } else {
        $message = $_SESSION['message'] = "Your Guess is too High";
    }
    header("Location: guess2.php");
    return;
}
?>
<html>

<head>
    <title>Sajib Adhikary</title>
</head>

<body>
    <h1>Welcome to my guessing game</h1>
    <p>Gussing Game.....</p>
    <?php
    $guess = isset($_SESSION['guess']) ? $_SESSION['guess'] : '';
    $message = isset($_SESSION['message']) ? $_SESSION['message'] : false;
    ?>
    <p>
        <?php
        if ($message !== FALSE) {
            echo $message;
        }
        ?>
    </p>

    <form method="POST">
        <label for="guess"></label>
        <input type="text" name="guess" id="guess" size="40" value="<?= $guess ?>">
        <input type="submit">
    </form>
</body>

</html>