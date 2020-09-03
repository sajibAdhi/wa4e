<?php
require_once 'pdo.php';
$alert = "";
$color = "";

if (isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])) {
    $make = test_input($_POST['make']);
    $year = test_input($_POST['year']);
    $milage = test_input($_POST['mileage']);

    if (is_numeric($year) && is_numeric($milage)) {
        if (empty($make)) {
            $color = "red";
            $alert = "Make is required";
        } else {
            $stmt = $pdo->prepare('INSERT INTO autos
                (make, year, mileage) VALUES ( :mk, :yr, :mi)');
            $insert = $stmt->execute(array(
                ':mk' => $make,
                ':yr' => $year,
                ':mi' => $milage
            ));

            if ($insert != false) {
                $color = "green";
                $alert = "Record inserted";
            }
        }
    } else {
        $color = "red";
        $alert = "Mileage and year must be numeric";
    }
}

if (isset($_POST['logout'])) {
    header("Location: index.php");
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Sajib Adhikary</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <?php if (isset($_GET['name'])) : ?>

        <div class="container">
            <h1>Tracking Autos for <?= $_GET['name'] ?></h1>
            <div style="color: <?= $color ?>;"><?= $alert ?></div>
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

            <table class="table table-border">
                <thead>
                    <tr>
                        <td>MAKE</td>
                        <td>YEAR</td>
                        <td>MILEAGE</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $pdo->query("SELECT make, year, mileage FROM autos ORDER BY auto_id");
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


        </div>
    <?php
    else :
        die("Name parameter missing");
    endif;
    ?>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>