<?php require_once "Model/readModel.php";

if(!isset($_GET['profile_id'])){

    $_SESSION['error'] = "Missing profile_id";
    header("Location: index.php");
    return;
} 
else {

    $data = getSingleProfile($pdo, $_GET['profile_id']);
    $positions = loadPos($pdo,$_GET['profile_id']);
    // var_dump($positions);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sajib Adhikary - VIEW</title>

    <?php require_once "link.php"; ?>
</head>

<body>
    <div class="container">
        <!-- First Name -->
        <div class="form-group row">
            <label for="first_name" class="col-md-3 col-form-label">First Name:</label>
            <div class="col-md-9">
                <p><?= htmlentities($data['first_name']) ?></p>
            </div>
        </div>
        <!-- Last Name -->
        <div class="form-group row">
            <label for="last_name" class="col-md-3 col-form-label">Last Name:</label>
            <div class="col-md-9">
                <p><?= htmlentities($data['last_name']) ?></p>
            </div>
        </div>
        <!-- email -->
        <div class="form-group row">
            <label for="email" class="col-md-3 col-form-label">Email:</label>
            <div class="col-md-9">
                <p><?= htmlentities($data['email']) ?></p>
            </div>
        </div>
        <!-- HEADLINE -->
        <div class="form-group row">
            <label for="hline" class="col-md-3 col-form-label">Headline</label>
            <div class="col-md-9">
                <p><?= htmlentities($data['headline']) ?></p>
            </div>
        </div>
        <!-- Summary -->
        <div class="form-group row">
            <label for="summary" class="col-md-3 col-form-label">Summary</label>
            <div class="col-md-9">
                <p><?= htmlentities($data['summary']) ?></p>
            </div>
        </div>
        <!-- New  Positions -->
        <div id="positionFields">
            <?php if($positions  != FALSE) :?>
                Position
                <ul>
                    <?php for($i = 0; $i< count($positions); $i++) : ?>
                    <li>Year : <?= $positions[$i]['year'] ?> Description : <?= $positions[$i]['description']?></li>
                    <?php endfor?>
                </ul>
            <?php endif?>
        </div>
        <!-- Add Button -->
        <div class="form-group row">
            <div class="col-md-12">
                <a name="" id="" class="btn btn-primary" href="index.php" role="button">Done</a>
            </div>
        </div>
    </div>
    <?php require_once "script.php"; ?>
</body>

</html>