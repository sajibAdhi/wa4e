<?php
session_start();

unset($_SESSION['name']);
unset($_SESSION['user']);
header("Location: index.php");
return;
?>
