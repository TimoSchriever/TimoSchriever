<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hey</title>
    <?php
        require 'includes/classes.inc.php';
        require 'includes/dbh.inc.php';
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
        <section class="section-right">
            <div class="row">
                <div class="col-md-12">
                    <a href="manage_movies.php"><button class="btn btn-block btn-sm btn-primary col-sm-2" type="button" id="new_movie"><i class="fa fa-plus"></i> New Movie</button></a>
                </div>
            </div>
            <table>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Cover</th>
                <th class="text-center">Title</th>
                <th class="text-center">Status</th>
                <th class="text-center">Action</th>
            </tr>
            <?php
                $i = 1;
                $movie = $conn->query("SELECT * FROM movies");
                while($row=$movie->fetch_assoc()){
            ?>
            <tr>
            <td><?php echo $row['id']; ?></td>
            <td><center><img src="../assets/img/<?php echo $row['cover_img'] ?>" alt="" width="50" height="75"></center></td>
            <td><?php echo ucwords($row['title']) ?></td>
            <?php if(strtotime(date('Y-m-d')) < strtotime($row['date_showing'])): ?>
            <td>Pending</td>
            <?php elseif(strtotime(date('Y-m-d')) > strtotime($row['date_showing']) &&  strtotime(date('Y-m-d')) < strtotime($row['end_date'])): ?>
            <td>Showing</td>

            <?php else: ?>
            <td>Ended</td>

            <?php endif; ?>
            <td>
                <button class="btn btn-primary"><a href="update.php?updateid=<?php echo $row['id'];?>" class="text-light">Update</a></button>
                <button class="btn btn-danger"><a href="includes/delete.inc.php?deleteid=<?php echo $row['id'];?>" class="text-light">Delete</a></button>
            </td>
            </tr>
            <?php } ?>
        </section>
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