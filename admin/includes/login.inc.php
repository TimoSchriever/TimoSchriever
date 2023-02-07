<?php 
    if(isset($_POST["submit-login"])) {

        $username_admin = $_POST["uid"];
        $pwd_admin = $_POST["pwd"];

        require_once 'dbh.inc.php';
        require_once 'classes.inc.php';

        if(empty_input_admin($username_admin, $pwd_admin) !== false) {
            header("location: ../dist/signup.php?error=emptyinput");
            exit();
        }

        login_admin($conn, $username_admin, $pwd_admin);

    }else {
        header("location: ../login.php");
        exit();
    }
?>