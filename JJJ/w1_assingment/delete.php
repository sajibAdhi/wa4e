<?php
require_once "pdo.php";
session_start();

if (!isset($_SESSION['name'])) {
    die("Not logged in.");
}

if (!isset($_GET['id'])) {

    $_SESSION['error'] = "Missing user id";
    header("Location: index.php");
    return;
}

$selectQuery = "SELECT make, id FROM autos WHERE id = :xyz, user_id = :uid";
$select = $pdo->prepare($selectQuery);

$select->execute(array(
    ":xyz" => $_GET['id'],
    ":uid" => $_SESSION['user'],
));

$data = $select->fetch(PDO::FETCH_ASSOC);

if ($data === FALSE) {

    $_SESSION['error'] = "Bad Value For Profiles Id";
    header("Location: index.php");
    return;
}

if (isset($_POST['delete']) && isset($_POST['id'])) {

    $deleteSql = "DELETE FROM autos where id = :zap";
    $prepareSql = $pdo->prepare($deleteSql);

    $delete = $prepareSql->execute(array(
        ':zap' => $_POST['id'],
    ));

    if ($delete === FALSE) {

        $_SESSION['error'] = "Failed to  Delete Record";
        header("Location: index.php");
        return;
    } else {

        $_SESSION['success'] = " Record deleted";
        header("Location: index.php");
        return;
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Sajib Adhikary - DELETE</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <h1>Confirm: Deleting auto : <?= htmlentities($data['make']) ?></h1>
        <form method="post">
            <input type="hidden" name="id" value="<?= $data['id'] ?>">
            <input type="submit" name="delete" value="Delete">
        </form>
        <a class="btn btn-primary" href="index.php" role="button">Cancel</a>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>