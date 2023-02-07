<?php 
require_once 'dbh.inc.php';

if(isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    $sql = "DELETE FROM movies WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    
    if($result) {
        header("location: ../movies.php?succesfullydeleted");
        exit();
    }else {
        header("location: delete.php?oke");
        die(mysqli_error($conn));
    }

}

?>