<?php
require_once "baseModel.php";

/// Insertion
if (
    isset($_POST['first_name']) &&
    isset($_POST['last_name']) &&
    isset($_POST['email']) &&
    isset($_POST['headline']) &&
    isset($_POST['summary'])
) {

    $fn = $_POST['first_name'];
    $ln = $_POST['last_name'];
    $em = $_POST['email'];
    $hl = $_POST['headline'];
    $su = $_POST['summary'];

    $msg = validateProfile();

    if (is_string($msg)) {
        $_SESSION['error'] = $msg;
        header("Location: add.php");
        return;
    }

    /// Insert Query
    $prepare = $pdo->prepare('INSERT INTO Profile (user_id, first_name, last_name, email, headline, summary)
                    VALUES ( :uid, :fn, :ln, :em, :he, :su)');

    /// Execute Query
    $success = $prepare->execute(array(
        ':uid' => $_SESSION['user'],
        ':fn' => $fn,
        ':ln' => $ln,
        ':em' => $em,
        ':he' => $hl,
        ':su' => $su
    ));

    /// If DATA Insertion seccessful then incert Position
    if ($success != false) {

        $profile_id = $pdo->lastInsertId();
        $rank = 1;
        for($i=1; $i<=9; $i++){
            if( !isset($_POST['year'.$i])) continue;
            if( !isset($_POST['position'.$i])) continue;

            $year = $_POST['year'.$i];
            $post = $_POST['position'.$i];

            $insertSql = "INSERT INTO position (profile_id, rank, year, description) VALUES (:pid, :r, :y, :d)";
            $prepare = $pdo->prepare($insertSql);
            $execute = $prepare->execute(array(
                ':pid' => $profile_id,
                ':r' => $rank,
                ':y' => $year,
                ':d' => $post,
            ));

            $rank++;
        }

        $_SESSION['success'] = " Record added";
        header("Location: index.php");
        return;
    } else {

        $_SESSION['error'] = "Record Inserted Failed";
    }


    header("Location: add.php");
    return;
}
