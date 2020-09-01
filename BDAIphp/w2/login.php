<?php
        $alert="";
        if(isset($_POST['who']) && isset($_POST['pass']))
        {
            $who = $_POST['who'];
            $pass = $_POST['pass'];
            $who = test_input($who);
            $pass = test_input($pass);
            
            $patternOfEmail = "/\b[\w\.-]+@/";

            if(empty($who) || empty($pass))
            {
                $alert = "Email and Password are Required";
            }
            else
            {
                if(preg_match($patternOfEmail, $who) == 1){
                    $password = hash('sha256', 'php123');
                    $passHash = hash('sha256', $pass);

                    if($passHash == $password){
                        error_log("Login success ".$_POST['who']);
                        header("Location: autos.php?name=".urlencode($who));
                    }
                    else{
                        $alert = "Incorrect password";
                        error_log("Login fail ".$_POST['who']." $passHash");
                    }
                }
                else
                {
                    $alert = "Email must have an at-sign (@)";
                }
                
            }
            
        }

        function test_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sajib Adhikary</title>
</head>
<body>
    <div class="container">
    <h1>Please Log In</h1>
    <div style="color: red;"><?= $alert ?></div>
    <form method="POST">
    <label for="nam">User Name</label>
    <input type="text" name="who" id="nam"><br/>
    <label for="id_1723">Password</label>
    <input type="text" name="pass" id="id_1723"><br/>
    <input type="submit" value="Log In">
    <input type="submit" name="cancel" value="Cancel">
    </form>
</body>
</html>