<?php
require_once "pdo.php";
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
    unset($_SESSION['name']);
    unset($_SESSION['user']);

    /// Sanitization
    $ac = test_input($_POST['email']);
    $pw = test_input($_POST['pass']);

    /// Check if Input Fields empty show a message
    if (!empty($ac) && !empty($pw)) {

        /// If Email pattern don't match show error
        if (preg_match($emailPattern, $ac) == 1) {


            $selectquery = "SELECT user_id, name, password FROM users WHERE email = :em";
            $prepare = $pdo->prepare($selectquery);
            $execute = $prepare->execute(array(
                ':em' => $ac,
            ));

            if ($execute != FALSE) {

                $data = $prepare->fetch();
                $salt = 'XyZzy12*_';
                $password = hash('md5', $salt . $pw);
                echo $data['password'] . "<br>";
                echo $password;
                if ($password == $data['password']) {

                    $_SESSION['name'] = $data['name'];
                    $_SESSION['user'] = $data['user_id'];
                    $_SESSION['success'] = "LOG In Succcess";
                    header("Location: index.php");
                    return;
                } else {

                    $_SESSION['error'] = "Incorrect password";
                }
            } else {

                $_SESSION['error'] = "Incorrect User";
            }
        } else {

            $_SESSION['error'] = "Email must have an at-sign (@)";
        }
    } else {

        $_SESSION['error'] = "Email and Password are Required";
    }
    error_log("Login fail " . $_POST['email'] . " $pw");
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
                <input type="submit" onclick="return doValidate();" class="btn btn-primary" value="Log In">
            </div>
        </form>
        <a class="btn btn-warning" href="index.php" role="button">Cancel</a>
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

            em = document.getElementById('email').value
            pw = document.getElementById('password').value;
            console.log("Validating pw=" + pw);

            if (pw == null || pw == "" || em == null || em == "") {

                alert("All fields are required");
                return false;
            }

            return true;
        }
    </script>
</body>

</html>