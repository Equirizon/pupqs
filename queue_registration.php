<?php include "admin/db_connect.php" ?>
<a href="index.php"><i class="fa fa-home"></i> Home</a>

<div>
	<br><br><br><br><br><br>
	<form action="" id="new_queue">
		<div>
			<label for="name">Name</label>
			<input type="text" id="name" name="name">
		</div>
		<div>
			<label for="transaction_id">Transaction</label>
			<select name="transaction_id" id="transaction_id" require>
					<option></option>
					<?php 
						$trans = $conn->query("SELECT * FROM transactions where status = 1 order by name asc");
						while($row=$trans->fetch_assoc()):
					?>
					<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
				<?php endwhile; ?>
			</select>
		</div>
		<div class="row">
			<div class="col-md-12">
				<button>Save</button>
			</div>
		</div>
	</form>
</div>

<script>
	$('#new_queue').submit(function(e){
		e.preventDefault()
		var name = $("#name").val().trim();
		if(name == ""){
			alert("Insert name!");
		}
		else{
			if($('#transaction_id').val() == ""){
				alert("Select Transaction!");
			}
			else{
				$.ajax({
					url:'admin/ajax.php?action=save_queue',
					method:'POST',
					data:$(this).serialize(),
					error:function(err){
						console.log(err)
						alert("An error occured");
					},
					success:function(resp){
						if(resp > 0){
							$('#name').val('')
							var nw = window.open("queue_print.php?id="+resp,"_blank","height=500,width=800")
							nw.print()
							setTimeout(function(){
								nw.close()
							},1500)
						
						}
					}
				})
			}
		}
	})

</script>