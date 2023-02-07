<?php
    session_start();
    require_once 'dbh.inc.php';
    require_once 'classes.inc.php';

    // creates a new movie in admin
    if(isset($_POST['submit_movies'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $duration_hour = $_POST['duration_hour'];
        $duration_min = $_POST['duration_min'];
        $first_air = $_POST['first_air'];
        $genre = $_POST['genre'];
        $last_air = $_POST['last_air'];
        $image = $_FILES['cover']['name'];

        $duration = ($duration_hour * 60 ) + $duration_min;

        save_movie($conn, $title, $description, $duration, $first_air, $last_air, $genre, $image);
    }
    
    // creating a new time for movies in admin
    if(isset($_POST['submit_time'])){
        $title = $_POST['title'];
        $date_showing = $_POST['date'];
        $time_showing = $_POST['time'];
        $cinema_hall = $_POST['hall'];

        save_time($conn, $title, $date_showing, $time_showing, $cinema_hall);
    }
    
    // This sends the reservation data to classes.inc.php
    if(isset($_POST['reservation_submit'])){
        $id = $_GET['user'];
        $movies = $_POST['movies'];
        $date = $_POST['date'];
        $quantity = $_POST['quantity'];

        if(empty($id)) {
            header("location: ../../reserveren.php?loginfirst");
        }

        save_reservation($conn, $id, $movies, $date, $quantity);
    }

    // this is for creating a new user account
    if(isset($_POST['signup_submit'])){
        $name_user = $_POST['name'];
        $email_user = $_POST['email'];
        $username_user = $_POST['username'];
        $pwd_user = $_POST['pwd'];
        $pwd_user_repeat = $_POST['pwdrepeat'];

        if(empty_input_user($username_user, $pwd_user) !== false) {
            header("location: ../../signup.php?emptyInput");
            exit();
        }elseif(invalid_user_username($username_user) !== false) {
            header("location: ../../signup.php?invalidUsername");
            exit();
        }elseif(invalid_user_email($email_user) !== false) {
            header("location: ../../signup.php?invalidEmail");
            exit();
        }elseif(invalid_user_pwd($pwd_user, $pwd_user_repeat) !== false) {
            header("location: ../../signup.php?passwordsdontmatch");
            exit();
        }elseif(uid_user_exists($conn, $username_user, $email_user) !== false) {
            header("location: ../../signup.php?usernametaken");
            exit(); 
        }

        create_user($conn, $name_user, $email_user, $username_user, $pwd_user);
    }

    // This is for loggin in the user
    if(isset($_POST['login_submit'])){
        $username_user = $_POST['username'];
        $pwd_user = $_POST['password'];

        login_user($conn, $username_user, $pwd_user);
    }
?>