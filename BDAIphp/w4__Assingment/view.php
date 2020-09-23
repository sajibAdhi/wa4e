<?php
require_once "pdo.php";
session_start();
// Show LogIn Success Message
if (isset($_SESSION['success'])) {
    $msg = '<div class="alert alert-success" role="alert">
            <strong>' . $_SESSION['success'] . '</strong>
        </div>';
    unset($_SESSION['success']);

    $name = $_SESSION['name'];
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Sajib Adhikary - Auto Mobile Tracker </title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <?php
        // Check If Loged In. 
        if (!isset($_SESSION['name'])) :
        ?>
            <h1>Not Logged In</h1>
            <p>
                Please <a href="login.php">Log In</a> To Start.
            </p>
        <?php else : ?>
            <span><?= empty($msg) ? '' : $msg ?></span>
            <br>
            <br>
            <h1>Welcome <?= $_SESSION['name'] ?></h1>
            <h3>This is a Cool Application.</h3>
            <br>
            <br>
            <?php
            $stmt = $pdo->query("SELECT make, year, mileage FROM autos ORDER BY id");

            if ($stmt != false) :
            ?>

                <h3>Auto Mobiles</h3>
                <!-- Autos Table Start's Here -->
                <table class="table table-border">
                    <thead>
                        <tr>
                            <td>MAKE</td>
                            <td>YEAR</td>
                            <td>MILEAGE</td>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td>MAKE</td>
                            <td>YEAR</td>
                            <td>MILEAGE</td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) :
                        ?>
                            <tr>
                                <td>
                                    <b><?= $data['make'] ?></b>
                                </td>
                                <td><?= $data['year'] ?></td>
                                <td><?= $data['mileage'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <!-- Autos Table End's Here -->
            <?php endif; ?>
            <p>
                If you want to add data, Click <a class="btn btn-primary" href="add.php" role="button">Here</a>
            </p>
            <p>
                Please <a href="logout.php">LogOut</a> When you are done.
            </p>
        <?php endif; ?>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>