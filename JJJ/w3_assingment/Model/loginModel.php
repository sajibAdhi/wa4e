<?php require_once "baseModel.php";

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
                $password = hash('md5', $salt . $pw);

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
?>