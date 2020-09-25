<?php
/// start Session
session_start();

/// Destroy session , So $_SESSION['name'] destroy
session_destroy();


header("Location: index.php");
return;
?>