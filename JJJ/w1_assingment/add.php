<?php
require_once "pdo.php";
session_start();

/// Insertion
if (
    isset($_POST['first_name']) &&
    isset($_POST['last_name']) &&
    isset($_POST['email']) &&
    isset($_POST['headline']) &&
    isset($_POST['summary'])
) {

    $fn = $_POST['first_name'];
    $ln = $_POST['last_name'];
    $em = $_POST['email'];
    $hl = $_POST['headline'];
    $su = $_POST['summary'];

    /// Check Empty
    if (empty($fn) || empty($ln) || empty($em) || empty($hl) || empty($su)) {

        $_SESSION['error'] = "All fields are required.";
    } else {

        if (preg_match($emailPattern, $em) == 1) {
            /// Insert Query
            $stmt = $pdo->prepare('INSERT INTO Profile (user_id, first_name, last_name, email, headline, summary)
                    VALUES ( :uid, :fn, :ln, :em, :he, :su)');

            /// Execute Query
            $success = $stmt->execute(array(
                ':uid' => $_SESSION['user'],
                ':fn' => $fn,
                ':ln' => $ln,
                ':em' => $em,
                ':he' => $hl,
                ':su' => $su
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
            $_SESSION['error'] = "Email must have an at-sign (@)";
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
        <?php if (!isset($_SESSION['name'])) : ?>
            <h1>Not logged in</h1>
            <p>
                Please <a href="login.php">Login</a> First
            </p>
        <?php else : ?>
            <h1>Tracking Profiles for <?= $_SESSION['name'] ?></h1>
            <hr>
            <br>
            <!-- Form -->
            <form method="POST">
                <!-- First Name -->
                <div class="form-group row">
                    <label for="first_name" class="col-md-3 col-form-label">First Name:</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="first_name" id="first_name">
                    </div>
                </div>
                <!-- Last Name -->
                <div class="form-group row">
                    <label for="last_name" class="col-md-3 col-form-label">Last Name:</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="last_name" id="last_name">
                    </div>
                </div>
                <!-- email -->
                <div class="form-group row">
                    <label for="email" class="col-md-3 col-form-label">Email:</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="email" id="email">
                    </div>
                </div>
                <!-- HEADLINE -->
                <div class="form-group row">
                    <label for="hline" class="col-md-3 col-form-label">Headline</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="headline" id="headline">
                    </div>
                </div>
                <!-- Summary -->
                <div class="form-group row">
                    <label for="summary" class="col-md-3 col-form-label">Summary</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="summary" id="summary">
                    </div>
                </div>
                <!-- Add Button -->
                <div class="form-group row">
                    <div class="col-sm-10">
                        <input class="btn btn-primary" onclick="return doValidate();" type="submit" value="Add">
                    </div>
                </div>
            </form>
            <!-- Cancel Button -->
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancel</a>
        <?php endif; ?>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- Custom Js -->
    <script>
        function doValidate() {

            console.log('Validating...');

            fn = document.getElementById('first_name').value;
            ln = document.getElementById('last_name').value;
            em = document.getElementById('email').value;
            hl = document.getElementById('headline').value;
            su = document.getElementById('summary').value;

            console.log("Validating pw=" + fn);

            if (fn == null || fn == "" ||
                ln == null || ln == "" ||
                em == null || em == "" ||
                hl == null || hl == "" ||
                su == null || su == ""
            ) {

                alert("All fields are required");
                return false;
            }

            return true;
        }
    </script>
</body>

</html>