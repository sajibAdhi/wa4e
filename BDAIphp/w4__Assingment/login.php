<?php
session_start();

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
        
if (isset($_POST['account_no']) && isset($_POST['password'])) {
    $ac= test_input($_POST['account_no']);
    $pw = test_input($_POST['password']);
    // Logout Current User
    unset($_SESSION['account']);

    // Check Password
    if ($pw == "password") {
        $_SESSION['account'] = $ac;
        $_SESSION['success'] = "LOG In Succcess";
        header("Location: app.php");
        return;
    } else {
        $_SESSION['error'] = "Log In Failed";
        header("Location: login.php");
        return;
    }
}

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
?>
<?php
        $alert="";
        if (isset($_POST['who']) && isset($_POST['pass'])) {
            $who = $_POST['who'];
            $pass = $_POST['pass'];
            $who = test_input($who);
            $pass = test_input($pass);
            
            $patternOfEmail = "/\b[\w\.-]+@/";

            if (empty($who) || empty($pass)) {
                $alert = "Email and Password are Required";
            } else {
                if (preg_match($patternOfEmail, $who) == 1) {
                    $password = hash('sha256', 'php123');
                    $passHash = hash('sha256', $pass);

                    if ($passHash == $password) {
                        error_log("Login success ".$_POST['who']);
                        header("Location: autos.php?name=".urlencode($who));
                    } else {
                        $alert = "Incorrect password";
                        error_log("Login fail ".$_POST['who']." $passHash");
                    }
                } else {
                    $alert = "Email must have an at-sign (@)";
                }
            }
        }

        

?>
<!doctype html>
<html lang="en">

<head>
    <title>LogIn</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Please LogIn.....</h1>

        <span><?= empty($msg) ? '' : $msg ?></span>
        <form method="POST">
            <div class="form-group row">
                <label for="accountNo" class="col-md-3 col-form-label">Account No:</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="account_no" id="accountNo" placeholder="">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-md-3 col-form-label">Password:</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="password" id="password" placeholder="">
                </div>
            </div>
            <div class="form-group row">
                <button type="submit" class="btn btn-primary">Login</button>
                <a class="btn btn-warning" href="app.php" role="button">Cancel</a>
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