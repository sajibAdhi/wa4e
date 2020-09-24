<?php
    require_once "pdo.php";
    session_start();

    /// Insertion
    if( isset( $_POST['name'] ) && isset( $_POST['email'] ) && isset( $_POST['password'] ) ){

        /// Insert Query
        $insertQuery = "INSERT INTO user (name, email, password) VALUE (:name, :email, :password)";

        /// Prepare Query
        $insert = $pdo->prepare($insertQuery);
        
        /// Execute Query
        $success = $insert->execute( array(
            ':name' => $_POST['name'],
            ':email' => $_POST['email'],
            ':password' => $_POST['password'],
        ) );

        /// If Insertion seccessful then redirect to index.
        if($success != false){

            $_SESSION['success'] = "Record Inserted";
            header("Location: index.php");
            return;
        }
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
        <h1>Add New user</h1>
        <hr>
        <div class="container">
            <form method="POST">
                <div class="form-group row">
                    <label for="name" class="col-sm-1-12 col-form-label">Name</label>
                    <div class="col-sm-1-12">
                        <input type="text" class="form-control" name="name" id="name" placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-1-12 col-form-label">Email</label>
                    <div class="col-sm-1-12">
                        <input type="email" class="form-control" name="email" id="email" placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-1-12 col-form-label">Password</label>
                    <div class="col-sm-1-12">
                        <input type="password" class="form-control" name="password" id="password" placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <input class="btn btn-primary" type="submit" value="Add New">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>