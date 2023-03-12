<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin | Transaction Queuing System</title>
 	
    <?php include('admin/db_connect.php'); ?>

    <?php 
    // session_start();
    // if(isset($_SESSION['login_id']))
    // header("location:admin/index.php?page=home");
    ?>

    <link rel="stylesheet" href="admin/SDK.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body class="login-body">

<div class="display-background">
        <img src="assets/banner3.jpg" alt="bg">
</div>

    <!-- <a href="index.php?page=home">← Back to Homepage</a> -->

    <div class="login-container">
        <div>    
            <h1> Admin </h1>
        </div>
        <div class="login-form">
            <form id="login-form">
                <label for="username">Username</label>
                <input type="text" id="username" name="username">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
                <button>Login</button>
            </form>
        </div>
    </div>
</body>
<script>
	$('#login-form').submit(function(e){
		e.preventDefault()
		$.ajax({
			url:'admin/ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
			},
			success:function(resp){
				if(resp == 1){
					location.href ='admin/index.php?page=home';
				}else{
					alert("Username or password is incorrect")
				}
			}
		})
	})
</script>	
</html>