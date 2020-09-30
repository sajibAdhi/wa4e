<?php
require_once "pdo.php";
session_start();

if (!isset($_SESSION['name'])) {
    die("Not logged in.");
}

/// Update
if (
    isset($_POST['id']) &&
    isset($_POST['first_name']) &&
    isset($_POST['last_name']) &&
    isset($_POST['email']) &&
    isset($_POST['headline']) &&
    isset($_POST['summary'])
) {
    $id = $_POST['id'];
    $fn = $_POST['first_name'];
    $ln = $_POST['last_name'];
    $em = $_POST['email'];
    $hl = $_POST['headline'];
    $su = $_POST['summary'];


    /// Check Empty
    if (empty($fn) || empty($ln) || empty($em) || empty($hl) || empty($su)) {

        $_SESSION['error'] = " All fields are required.";
    } else {

        if (preg_match($emailPattern, $em) == 1) {
            /// update Query
            $updateQuery = "UPDATE profile 
                SET first_name = :fn, last_name = :ln, email = :em, headline = :hl, summary = :su 
                WHERE profile_id = :pid && user_id = :uid";

            /// Prepare Query
            $prepare = $pdo->prepare($updateQuery);

            /// Execute Query
            $execute = $prepare->execute(array(
                ':uid' => $_SESSION['user'],
                ':fn' => $fn,
                ':ln' => $ln,
                ':em' => $em,
                ':hl' => $hl,
                ':su' => $su,
                ':pid' => $id,
            ));

            /// If updateion seccessful then redirect to index.
            if ($execute != false) {

                $_SESSION['success'] = " Record edited";
                header("Location: index.php");
                return;
            } else {
                $_SESSION['error'] = "Record Failed to Update";
            }
        } else {
            $_SESSION['error'] = "Email must have an at-sign (@)";
            header("Location: edit.php?id=".$id);
            return;
        }

        header("Location: index.php");
        return;
    }
}

if (!isset($_GET['id'])) {

    $_SESSION['error'] = "Missing profile id";
    header("Location: index.php");
    return;
}

$selectQuery = "SELECT * FROM profile WHERE user_id = :uid && profile_id = :pid";
$prepare = $pdo->prepare($selectQuery);


$execute = $prepare->execute(array(
    ":uid" => $_SESSION['user'],
    ":pid" => $_GET['id'],
));

$data = $prepare->fetch(PDO::FETCH_ASSOC);
if ($data === FALSE) {

    $_SESSION['error'] = "Profile Id doesn't Exist";
    header("Location: index.php");
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
            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
            <!-- First Name -->
            <div class="form-group row">
                <label for="first_name" class="col-md-3 col-form-label">First Name:</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" value="<?= htmlentities($data['first_name']) ?>" name="first_name" id="first_name">
                </div>
            </div>
            <!-- Last Name -->
            <div class="form-group row">
                <label for="last_name" class="col-md-3 col-form-label">Last Name:</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" value="<?= htmlentities($data['last_name']) ?>" name="last_name" id="last_name">
                </div>
            </div>
            <!-- email -->
            <div class="form-group row">
                <label for="email" class="col-md-3 col-form-label">Email:</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" value="<?= htmlentities($data['email']) ?>" name="email" id="email">
                </div>
            </div>
            <!-- HEADLINE -->
            <div class="form-group row">
                <label for="hline" class="col-md-3 col-form-label">Headline</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" value="<?= htmlentities($data['headline']) ?>" name="headline" id="headline">
                </div>
            </div>
            <!-- Summary -->
            <div class="form-group row">
                <label for="summary" class="col-md-3 col-form-label">Summary</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" value="<?= htmlentities($data['summary']) ?>" name="summary" id="summary">
                </div>
            </div>
            <!-- Add Button -->
            <div class="form-group row">
                <div class="col-sm-10">
                    <input class="btn btn-primary" onclick="return doValidate();" type="submit" value="Save">
                </div>
            </div>
        </form>
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