<?php
    include 'database.php';
    session_start();

    $delete_stmt=$objPdo->prepare('DELETE FROM `blacklist` WHERE id=?');
    $delete_stmt->bindValue(1, $_GET['id'], PDO::PARAM_INT);
    $delete_stmt->execute(); 

    header('location:blacklist.php');

?>