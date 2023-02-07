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
            if(isset($_SESSION["user_username"])) {
                echo "<b>Your name is:</b> " . ucfirst($_SESSION["user_username"]);
                echo "<br>";
            }
            if(isset($_SESSION["user_id"])) {
                $id = $_SESSION["user_id"];
                $account = $conn->query("SELECT * FROM bookings WHERE bookings_account_id = $id");
                while($row = $account->fetch_assoc()) {
                    $movie_id = $row["bookings_movie_id"];
                    $date_id = $row["bookings_time_id"];

                    echo "<center><br> New movie: <br></center>";

                    $movie = $conn->query("SELECT * FROM movies WHERE id = $movie_id");
                    while($row = $movie->fetch_assoc()) {
                        echo "<center><b>You bought a ticket for:</b> " . ucfirst($row['title'] . "</center>");
                        echo "<br>";
                    }

                    $date = $conn->query("SELECT * FROM time WHERE time_id = $date_id");
                    while($row = $date->fetch_assoc()) {
                        echo "<center><b>date of movie:</b> " . $row['show_date'] . "</center>";
                        echo "<br>";
                        echo "<center><b>time:</b> " . $row['show_time'] . "</center>";
                        echo "<br>";
                    }

                    $quantity = $conn->query("SELECT * FROM bookings WHERE bookings_id = $id");
                    while($row = $quantity->fetch_assoc()) {
                        $number = $row["bookings_number"];
                        echo "<center><b>Number of orders:</b> " . $number . "</center>";
                        echo "<br>";
                        $cost = 12 * $number;
                        echo "<center><b>cost:</b> " . "$" . $cost . "</center>";
                    }
                    echo "<br>";
                }
            }
        ?>
  </body>
</html>