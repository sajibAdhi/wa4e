<?php
require_once 'pdo.php';
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
 * Destroy session and Logout
 */
if (isset($_POST['logout'])) {
    header("Location: view.php");
    return;
}

/**
 * Recive's Post Request, Check Validation, Add data.
 */
if (isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])) {

    ///Sanitization
    $make = test_input($_POST['make']);
    $year = test_input($_POST['year']);
    $milage = test_input($_POST['mileage']);
    
    /// Check is numeric
    if (is_numeric($year) && is_numeric($milage)) {

        /// if $make is empty then return error msg
        if (!empty($make)) {

            /// Prepare Insert quere.
            $stmt = $pdo->prepare('INSERT INTO autos
                (make, year, mileage) VALUES ( :mk, :yr, :mi)');

            /// Execute query
            $insert = $stmt->execute(array(
                ':mk' => $make,
                ':yr' => $year,
                ':mi' => $milage
            ));

            /// If Insertion Fail @return error
            if ($insert != false) {

                $_SESSION['success'] = "Record inserted";
                header("Location: view.php");
                return;
            } else {
                $_SESSION['error'] = "Record Inserted Failed";
            }
           
        } else {
            $_SESSION['error'] = "Make is required";
        }
    } else {

        $_SESSION['error'] = "Mileage and year must be numeric";
    }
    header("Location: add.php");
    return;
}


/// Check if any Error msg is set and then unset
if (isset($_SESSION['error'])) {
    $msg = '<div class="alert alert-warning" role="alert">
            <strong>' . $_SESSION['error'] . '</strong>
        </div>';
    unset($_SESSION['error']);
}

/// Check if any Success msg is set and then unset
if (isset($_SESSION['success'])) {
    $msg = '<div class="alert alert-warning" role="alert">
            <strong>' . $_SESSION['success'] . '</strong>
        </div>';
    unset($_SESSION['success']);
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Sajib Adhikary - Add Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">

        <?php
        /**
         * Check User Logged in Or Not.
         */
        if (isset($_SESSION['name'])) : ?>
                <h1>Add Autos for <?= $_SESSION['name'] ?></h1>
                <br>
                <span><?= empty($msg)? '' : $msg ?></span>
                <br>
                <form method="POST">
                    <p>Make:
                        <input type="text" name="make" size="60" /></p>
                    <p>Year:
                        <input type="text" name="year" /></p>
                    <p>Mileage:
                        <input type="text" name="mileage" /></p>
                    <input type="submit" value="Add">
                    <input type="submit" name="logout" value="Cancel">
                </form>
        <?php else : ?>
            <h1>Not Logged In</h1>

            <p>
                Please <a href="login.php">Login</a> First.
            </p>
        <?php endif; ?>
    </div>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>