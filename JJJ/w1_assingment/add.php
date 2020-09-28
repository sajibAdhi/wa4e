<?php
require_once "pdo.php";
session_start();

/// Insertion
if (
    isset($_POST['fname']) && 
    isset($_POST['lname']) && 
    isset($_POST['email']) && 
    isset($_POST['headline']) && 
    isset($_POST['summary'])
) {

    $fn = $_POST['fname'];
    $ln = $_POST['lname'];
    $em = $_POST['email'];
    $hl = $_POST['headline'];
    $su = $_POST['summary'];

    /// Check Empty
    if (empty($fn) || empty($ln) || empty($email) || empty($hl) || empty($su)) {

        $_SESSION['error'] = " All fields are required.";
    } else {

        /// Insert Query
        $stmt = $pdo->prepare('INSERT INTO Profile (user_id, first_name, last_name, email, headline, summary)
                        VALUES ( :uid, :fn, :ln, :em, :he, :su)');

        /// Execute Query
        $success = $stmt->execute(array(
            ':uid' => $_SESSION['user_id'],
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
                    <label for="fname" class="col-md-3 col-form-label">First Name:</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="fname" id="fname">
                    </div>
                </div>
                <!-- Last Name -->
                <div class="form-group row">
                    <label for="lname" class="col-md-3 col-form-label">Last Name:</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="lname" id="lname">
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