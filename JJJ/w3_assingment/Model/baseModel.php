<?php
session_start();

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=wa4e', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/// Email Pattern
$emailPattern = "/\b[\w\.-]+@/";

///SALT
$salt = 'XyZzy12*_';

/**
 * Flash Messages
 *
 * @return session error | success
 */
if (isset($_SESSION['error'])) {
    $msg = '<div class="alert alert-warning" role="alert">
                <strong>' . $_SESSION['error'] . '</strong>
            </div>';
    unset($_SESSION['error']);
}

if (isset($_SESSION['success'])) {
    $msg = '<div class="alert alert-success" role="alert">
                <strong>' . $_SESSION['success'] . '</strong>
            </div>';
    unset($_SESSION['success']);
}


function validateProfile(){
    if(
        strlen($_POST['first_name']) == 0 || 
        strlen($_POST['last_name']) == 0 || 
        strlen($_POST['email']) == 0 || 
        strlen($_POST['headline']) == 0 || 
        strlen($_POST['summary']) == 0
    ){
        return "All fields are required";
    }

    if(strpos($_POST['email'], '@') === FALSE){
        return "Email address must Contain @";
    }
}
?>