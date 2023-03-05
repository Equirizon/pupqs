<style>
	.left-side{
		position: absolute;
		width: calc(50%);
		height: calc(100%);
		left: 0;
		top:0;
		background: #FAFBFC;
		display: flex;
		justify-content: center;
		align-items: center;
	}
	.right-side{
		position: absolute;
		width: calc(50%);
		height: calc(100%);
		right: 0;
		top:0;
		background:gray;
	}
	.slideShow{
		display: flex;
		justify-content: center;
		align-items: center;
		width: calc(100%);
		height: calc(100%);
		padding: auto;
	}
	.slideShow img,.slideShow video{
		max-width: calc(100%);
		max-height: calc(100%);
		opacity: 0;
		transition: all .5s ease-in-out;
	}
	.slideShow video{
		width: calc(100%);
	}
	a.btn.btn-sm.btn-success {
    z-index: 99999;
    position: fixed;
    left: 1rem;
	}
	.card_header{
		border-radius: 20px 20px 0 0;
	}
	.card_border{
		border-radius: 20px;
		background-color: white;
	}
	.input{
		height: 43px;
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

</style>
<?php include "admin/db_connect.php" ?>
<a href="index.php" class="btn btn-sm btn-success"><i class="fa fa-home"></i> Home</a>
<div class="left-side">
	<div class="col-md-10 offset-md-1">
		<form action="" id="new_queue">
			<div class="card border-light card_border">
				<div class="justify-content-center d-flex card_header" style="background-color:#7b1113">
					<label class="text-white h2 mt-3 mb-3">Register</label>
				</div>
				<div class="card-body">
					<div class="container-fluid">
						<div class="form-group">
							<label for="name" class="control-label">Name</label>
							<input type="text" id="name" name="name" class="form-control input">
						</div>
						<div class="form-group">
							<label for="student_no" class="control-label">Student Number</label>
							<input type="text" id="student_no" name="student_no" class="form-control input">
						</div>
						<div class="form-group">
							<label for="transaction_id" class="control-label">Transaction</label>
							<select name="transaction_id" id="transaction_id" class="custom-select input" require>
									<option></option>
									<?php 
										$trans = $conn->query("SELECT * FROM transactions where status = 1 order by name asc");
										while($row=$trans->fetch_assoc()):
									?>
									<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
								<?php endwhile; ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 mt-4">
					<button class="btn btn-sm button col-md-3 float-right">Save</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="right-side">
	<?php
	$uploads = $conn->query("SELECT * FROM file_uploads order by rand() ");
	$slides = array();
	while($row= $uploads->fetch_assoc()){
		$slides[] = $row['file_path'];
	}
	?>
	<div class="slideShow">
		
	</div>
</div>
<script>
	var slides = <?php echo json_encode($slides) ?>;
	var scount = slides.length;
		if(scount > 0){
				$(document).ready(function(){
					render_slides(0)
				})
		}
	function render_slides(k){
		if(k >= scount)
			k = 0;
		var src = slides[k]
		k++;
		var t = src.split('.');
		var file ;
			t = t[1];
			if(t == 'mp4'){
				file = $("<video id='slide' src='admin/assets/uploads/"+src+"' onended='render_slides("+k+")' autoplay='true' muted='muted'></video>");
			}else{
				file = $("<img id='slide' src='admin/assets/uploads/"+src+"' onload='slideInterval("+k+")' />" );
			}
			console.log(file)
			if($('#slide').length > 0){
				$('#slide').css({"opacity":0});
				setTimeout(function(){
						$('.slideShow').html('');
				$('.slideShow').append(file)
				$('#slide').css({"opacity":1});
				if(t == 'mp4')
					$('video').trigger('play');

				
				},500)
			}else{
				$('.slideShow').append(file)
				$('#slide').css({"opacity":1});

							}
				
	}
	function slideInterval(i=0){
		setTimeout(function(){
		render_slides(i)
		},2500)

	}
	$('.select2').select2({
		placeholder:"Please Select Here",
		width:"100%"
	})
	$('#new_queue').submit(function(e){
		e.preventDefault()
		start_load()
			$.ajax({
				url:'admin/ajax.php?action=save_queue',
				method:'POST',
				data:$(this).serialize(),
				error:function(err){
					console.log(err)
					alert_toast("An error occured",'danger');
					alert_toast("Queue Registed Successfully",'success');
					end_load()
				},
				success:function(resp){
					if(resp > 0){
						$('#name').val('')
						$('#transaction_id').val('').select2({
							placeholder:"Please Select Here",
							width:"100%"
						})
						var nw = window.open("queue_print.php?id="+resp,"_blank","height=500,width=800")
						nw.print()
						setTimeout(function(){
							nw.close()
						},500)
						end_load()
					alert_toast("Queue Registed Successfully",'success');
					}
				}
			})
		
	})

</script>