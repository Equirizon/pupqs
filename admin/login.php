<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin | Transaction Queuing System</title>
 	
<?php include('./db_connect.php'); ?>
<?php 
session_start();
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>
	<div>
		<form id="login-form">
			<div>
				<label for="username">Username</label>
				<input type="text" id="username" name="username">
			</div>
			<div>
				<label for="password">Password</label>
				<input type="password" id="password" name="password">
			</div>
			<button>Login</button>
		</form>
	</div>
</body>
<script>
	$('#login-form').submit(function(e){
		e.preventDefault()
		$.ajax({
			url:'ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
			},
			success:function(resp){
				if(resp == 1){
					location.href ='index.php?page=home';
				}else{
					alert("Username or password is incorrect")
				}
			}
		})
	})
</script>	
</html>