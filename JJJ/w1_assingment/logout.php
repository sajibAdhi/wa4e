<?php
/// start Session
session_start();

/// Unset Session
unset($_SESSION['name']);
unset($_SESSION['user_id']);


header("Location: index.php");
return;
?>