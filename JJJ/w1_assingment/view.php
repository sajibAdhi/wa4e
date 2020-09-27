<?php
require_once "pdo.php";
session_start();

// Check User is Present or Not
if (!isset($_SESSION['name'])) {

    $msg = '<h1> Access Denied </h1>';
    $msg .= '<p>
        <a href="login.php">Login First</a>   
        <p>';
    die($msg);
}

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    if (is_numeric($id)) {
        $sql = "SELECT * FROM profile WHERE id = :profile_id";
        $selectQuery = $pdo->prepare($sql);

        $selectQuery->execute(array(
            ':profile_id' => $id,
        ));

        $data = $selectQuery->fetch(PDO::FETCH_ASSOC);
    }
} else {

    die("No Profile Id Provided");
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Sajib Adhikary - VIEW</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <!-- First Name -->
        <div class="form-group row">
            <label for="fname" class="col-md-3 col-form-label">First Name:</label>
            <div class="col-md-9">
                <p><?= $data['first_name'] ?></p>
            </div>
        </div>
        <!-- Last Name -->
        <div class="form-group row">
            <label for="lname" class="col-md-3 col-form-label">Last Name:</label>
            <div class="col-md-9">
                <p><?= $data['last_name']?></p>
            </div>
        </div>
        <!-- email -->
        <div class="form-group row">
            <label for="email" class="col-md-3 col-form-label">Email:</label>
            <div class="col-md-9">
                <p><?= $data['email']?></p>
            </div>
        </div>
        <!-- HEADLINE -->
        <div class="form-group row">
            <label for="hline" class="col-md-3 col-form-label">Headline</label>
            <div class="col-md-9">
            <p><?= $data['headline']?></p>
            </div>
        </div>
        <!-- Summary -->
        <div class="form-group row">
            <label for="summary" class="col-md-3 col-form-label">Summary</label>
            <div class="col-md-9">
            <p><?= $data['summary']?></p>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>