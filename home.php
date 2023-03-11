<?php include 'admin/db_connect.php' ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Queuing System</title>
	<link rel="stylesheet" href="admin/SDK.css">

	<!-- ionicon link for icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	
	<!-- google font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Mulish:wght@600;700;900&family=Quicksand:wght@400;500;600;700&display=swap"
		rel="stylesheet">
                    

					

</head>


<body> 

<header class="row container">
      <a href="#" class="logo row">
	  	<img src="assets/PUP-Logo.png" id="logo" alt="puplogo">
        <h1>PUPQS</h1>
      </a>

     
      <div class="toggleMenu" onclick="toggleMenu();"></div>

      <nav class="navigation row">
        <ul class="row">
          <li><a href="#">Home</a></li>
          <li><a href="#">Admin</a></li>
          <li><button class="btn btn-outline">Register</button></li>
        </ul>
      </nav>

    </header>

<main>
    <!--picture display -->
	<section class="display">
          
		<img class="img-fluid" src="./assets/banner.png" alt="PUP Banner">
	   
	</section>


		<div class="select-transaction">

		<h2 class="">Select Transaction Queue</h2>

		<p class="transact-text">
  		Select a transaction queue serving display.
		</p>

		</div>
			
			<div class="landing-grid">
			
				<?php 
					$trans = $conn->query("SELECT * FROM transactions where status = 1 order by name asc");
						while($row=$trans->fetch_assoc()):
					?>
					<a href="index.php?page=display&id=<?php echo $row['id'] ?>"><?php echo ucwords($row['name']); ?> </a>
				<?php endwhile; ?>

				
			</div>
			

            
    </section>
</main>

<script>

'use strict';

/**navbar variables keme**/
 

const navToggleBtn = document.querySelector("[data-nav-toggle-btn]");
const header = document.querySelector("[data-header]");

navToggleBtn.addEventListener("click", function () {
  header.classList.toggle("active");
});

</script>




</body>
</html>


