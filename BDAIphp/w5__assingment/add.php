<?php
require_once "pdo.php";
session_start();

/// Insertion
if (isset($_POST['make']) && isset($_POST['model']) && isset($_POST['year']) && isset($_POST['mileage'])) {

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

            /// Insert Query
            $insertQuery = "INSERT INTO autos (make, model, year, mileage) VALUE (:make, :model, :year, :mileage)";

            /// Prepare Query
            $insert = $pdo->prepare($insertQuery);

            /// Execute Query
            $success = $insert->execute(array(
                ':make' => $_POST['make'],
                ':model' => $_POST['model'],
                ':year' => $_POST['year'],
                ':mileage' => $_POST['mileage'],
            ));

            /// If Insertion seccessful then redirect to index.
            if ($success != false) {

                $_SESSION['success'] = " Record added";
                header("Location: index.php");
                return;
            } else {

                $_SESSION['error'] = "Record Inserted Failed";
            }
        } else {

            $_SESSION['error'] = " Year & Mileage must be an integer";
        }
    }

    header("Location: add.php");
    return;
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
    <title>Sajib Adhikary - CREATE</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <span><?= empty($msg) ? '' : $msg ?></span>
        <?php if (!isset($_SESSION['user'])) : ?>
            <h1>Access Denied</h1>
        <?php else : ?>
            <h1>Tracking Automobiles for <?= $_SESSION['user'] ?></h1>
            <hr>
            <br>
            <!-- Form -->
            <form method="POST">
                <!-- Make -->
                <div class="form-group row">
                    <label for="make" class="col-md-3 col-form-label">Make</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="make" id="make">
                    </div>
                </div>
                <!-- Model -->
                <div class="form-group row">
                    <label for="model" class="col-md-3 col-form-label">Model</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="model" id="model">
                    </div>
                </div>
                <!-- Year -->
                <div class="form-group row">
                    <label for="year" class="col-md-3 col-form-label">Year</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="year" id="year">
                    </div>
                </div>
                <!-- Mileage -->
                <div class="form-group row">
                    <label for="mileage" class="col-md-3 col-form-label">Mileage</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="mileage" id="mileage">
                    </div>
                </div>
                <!-- Add Button -->
                <div class="form-group row">
                    <div class="col-sm-10">
                        <input class="btn btn-primary" type="submit" value="Add">
                    </div>
                </div>
            </form>
            <!-- Cancel Button -->
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancel</a>
        <?php endif; ?>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>