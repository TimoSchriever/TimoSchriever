<?php
    // login in admin
    function uid_admin_exists($conn, $username_admin) {

        $sql = "SELECT * FROM adminuser WHERE adminUid = ?;";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../login.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $username_admin);
        mysqli_stmt_execute($stmt);
    
        $resultData = mysqli_stmt_get_result($stmt);
    
        if($row = mysqli_fetch_assoc($resultData)) {
    
            return $row;
    
        }else {
    
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);
    }

    function empty_input_admin($username_admin, $pwd_admin) {
        if(empty($username_admin) || empty($pwd_admin)){
            $result = true;
        }else {
            $result = false;
        }
        return $result;
    }
    
    function login_admin($conn, $username_admin, $pwd_admin) {

        $uid_admin_exists = uid_admin_exists($conn, $username_admin, $username_admin);

        if($uid_admin_exists === false) {
            header("location: ../login.php?error=wronglogin");
            exit();
        }
        
        $pwdHashed = $uid_admin_exists["adminPassword"];
        $checkPwd = password_verify($pwd_admin, $pwdHashed);

        if($checkPwd === false){
            header("location: ../login.php?error=wronglogin");
            exit();
        }elseif($checkPwd === true) {
            session_start();
            $_SESSION["admin_id"] = $uid_admin_exists["adminId"];
            $_SESSION["admin_name"] = $uid_admin_exists["adminName"];
            $id = $_SESSION["admin_id"];
            header("location: ../index.php?id=$id");
            exit();
        }
    }

    // creating an user account
    function uid_user_exists($conn, $username_user, $email_user) {

        $sql = "SELECT * FROM accounts WHERE account_username = ? OR account_email = ?;";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../login.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $username_user, $email_user);
        mysqli_stmt_execute($stmt);
    
        $resultData = mysqli_stmt_get_result($stmt);
    
        if($row = mysqli_fetch_assoc($resultData)) {
    
            return $row;
    
        }else {
    
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);
    }

    function empty_input_user($username_user, $pwd_user) {
        if(empty($username_user) || empty($pwd_user)){
            $result = true;
        }else {
            $result = false;
        }
        return $result;
    }

    
    function invalid_user_username($username_user) {
        if(!preg_match ('/[a-zA-Z0-9 ]/', $username_user)) {
            $result = true;   
        }else {
            $result = false;
        }
        return $result;
    }

    function invalid_user_email($email_user) {
        if(!filter_var($email_user, FILTER_VALIDATE_EMAIL)) {
            $result = true; 
        }else {
            $result = false;
        }
        return $result;
    }

    function invalid_user_pwd($pwd_user, $pwd_user_repeat) {

        if($pwd_user !== $pwd_user_repeat) {

            $result = true; 

        }else {

            $result = false;
        }

        return $result;
    }

    function create_user($conn, $name_user, $email_user, $username_user, $pwd_user) {
        $sql = "INSERT INTO accounts(account_name, account_email, account_username, account_password) VALUES (?, ?, ?, ?)";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }

        $hashedPwd = password_hash($pwd_user, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "ssss", $name_user, $email_user, $username_user, $hashedPwd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../../signup.php?error=none");
        exit();
    }

    // login user
    function empty_input_user_login($username_user, $pwd_user) {
        if(empty($username_user) || empty($pwd_user)){
            $result = true;
        }else {
            $result = false;
        }
        return $result;
    }
    
    function login_user($conn, $username_user, $pwd_user) {

        $uid_user_exists = uid_user_exists($conn, $username_user, $username_user);
        if($uid_user_exists === false) {
            header("location: ../../login.php?error=wronglogin");
            exit();
        }
        
        $pwdHashed = $uid_user_exists["account_password"];
        $checkPwd = password_verify($pwd_user, $pwdHashed);

        if($checkPwd === false){
            header("location: ../../login.php?error=wonglogin");
            exit();
        }elseif($checkPwd === true) {
            session_start();
            $_SESSION["user_id"] = $uid_user_exists["account_id"];
            $_SESSION["user_username"] = $uid_user_exists["account_username"];
            header("location: ../../index.php");
            exit();
        }
    }

    // to save a new movie in theater
    function save_movie($conn, $title, $description, $duration, $first_air, $last_air, $genre, $image){
        // exit();
        $sql = "INSERT INTO movies(title, cover_img, description, duration, date_showing, end_date,  movies_genre_id ) 
                VALUES            (?,     ?,           ?,          ?,            ?,         ?,        ?)";
        
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../manage_movies?error=stmtfailed");
            exit();
        }
      
        mysqli_stmt_bind_param($stmt, "sssissi", $title, $image, $description, $duration, $first_air, $last_air, $genre);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt); 

        header("location: ../movies.php?error=none");
        exit();

    }
    
    function save_time($conn, $title, $date_showing, $time_showing, $cinema_hall) {
        $sql = "INSERT INTO time(time_movie_id, show_time, show_date, hall_id) 
        VALUES            (         ?,           ?,           ?,          ?)";
        
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../manage_movies?error=stmtfailed");
            exit();
        }
      
        mysqli_stmt_bind_param($stmt, "ssss", $title, $time_showing, $date_showing, $cinema_hall);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt); 

        header("location: ../manage_time.php");
        exit();
    }
    function save_reservation($conn, $id, $movies, $date, $quantity) {
        $sql = "INSERT INTO bookings(bookings_movie_id, bookings_account_id, bookings_number, bookings_time_id) 
                    VALUES           (?,                     ?,                  ?,                ?)";
        $stmt = mysqli_stmt_init($conn); 

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../manage_movies?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ssss", $movies, $id, $quantity, $date);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $_SESSION["movie_id"] = $movies;
        $_SESSION["quantity"] = $quantity;
        $_SESSION["date_id"] = $date;

        header("location: ../../reserveren.php");
        exit();
    }
?>