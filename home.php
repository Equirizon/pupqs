<?php include 'admin/db_connect.php' ?>
	
<div>
	<h3><b>Welcome to Transaction Queuing Management System</b></h3>
</div>

<div>
	<div>
		<a href="admin/login.php">Admin</a>
		<a href="index.php?page=queue_registration">Register</a>
	</div>

	<h4>Select Transaction Queue</h4>

	<h4>Select a transaction queue serving display</h4>

	<div>
		<?php 
		$trans = $conn->query("SELECT * FROM transactions where status = 1 order by name asc");
			while($row=$trans->fetch_assoc()):
		?>
		<div class="col-md-4 mt-4">
		<a href="index.php?page=display&id=<?php echo $row['id'] ?>"><?php echo ucwords($row['name']); ?> </a>
	<?php endwhile; ?>
	</div>
</div>


