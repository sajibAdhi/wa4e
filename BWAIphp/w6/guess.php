<?php
  $msg = null;
  if ( ! isset($_GET['guess']) ) { 
    $msg = "Missing guess parameter";
  } else if ( strlen($_GET['guess']) < 1 ) {
    $msg = "Your guess is too short";
  } else if ( ! is_numeric($_GET['guess']) ) {
    $msg = "Your guess is not a number";
  } else if ( $_GET['guess'] < 26 ) {
    $msg = "Your guess is too low";
  } else if ( $_GET['guess'] > 26 ) {
    $msg = "Your guess is too high";
  } else {
    $msg = "Congratulations - You are right";
  }
?>
<html>
<head>
<title>Sajib Adhikary</title>
</head>
<body>
<h1>Welcome to my guessing game</h1>
<p>
<?= $msg ?>
</p>
</body>
</html>
  
