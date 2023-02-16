<?php session_start();?>
<html>
    <head>
        <?php require_once "admin/includes/dbh.inc.php";?>
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
        <section>
            <?php ?>
            <form method="post" action="admin/includes/manage.inc.php?user=<?php if(!isset($_SESSION["user_id"])) { echo "login first"; exit();} echo $_SESSION["user_id"];?>">
                <h1>Reservation</h1><br>
                <hr>
                <select name="movies" required>
                    <option value="origin"> Choose a movie </option>
                    <?php
                        $movie = $conn->query("SELECT * FROM movies");
                        while($row = $movie->fetch_assoc()) { ?>
                            <option value='<?php $id = $row['id']; echo $id?>'><?php echo $row['title']; ?></option>
                        <?php }
                    ?>
                </select>
                <select name="date">
                    <option value="month of travel">Date movie</option>
                    <?php 
                        $date = $conn->query("SELECT * FROM time");
                        while($rowDate = $date->fetch_assoc()){?>
                            <option value='<?php echo $rowDate['time_id']?>'><?php echo $rowDate['show_date'] . " " . $rowDate['show_time']; ?></option>
                        <?php }
                    ?>
                </select>
                <br>
                <input type="number" id="quantity" name="quantity" min="1" max="120">
                <br>
                <input type="submit" name="reservation_submit" value="Get A Call">
                <input type="reset" name="clear" value="Clear">
            </form>
        </section>
    </body>
</html>
<script>
    console.log("dffdas");
</script>