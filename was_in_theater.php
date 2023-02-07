<?php
    session_start();
?>
<html>
    <head>
        <title>Navigation Bar With Dropdown Menu</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/navbar.css">
    </head>
    <body>
        <div id="ribbon">New Nav Bar</div>  
    
        <div id="container">

            <nav>
                <div id="logo">
                Company
                </div>
                <ul>
                <li><a href="index.php">Home</a></li>
                <li class="dropdown" onmouseover="hover(this);" onmouseout="out(this);"><a href="#">Movies &nbsp;<i class="fa fa-caret-down"></i></a>
                    <div class="dd">
                        <div id="up_arrow"></div>
                        <ul>
                            <li><a href="now_in_theater.php">Now_in_theater</a></li>
                            <li><a href="later_in_theater.php">Later_in_theater</a></li>
                            <li><a href="was_in_theater.php">Movies_you_missed</a></li>
                        </ul>
                    </div>
                </li>
                <li><a href="reserveren.php">reserveren</a></li>
                <li class="dropdown" onmouseover="hover(this);" onmouseout="out(this);"><a href="#">Gallery &nbsp;<i class="fa fa-caret-down"></i></a>
                    <div class="dd">
                        <div id="up_arrow"></div>
                        <ul>
                            <li><a href="login.php">Login</a></li>
                            <li><a href="signup.php">Signup</a></li>
                            <?php
                                require 'admin/includes/classes.inc.php';
                                require 'admin/includes/dbh.inc.php';
                                if(isset($_SESSION["adminid"])) { ?>
                                    <li><a href="account.php">Account</a></li>
                                <?php }
                                include 'admin/fontend/header.php';
                            ?>
                        </ul>
                    </div>
                </li>
            </nav>
        </div>
        <?php 
            $img = $conn->query("SELECT * FROM movies");
            while($row = $img->fetch_assoc()){
                if(strtotime(date('Y-m-d')) > strtotime($row['end_date'])) {?>
                    <td><img src="assets/img/<?php echo $row['cover_img'] ?>" alt="" width="10%" height="30%"></td>
                <?php }
            }
        ?>
    </body>
</html>