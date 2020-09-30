<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=wa4e', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/// Email Pattern
$emailPattern = "/\b[\w\.-]+@/";
?>