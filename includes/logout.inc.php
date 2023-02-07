<?php 
    session_start();
    session_destroy();
    unset($_SESSION["admin_id"]);
    $id = $_SESSION["admin_id"];
    header("location: ../index.php?session=$id");
?>