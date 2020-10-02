<?php require_once "Model/readModel.php"; ?>
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
        <?php if (!isset($_SESSION['user'])) : ?>
            <p><a href="login.php">Please Log In</a></p>
        <?php else : ?>
            <p><a href="logout.php">Logout</a></p>
            <p>
                <a name="" id="" class="btn btn-primary" href="add.php" role="button">Add New Entry</a>
            </p>
        <?php endif; ?>
        <br>
        <br>
        <?php
            $datas = allProfileList($pdo);
        if (!empty($datas)) : ?>
            <table class="table table-striped table-inverse table-responsive">
                <thead class="thead-inverse">
                    <tr>
                        <th>Name</th>
                        <th>Headline</th>
                        <?php if (isset($_SESSION['user'])) : ?>
                            <th colspan="2">Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tfoot class="thead-inverse">
                    <tr>
                        <th>Name</th>
                        <th>Headline</th>
                        <?php if (isset($_SESSION['user'])) : ?>
                            <th>Action</th>
                        <?php endif; ?>
                    </tr>
                </tfoot>
                <tbody>
                    <?php while ($data = $datas->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td>
                                <a href="view.php?profile_id=<?= $data['profile_id'] ?>">
                                    <?= htmlentities($data['first_name']." ".$data['last_name']) ?>
                                </a>
                            </td>
                            <td><?= htmlentities($data['headline'])?></td>
                            <?php if (isset($_SESSION['user'])) : ?>
                                <td>
                                    <a name="" id="" class="btn btn-danger" href="edit.php?profile_id=<?= $data['profile_id']?>" role="button">Edit</a>
                                </td>
                                <td>
                                    <a name="" id="" class="btn btn-warning" href="delete.php?profile_id=<?= $data['profile_id']?>" role="button">Delete</a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php endif; ?>
        <br>
        <br>
    </div>
    <?php require_once "script.php"; ?>
</body>

</html>