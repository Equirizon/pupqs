<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link rel="stylesheet" href="admin/SDK.css">
  <title>Transaction Queuing System</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
                <li><a href="index.php?page=home">Home</a></li>
                <li><a href="index.php?page=login">Admin</a></li>
                <li><button onclick="register()" class="btn btn-outline">Register</button></li>
                </ul>
            </nav>
        </header>
    </div>
  <main>
      
  	 <?php $page = isset($_GET['page']) ? $_GET['page'] :'home'; ?>
    <?php include $page.'.php' ?>

  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
</html>
<script>
        function register(){
            window.location = "index.php?page=queue_registration";
        }

	</script>