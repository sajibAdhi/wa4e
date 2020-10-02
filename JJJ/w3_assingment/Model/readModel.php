<?php
    require_once "baseController.php";

    $selectSql = "SELECT profile_id, first_name, last_name, headline FROM profile";
    
    $datas = $pdo->query($selectSql);
?>