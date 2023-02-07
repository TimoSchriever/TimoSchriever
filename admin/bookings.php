<?php session_start();?>
<style>
	td img{
		width: 50px;
		height: 75px;
		margin:auto;
	}
	td p {
		margin: 0
	}
</style>
<?php
	require 'includes/classes.inc.php';
	require 'includes/dbh.inc.php';
	if(!isset($_SESSION["admin_id"])) {
		header('location: login.php');
	}
	include './fontend/header.php';
?>
<div class="container-fluid">
	<div class="row">
		<div class="card col-md-12 mt-3">
			<div class="card-body">
				<button><a href="index.php">go back to index</a></button>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Name</th>
							<th class="text-center">Contact #</th>
							<th class="text-center">Movie</th>
							<th class="text-center">Reserved Info</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						$bookings = $conn->query("SELECT * FROM bookings");
						while($row=$bookings->fetch_assoc()){
							$movie_id = $row['bookings_movie_id'];
							$account_id = $row['bookings_account_id'];
							$time_id = $row['bookings_time_id'];
							$quantity = $row['bookings_number'];
						 ?>
						 <tr>
						 	<td><?php echo $i++ ?></td>
						 	<td><?php $name = $conn->query("SELECT * FROM accounts WHERE account_id = $account_id");
								while($row_name = $name->fetch_assoc()) {
									echo $row_name['account_name'];
								}
							?></td>
						 	<td><?php $name = $conn->query("SELECT * FROM accounts WHERE account_id = $account_id");
								while($row_name = $name->fetch_assoc()) {
									echo $row_name['account_email'];
								}
							?></td>
						 	<td><?php $movie = $conn->query("SELECT * FROM movies WHERE id = $movie_id");
								while($row_movie = $movie->fetch_assoc()) {
									echo $row_movie['title'];
								}
							?></td>
								<td>							
									<p><small><b>qty:</b> <?php echo $quantity ?></small></p>
									<p><small><b>Date:</b> <?php $date = $conn->query("SELECT * FROM time WHERE time_id = $time_id");
										while($row_time = $date->fetch_assoc()) {
											echo $row_time['show_date'];
										}
									?></small></p>
																		<p><small><b>Time:</b> <?php $date = $conn->query("SELECT * FROM time WHERE time_id = $time_id");
										while($row_time = $date->fetch_assoc()) {
											$hall_id = $row_time['hall_id'];
											echo $row_time['show_time'];
										}
									?></small></p>
									<p><small><b>Hall:</b> <?php $hall = $conn->query("SELECT * FROM movie_hall WHERE id = $hall_id");
										while($row_hall = $hall->fetch_assoc()) {
											echo $row_hall['hall_name'];
										}
									?></small></p>
								<td>
						 	</td> 	
						 	
						 </tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<script>
	$('table').dataTable();
	$('#new_movie').click(function(){
		uni_modal('New Movie','manage_movie.php');
	})
	$('.edit_movie').click(function(){
		uni_modal('Edit Movie','manage_movie.php?id='+$(this).attr('data-id'));
	})
	$('.delete_movie').click(function(){
		_conf('Are you sure to delete this data?','delete_movie' , [$(this).attr('data-id')])
	})

	function delete_movie($id=''){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_movie',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp ==1){
					alert_toast("Data successfully deleted",'success');
					setTimeout(function(){
						location.reload()
					},1500)
				}
			}
		})
	}
</script>