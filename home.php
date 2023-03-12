<?php include 'admin/db_connect.php' ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Transaction Queuing System</title>

	<link rel="stylesheet" href="admin/SDK.css">

	<script>

        'use strict';
        /**navbar variables keme**/
        const navToggleBtn = document.querySelector("[data-nav-toggle-btn]");
        const header = document.querySelector("[data-header]");
        navToggleBtn.addEventListener("click", function () {
        header.classList.toggle("active");
        });

        const navToggleBtn = document.querySelector("[data-nav-toggle-btn]");
        const header = document.querySelector("[data-header]");
        navToggleBtn.addEventListener("click", function () {
        header.classList.toggle("active");
        });

        function register(){
            window.location = "index.php?page=queue_registration";
        }

	</script>

	<!-- ionicon link for icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	
	<!-- google font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Mulish:wght@600;700;900&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body> 
    <div class="header-blur"></div>
    <div class="header">
        <header class="landing-header">
            <a href="#" class="logo landing-header">
                <img src="assets/PUP-Logo.png" id="logo" alt="puplogo">
                <h1>PUP<b>QS</b></h1>
            </a>
            <div class="toggleMenu" onclick="toggleMenu();"></div>
            <nav class="navigation landing-header">
                <ul class="landing-header">
                <li><a href="#">Home</a></li>
                <li><a href="admin/login.php">Admin</a></li>
                <li><button onclick="register()" class="btn btn-outline">Register</button></li>
                </ul>
            </nav>
        </header>
    </div>
	<main>
        <div class="feature-container">

            <div class="backdrop"></div>

            <video loop autoplay muted>
                <source src="assets\The Polytechnic University of the Philippines-BG.mp4">
            </video> 

            <div class="center-text">
                <h3>PUPQS</h3>
                <h1>PUP QUEUING SYSTEM</h1>
                <h4>Mula sa Iyo, para sa Bayan</h4>
            </div>
            
        </div>

        <div class="landing-grid">
    
            <h2>Select Transaction Queue</h2>
            <h4>Select a transaction queue serving display.</h4>

            <?php 
                $trans = $conn->query("SELECT * FROM transactions where status = 1 order by name asc");
                while($row=$trans->fetch_assoc()):
            ?>

            <a href="index.php?page=display&id=<?php echo $row['id'] ?>">
                <div>
                    <img src="assets/PUP-Star.png">
                    <img src="assets/PUP-Star-0.png">
                </div>
                <span><?php echo ucwords($row['name']); ?></span>
                <br>
                <span><?php echo ucwords($row['department']); ?></span>
            </a>
            
            <?php endwhile; ?>
            
        </div>
	</main>
</body>
</html>


