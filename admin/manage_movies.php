<?php
    session_start();
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
        require 'includes/classes.inc.php';
        require 'includes/dbh.inc.php';
        if(!isset($_SESSION["admin_id"])) {
            header('location: login.php');
        }
        if(isset($_GET['id'])){
            $mov = $conn->query("SELECT * FROM movies where id =".$_GET['id']);
            foreach($mov->fetch_array() as $k => $v){
                $meta[$k] = $v;
                if($k == 'duration' && !is_numeric($k)){
                    $v = explode('.',$v);
                    $meta['duration_hour'] = $v[0];
                    $v[1] = isset($v[1]) ? $v[1] : 0;
                     $meta['duration_min'] = 60 * ('.'.$v[1]);
        
                }
            }
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
    <div class="container_fluid" style="margin-top: 100px; margin-left: 700px;margin-right: 700px; width: 500px;">
        <div class="col-lg-12">
            <form id="manage-movie" action="includes/manage.inc.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
                    <label for="" class="control-label">Movie Title</label>
                    <br>
                    <input type="text" name="title" required="" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Description</label>
                    <br>
                    <textarea name="description" class="form-control" id="" cols="30" rows="3" required></textarea>
                </div>
                <div class="form-group row">
                    <label for="" class="control-label col-md-12">Duration</label>
                    <br>
                    <input type="number" name="duration_hour" required="" class="form-control col-sm-2 offset-md-1 " value="" max="12" min="0" placeholder="Hour">:
                    <input type="number" name="duration_min" required="" class="form-control col-sm-2 "  max="59" min="0" value="" placeholder="Min">
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Showing Schedule</label>
                    <br>
                    <input name="first_air" id="" type="date" class="form-control" value="" required>
                </div>
                <div class="form-group">
                    <label for="" class="control-label">End Date</label>
                    <br>
                    <input name="last_air" id="" type="date" class="form-control" value="" required>
                </div>
                <div class="form-group">
                    <label for="" class="control-label">genre</label>
                    <br>
                    <select name="genre" id="">
                        <option value="">Kies</option>
                        <?php 
                            $genre2 = $conn->query("SELECT * FROM genre");
                            while($row=$genre2->fetch_assoc()): ?>
                                <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                            <?php endwhile;
                        ?>
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <img src="../../assets/img/" alt="" id="cover_img" width="50" height="75">
                </div>
                <div class="form-group input-group">
                    <label for="" class="control-label">Cover Image</label>
                    <br>
                    <div class="input-group-prepend">
                        <span class="input-group-text">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" name="cover" class="custom-file-input">
                        <label class="custom-file-label" for="cover-img">Choose file</label>
                    </div>
                </div>
                <div>
                    <button name="submit_movies">hello</button>
                    <a href="movies.php"><button class="btn btn-block btn-sm btn-primary col-sm-2" type="button" id="new_movie"><i class="fa fa-plus"></i> Cancel New Movie</button></a>
                </div>
            </form>
        </div>            
    </div>
</html>