<?php include 'admin/db_connect.php' ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Queuing System</title>
	<link rel="stylesheet" href="admin/SDK.css">
</head>
<body> 
	<header>
		<div class="header-div">
			<div>
				<img src="assets/PUP-Logo.png" id="logo" alt="puplogo">
				<span>PUPQS</span>
			</div>
			<nav id="navbar-links">
				<a href="admin/login.php">Admin</a>
				<a href="index.php?page=queue_registration">Register</a>
			</nav>
		</div>
	<header>
	<div class="main-content">
		<div>
			<h1><b>Welcome to Transaction Queuing Management System</b></h1>
		</div>
		
		<div>
		
			<h4>Select Transaction Queue</h4>
		
			<h4>Select a transaction queue serving display.</h4>
		
			<div class="landing-grid">
				<?php 
					$trans = $conn->query("SELECT * FROM transactions where status = 1 order by name asc");
						while($row=$trans->fetch_assoc()):
					?>
					<a href="index.php?page=display&id=<?php echo $row['id'] ?>"><?php echo ucwords($row['name']); ?> </a>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
</body>
</html>
