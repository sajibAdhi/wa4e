<?php
require_once "pdo.php";
session_start();

if (!isset($_SESSION['user'])) {
    die("Access Denied");
}
if (!isset($_GET['id'])) {

    $_SESSION['error'] = "Missing user id";
    header("Location: index.php");
    return;
}

$selectQuery = "SELECT * FROM autos WHERE id = :xyz";
$select = $pdo->prepare($selectQuery);


$select->execute(array(
    ":xyz" => $_GET['id'],
));

$data = $select->fetch(PDO::FETCH_ASSOC);
if ($data === FALSE) {

    $_SESSION['error'] = "Bad Value For Auto's Id";
    header("Location: index.php");
    return;
}

/// Update
if (isset($_POST['id']) && isset($_POST['make']) && isset($_POST['model']) && isset($_POST['year']) && isset($_POST['mileage'])) {

    $id = $_POST['id'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $mileage = $_POST['mileage'];

    /// Check Empty
    if (empty($make) || empty($model) || empty($year) || empty($mileage)) {

        $_SESSION['error'] = " All fields are required.";
    } else {

        /// Check is numeric or not
        if (is_numeric($year) && is_numeric($mileage)) {

            /// update Query
            $updateQuery = "UPDATE autos SET make = :make, model = :model, year = :year, mileage = :mileage WHERE id = :id";

            /// Prepare Query
            $update = $pdo->prepare($updateQuery);

            /// Execute Query
            $success = $update->execute(array(
                ':make' => $make,
                ':model' => $model,
                ':year' => $year,
                ':mileage' => $mileage,
                ':id' => $id,
            ));

            /// If updateion seccessful then redirect to index.
            if ($success != false) {

                $_SESSION['success'] = " Record edited";
                header("Location: index.php");
                return;
            } else {
                $_SESSION['error'] = "Record Failed to Update";
                header("Location: index.php");
                return;
            }
        } else {
            $_SESSION['error'] = " Year & Mileage must be an integer";
        }
    }
}


/// Set Error Message 
if (isset($_SESSION['error'])) {
    $msg = '<div class="alert alert-warning" role="alert">
                <strong>' . $_SESSION['error'] . '</strong>
            </div>';
    unset($_SESSION['error']);
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Sajib Adhikary - UPDATE</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <span><?= empty($msg) ? '' : $msg ?></span>
        <!-- Form -->
        <form method="POST">
            <!-- id -->
            <input type="hidden" name="id" value="<?= $data['id'] ?>">
            <!-- Make -->
            <div class="form-group row">
                <label for="make" class="col-md-3 col-form-label">Make</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="make" id="make" value="<?= htmlentities($data['make']) ?>">
                </div>
            </div>
            <!-- Model -->
            <div class="form-group row">
                <label for="model" class="col-md-3 col-form-label">Model</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="model" id="model" value="<?= htmlentities($data['model']) ?>">
                </div>
            </div>
            <!-- Year -->
            <div class="form-group row">
                <label for="year" class="col-md-3 col-form-label">Year</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="year" id="year" value="<?= htmlentities($data['year']) ?>">
                </div>
            </div>
            <!-- Mileage -->
            <div class="form-group row">
                <label for="mileage" class="col-md-3 col-form-label">Mileage</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="mileage" id="mileage" value="<?= htmlentities($data['mileage']) ?>">
                </div>
            </div>
            <!-- Add Button -->
            <div class="form-group row">
                <div class="col-sm-10">
                    <input class="btn btn-primary" type="submit" value="Save">
                </div>
            </div>
        </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>