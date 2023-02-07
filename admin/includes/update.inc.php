<?php
require_once 'dbh.inc.php';
$id = $_GET['updateid'];
if(isset($_POST['update_movies'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $duration_hour = $_POST['duration_hour'];
    $duration_min = $_POST['duration_min'];
    $first_air = $_POST['first_air'];
    $genre = $_POST['genre'];
    $last_air = $_POST['last_air'];
    $image = $_FILES['cover']['name'];

    $duration = ($duration_hour * 60 ) + $duration_min;

    $sql = "UPDATE movies SET id=$id, title='$title', cover_img='$image' ,description='$description', duration='$duration', date_showing='$first_air', end_date='$last_air', movies_genre_id='$genre' WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    
    if($result) {
        header("location: ../movies.php?succesfullyUpdated");
        exit();
    }else {
        header("location: delete.php?oke");
        die(mysqli_error($conn));
    }
}
?>