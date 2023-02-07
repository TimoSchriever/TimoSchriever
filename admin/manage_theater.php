<?php
    session_start();
    require 'includes/classes.inc.php';
    require 'includes/dbh.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet" />
    <title>hey</title>
    <?php
        if(!isset($_SESSION["admin_id"])) {
            header('location: login.php');
        }
        include './fontend/header.php';
    ?>  
</head>
<body>

    <div class="wrapper">
        <!--Top menu -->
        <div class="sidebar">
           <!--profile image & text-->
           <div class="profile">
                <img src="https://1.bp.blogspot.com/-vhmWFWO2r8U/YLjr2A57toI/AAAAAAAACO4/0GBonlEZPmAiQW4uvkCTm5LvlJVd_-l_wCNcBGAsYHQ/s16000/team-1-2.jpg" alt="profile_picture">
                <h3>Anamika Roy</h3>
                <p>Designer</p>
            </div>
            <!--menu item-->
            <ul>
            <li>
                    <a href="index.php" class="active">
                        <span class="icon"><i class="fas fa-home"></i></span>
                        <span class="item">Home</span>
                    </a>
                </li>
                <li>
                    <a href="movies.php">
                        <span class="icon"><i class="fas fa-desktop"></i></span>
                        <span class="item">Movies</span>
                    </a>
                </li>
                <li>
                    <a href="bookings.php">
                        <span class="icon"><i class="fas fa-user-friends"></i></span>
                        <span class="item">bookings</span>
                    </a>
                </li>
                <li>
                    <a href="manage_movies.php">
                        <span class="icon"><i class="fas fa-tachometer-alt"></i></span>
                        <span class="item">Add movies</span>
                    </a>
                </li>
                <li>
                    <a href="manage_time.php">
                        <span class="icon"><i class="fas fa-database"></i></span>
                        <span class="item">Plan movie</span>
                    </a>
                </li>
                <li>
                    <a href="manage_theater.php">
                        <span class="icon"><i class="fas fa-chart-line"></i></span>
                        <span class="item">Add movie hall</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><i class="fas fa-user-shield"></i></span>
                        <span class="item">Admin</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><i class="fas fa-cog"></i></span>
                        <span class="item">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="includes/logout.inc.php">
                        <span class="icon"><i class="fas fa-cog"></i></span>
                        <span class="item">logout</span>
                    </a>
                </li>
            </ul>
        </div>
        </div>
        <div class="section">
            <div class="top_navbar">
                <div class="hamburger">
                    <a href="#">
                        <i class="fas fa-bars"></i>
                    </a>
                </div>
            </div>

        </div>

    </div>
    <script>
        var hamburger = document.querySelector(".hamburger");
            hamburger.addEventListener("click", function(){
            document.querySelector("body").classList.toggle("active");
        })
    </script>
</body>
</html>