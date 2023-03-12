<nav>
	<div>
		<?php if($_SESSION['login_type'] == 1): ?>
		<a href="index.php?page=home">Home</a>
		<a href="index.php?page=transactions">Transaction List</a>	
		<a href="index.php?page=windows">Window List</a>	
		<a href="index.php?page=users">Users</a>
		<?php else: ?>
			<a href="index.php?page=home">Dashboard</a>
			<a href="index.php?page=queue">Queue</a>		
		<?php endif; ?>
	</div>
</nav>
<script>
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
