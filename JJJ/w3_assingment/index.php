<?php require_once "baseController.php";?>
<!doctype html>
<html lang="en">

<head>
    <title>Sajib Adhikary - READ</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php require_once "link.php"; ?>
</head>

<body>
    <div class="container">
        <br>
        <br>
        <h1>Sajib Adhikary's Resume Registry</h1>
        <br>
        <br>
        <span><?= empty($msg) ? '' : $msg ?></span>
        <br>
        <br>
        <p><a href="login.php">Please Log In</a></p>
        <p><a href="logout.php">Logout</a></p>
        <br>
        <br>
        <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th>Name</th>
                    <th>Headline</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tfoot class="thead-inverse">
                <tr>
                    <th>Name</th>
                    <th>Headline</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                <tr>
                    <td>Sajib Adhikary</td>
                    <td>Web Pogrammer</td>
                    <td>
                        <a name="" id="" class="btn btn-danger" href="#" role="button">Edit</a>
                    </td>
                    <td>
                        <a name="" id="" class="btn btn-warning" href="#" role="button">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <a name="" id="" class="btn btn-primary" href="add.php" role="button">Add New Entry</a>
    </div>
    <?php require_once "script.php"; ?>
</body>

</html>