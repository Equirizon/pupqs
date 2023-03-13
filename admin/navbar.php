<div class="sidebar">

        <a href="#" class="active">
          <span class="material-symbols-outlined">dashboard</span>
          <h3>Dashboard</h3>
        </a>

        <a href="#">
          <span class="material-symbols-outlined">receipt_long</span>
          <h3>Transactions</h3>
        </a>

        <a href="#">
          <span class="material-symbols-outlined">window</span>
          <h3>Windows</h3>
        </a>


        <a href="#">
          <span class="material-symbols-outlined">group</span>
          <h3>Users</h3>
        </a>

        <a href="#">
          <span class="material-symbols-outlined">logout</span>
          <h3>Log Out</h3>
        </a>

      </div>
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
