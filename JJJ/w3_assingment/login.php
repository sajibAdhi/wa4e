<?php require_once "Model/loginModel.php";?>
<!doctype html>
<html lang="en">

<head>
    <title>Sajib Adhikary - LOGIN</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php require_once "link.php";?>
</head>

<body>
    <div class="container">
        <br>
        <br>
        <h1>Please Log In</h1>
        <br>
        <br>
        <!-- Flash Msg -->
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
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </div>
        </form>
        <a class="btn btn-warning" href="index.php" role="button">Cancel</a>
    </div>

    <?php require_once "script.php";?>
    <!-- Custom Js -->
    <script>
        function doValidate() {

            console.log('Validating...');

            em = document.getElementById('email').value
            pw = document.getElementById('password').value;
            if (pw == null || pw == "" || em == null || em == "") {

                alert("All fields are required");
                return false;
            }

            return true;
        }
    </script>
</body>

</html>