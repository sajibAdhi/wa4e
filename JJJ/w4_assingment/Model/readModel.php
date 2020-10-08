<?php require_once "baseModel.php";

    function allProfileList($pdo){
        $selectSql = "SELECT profile_id, first_name, last_name, headline FROM profile";
        return $pdo->query($selectSql);
    }
    
    function getSingleProfile($pdo, $id){
        $selectSql = "SELECT * FROM profile WHERE profile_id = :id";
        $prepare = $pdo->prepare($selectSql);
        $execute = $prepare->execute(array( ':id' => $id));

        if($execute === TRUE){
            return $prepare->fetch(PDO::FETCH_ASSOC);
        } else {
            $_SESSION['error'] = "Profile Not Found";
            header("Location: index.php");
            return;
        }
    }

    function loadPos($pdo, $id){
        $selectSql = "SELECT * FROM position WHERE profile_id = :id ORDER BY rank";
        $prepare = $pdo->prepare($selectSql);
        $execute = $prepare->execute(array( ':id' => $id));
        if($execute == TRUE){
            return $prepare->fetchAll(PDO::FETCH_ASSOC);
        }else {
            return FALSE;
        }
    }
    
?>