<?php
session_start();

/**
 * Sanitize Post Data
 *
 * @param string $data
 * @return string
 */
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Login Function
 *
 * @return header index | login
 */
if (isset($_POST['email']) && isset($_POST['pass'])) {

    /// Logout Current User
    unset($_SESSION['user']);

    /// Sanitization
    $ac = test_input($_POST['email']);
    $pw = test_input($_POST['pass']);

    /// Email Pattern
    $emailPattern = "/\b[\w\.-]+@/";

    /// Check if Input Fields empty show a message
    if (!empty($ac) && !empty($pw)) {

        /// If Email pattern don't match show error
        if (preg_match($emailPattern, $ac) == 1) {

            $password = hash('sha256', 'php123');
            $passHash = hash('sha256', $pw);

            /// If password match then show  login msg
            if ($passHash == $password) {

                error_log("Login success ".$_POST['email']);

                $_SESSION['user'] = $ac;
                $_SESSION['success'] = "LOG In Succcess";
                header("Location: index.php");
                return;
            } else {

                $_SESSION['error'] = "Incorrect password";
            }
        } else {

            $_SESSION['error'] = "Email must have an at-sign (@)";
        }
    } else {

        $_SESSION['error'] = "Email and Password are Required";
    }
    error_log("Login fail ".$_POST['email']." $passHash");
    header("Location: login.php");
    return;
}

/// Check if any Error msg is set and then unset
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
    <title>Sajib Adhikary - LogIn</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
<div class="container">
    <h1>Please LogIn.....</h1>

    <!-- Flash Message -->
    <span><?= empty($msg) ? '' : $msg ?></span>
    <!-- Form -->
    <form method="POST">
        <!-- Email -->
        <div class="form-group row">
            <label for="email" class="col-md-3 col-form-label">Email:</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="email" id="email" placeholder="">
            </div>
        </div>
        <!-- Password -->
        <div class="form-group row">
            <label for="password" class="col-md-3 col-form-label">Password:</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="pass" id="password" placeholder="">
            </div>
        </div>
        <!-- Submit Button -->
        <div class="form-group row">
            <input type="submit" class="btn btn-primary" value="Log In">
        </div>
    </form>
    <a class="btn btn-warning" href="index.php" role="button">Cancel</a>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>