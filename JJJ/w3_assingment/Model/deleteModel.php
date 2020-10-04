<?php require_once "baseModel.php";
if (!isset($_SESSION['name'])) {
    die("Not logged in.");
}

if (!isset($_GET['profile_id'])) {

    $_SESSION['error'] = "Missing user id";
    header("Location: index.php");
    return;
}

$selectQuery = "SELECT profile_id, first_name FROM profile WHERE profile_id = :xyz && user_id = :uid";
$prepare = $pdo->prepare($selectQuery);

$execute = $prepare->execute(array(
    ":xyz" => $_GET['profile_id'],
    ":uid" => $_SESSION['user'],
));

if ($execute === FALSE) {

    $_SESSION['error'] = "Bad Value For Profiles Id";
    header("Location: index.php");
    return;
} else {

    $data = $prepare->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['delete']) && isset($_POST['id'])) {

    $deleteSql = "DELETE FROM profile where profile_id = :pid && user_id = :uid";
    $prepare = $pdo->prepare($deleteSql);

    $execute = $prepare->execute(array(
        ':pid' => $_POST['id'],
        ':uid' => $_SESSION['user'],
    ));

    if ($execute !== FALSE) {

        $deleteSql = "DELETE FROM position WHERE profile_id = :pid";
        $prepare = $pdo->prepare($deleteSql);
        $execute = $prepare->execute(array(':pid' => $_GET['profile_id']));
        if($execute != FALSE){
            $_SESSION['success'] = " Record deleted";
            header("Location: index.php");
            return;
        }
        
    } else {
        $_SESSION['error'] = "Failed to  Delete Record";
        header("Location: index.php");
        return;
        
    }
}
?>
