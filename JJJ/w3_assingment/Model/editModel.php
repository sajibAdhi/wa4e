<?php require_once "baseModel.php";

if (!isset($_SESSION['name'])) {
    die("Not logged in.");
}

if (!isset($_GET['profile_id'])) {

    $_SESSION['error'] = "Missing profile id";
    header("Location: index.php");
    return;
}

/**
 * Select Data QUERY
 */
$selectQuery = "SELECT * FROM profile WHERE user_id = :uid && profile_id = :pid";
$prepare = $pdo->prepare($selectQuery);
$execute = $prepare->execute(array(
    ":uid" => $_SESSION['user'],
    ":pid" => $_GET['profile_id'],
));

$data = $prepare->fetch(PDO::FETCH_ASSOC);
if ($data === FALSE) {

    $_SESSION['error'] = "Profile Id doesn't Exist";
    header("Location: index.php");
    return;
}

/**
 * Selcet Position Query
 */
$selectQuery = "SELECT * FROM position WHERE profile_id = :pid ORDER BY rank";
$prepare = $pdo->prepare($selectQuery);
$execute = $prepare->execute(array(
    ":pid" => $_GET['profile_id'],
));

$positions = $prepare->fetchAll(PDO::FETCH_ASSOC);

/**
 *  Update Query Sartes Form HEre 
 */
if (
    isset($_POST['id']) &&
    isset($_POST['first_name']) &&
    isset($_POST['last_name']) &&
    isset($_POST['email']) &&
    isset($_POST['headline']) &&
    isset($_POST['summary'])
) {
    $id = $_POST['id'];
    $fn = $_POST['first_name'];
    $ln = $_POST['last_name'];
    $em = $_POST['email'];
    $hl = $_POST['headline'];
    $su = $_POST['summary'];


    $msg = validateProfile();

    if (is_string($msg)) {
        $_SESSION['error'] = $msg;
        header("Location: edit.php?profile_id=" . $_GET['profile_id']);
        return;
    }

    /// update Query
    $updateQuery = "UPDATE profile 
                SET first_name = :fn, last_name = :ln, email = :em, headline = :hl, summary = :su 
                WHERE profile_id = :pid && user_id = :uid";

    /// Prepare Query
    $prepare = $pdo->prepare($updateQuery);

    /// Execute Query
    $execute = $prepare->execute(array(
        ':uid' => $_SESSION['user'],
        ':fn' => $fn,
        ':ln' => $ln,
        ':em' => $em,
        ':hl' => $hl,
        ':su' => $su,
        ':pid' => $id,
    ));

    /// If updateion seccessful then redirect to index.
    if ($execute != false) {

        $msg = validatePos();
        if (is_string($msg)) {
            $_SESSION['error'] = $msg;
            header("Location: edit.php?profile_id=".$_GET['profile_id']);
            return;
        }

        $deleteSql = "DELETE FROM position WHERE profile_id = :pid";
        $prepare = $pdo->prepare($deleteSql);
        $execute = $prepare->execute(array(':pid' => $_GET['profile_id']));

        if ($execute != FALSE) {

            $rank = 1;
            for ($i = 1; $i <= 9; $i++) {
                if (!isset($_POST['year' . $i])) continue;
                if (!isset($_POST['position' . $i])) continue;

                $year = $_POST['year' . $i];
                $post = $_POST['position' . $i];

                $insertSql = "INSERT INTO position (profile_id, rank, year, description) VALUES (:pid, :r, :y, :d)";
                $prepare = $pdo->prepare($insertSql);
                $execute = $prepare->execute(array(
                    ':pid' => $_GET['profile_id'],
                    ':r' => $rank,
                    ':y' => $year,
                    ':d' => $post,
                ));
                $rank++;
            }
        }




        $_SESSION['success'] = " Record edited";
        header("Location: index.php");
        return;
    } else {
        $_SESSION['error'] = "Record Failed to Update";
    }

    header("Location: index.php");
    return;
}
