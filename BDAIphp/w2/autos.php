<?php 
    // require_once('pdo.php');
?>
<?php
    

    if(isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])){
        echo $_POST['make'] . $_POST['year'] . $_POST['mileage'];
    }

    if(isset($_POST['logout'])){
        header("Location: index.php");
    }
    
?>
<!DOCTYPE html>
<html>

<head>
    <title>Sajib Adhikary</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

</head>

<body>
    <?php if (isset($_GET['name'])) :?>
    <div class="container">
        <h1>Tracking Autos for <?= $_GET['name'] ?></h1>
        <form method="POST">
            <p>Make:
                <input type="text" name="make" size="60" /></p>
            <p>Year:
                <input type="text" name="year" /></p>
            <p>Mileage:
                <input type="text" name="mileage" /></p>
            <input type="submit" value="Add">
            <input type="submit" name="logout" value="Logout">
        </form>

        <h2>Automobiles</h2>
        <ul>
            <p>
        </ul>
    </div>
    <?php endif;
     if(empty($who)) die("Name parameter missing");?>

</body>

</html>