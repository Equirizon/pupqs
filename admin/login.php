<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin | Transaction Queuing System</title>
 	

<?php include('./header.php'); ?>
<?php include('./db_connect.php'); ?>
<?php 
session_start();
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>

</head>
<style>
	body{
		width: 100%;
	    height: calc(100%);
	    /*background: #007bff;*/
	}
	main#main{
		width:100%;
		height: calc(100%);
		background:white;
	}
	#login-right{
		position: absolute;
		right:0;
		width:calc(50%);
		height: calc(100%);
		background:#FAFBFC;
		display: flex;
		align-items: center;
	}
	#login-left{
		position: absolute;
		left:0;
		width:calc(50%);
		height: calc(100%);
		background:#FAFBFC;
		display: flex;
		align-items: center;
		
	}
	#login-right .card{
		margin: auto;
		z-index: 1
	}
	.logo {
    margin: auto;
    font-size: 8rem;
    background: white;
    padding: .5em 0.7em;
    border-radius: 50% 50%;
    color: #000000b3;
    z-index: 10;
}

.card_header{
	border-radius: 20px 20px 0 0;
}
.card_border{
	border-radius: 20px;
	background-color: white;
}
.input{
	height: 38px;
	border-radius: 16px;
	background-color: #dddddd;
	
}
.button{
	background-color: #7b1113;
	color: white;
	height: 24px;
	width: 81px;
	border-radius: 16px;
}

.input_card{
	margin-left: 25px;
	margin-right: 25px;
}

</style>

<body>


  <main id="main">
  		<div id="login-left">
		  	<div class="col-md-8 offset-md-2">
		  		<form id="login-form" >
					<div class="card border-light card_border">
						<div class="justify-content-center d-flex card_header" style="background-color:#7b1113">
							<label class="text-white h2 mt-3 mb-3">Admin</label>
						</div>
						<div class="card-body input_card">						
							<div class="form-group">
								<label for="username" class="control-label">Username</label>
								<input type="text" id="username" name="username" class="form-control input">
							</div>
							<div class="form-group">
								<label for="password" class="control-label">Password</label>
								<input type="password" id="password" name="password" class="form-control input mb-3">
							</div>
						</div>
					</div>
						<div class="col-md-12 mt-5">
							<button class="btn btn-sm button col-md-3 float-right">Login</button>
						</div>
				</form>
			</div>
  		</div>
  		<div id="login-right">
		  	<img src="assets/img/right.png">
  		</div>
   

  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script>
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='index.php?page=home';
				}else if(resp == 2){
					location.href ='voting.php';
				}else{
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>	
</html>