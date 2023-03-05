<?php include 'admin/db_connect.php' ?>
<div class="container">
	<div class="col-lg-12">
		<div class="card border-light">
			<div class="card-img-overlay">
				<a href="index.php?page=queue_registration" class="btn float-right" style="background-color:white;height:35px">Register</a>
				<a href="admin/login.php" class="btn" style="color:white;height:35px">Admin</a>
  			</div>

			<img src="assets/red.png" class="card-img-top">
		</div>
		<div class="card border-light mt-3" style="background-color: #FAFBFC;">
			<div class="card-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
						<h4><b>Select Transaction Queue</b></h4>
						</div>
					</div>
					<h6>Select Transaction Queue Serving Display</h6>
					<div class="row">

						<?php 
						$trans = $conn->query("SELECT * FROM transactions where status = 1 order by name asc");
							while($row=$trans->fetch_assoc()):
						?>
						<div class="col-md-4 mt-4">
						
						<a href="index.php?page=display&id=<?php echo $row['id'] ?>" class="btn d-flex justify-content-start" style="background-color:white"><img class="mr-3" src="assets/puplogo.png"><p class="align-self-center mt-2"><?php echo ucwords($row['name']); ?></p></a>
						</div>
					<?php endwhile; ?>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>