<?php include('db_connect.php');?>
<div>
<form action="" id="manage-window">
	Windows Form
	<div>
		<input type="hidden" name="id">
		<div>
			<label>Transaction</label>
			<select name="transaction_id" id="transaction_id" class="select2" require>
				<option></option>
				<?php 
					$trans = $conn->query("SELECT * FROM transactions where status = 1 order by name asc");
					while($row=$trans->fetch_assoc()):
				?>
				<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
			<?php endwhile; ?>
			</select>
		</div>
		<div>
			<label>Name</label>
			<textarea name="name" id="name" cols="30" rows="2" require></textarea>
		</div>
	</div>
	<div>
		<button> Save</button>
		<button type="button" onclick="_reset()"> Cancel</button>
	</div>
</form>
</div>
<div>
	<table>
		<thead>
			<tr>
				<th>#</th>
				<th>Transaction</th>
				<th>Window</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$i = 1;
			$types = $conn->query("SELECT w.*,t.name as tname FROM transaction_windows w inner join transactions t on t.id = w.transaction_id where w.status = 1 order by name asc");
			while($row=$types->fetch_assoc()):
			?>
			<tr>
				<td><?php echo $i++ ?></td>
				<td>
						<p> <b><?php echo $row['tname'] ?></b></p>
				</td>
				<td>
						<p> <b><?php echo $row['name'] ?></b></p>
				</td>
				<td>
					<button class="edit_window" type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>" data-transaction_id="<?php echo $row['transaction_id'] ?>"  >Edit</button>
					<button class="delete_window" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
				</td>
			</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
</div>
<script>
	function _reset(){
		$('[name="id"]').val('');
		$('#manage-window').get(0).reset();
		$('.select2').trigger("change")
	}
	
	$('.select2').select2({
		placeholder:"Select Here",
	})
	
	$('#manage-window').submit(function(e){
		e.preventDefault()
		if($('#name').val() == ''){
			alert("Insert name!");
		}
		else{
			if($('#transaction_id').val() == ""){
				alert("Select Transaction!");
			}
			else{
				$.ajax({
					url:'ajax.php?action=save_window',
					data: new FormData($(this)[0]),
					cache: false,
					contentType: false,
					processData: false,
					method: 'POST',
					type: 'POST',
					success:function(resp){
						if(resp==1){
							alert("Data successfully added")
							location.reload()
						}
						if(resp==2){
							alert("Data successfully updated")
							location.reload()
						}
						else if(resp==3){
							alert("Name already exist")
						}
					}
				})
			}
		}
		
	})
	$('.edit_window').click(function(){
		var cat = $('#manage-window')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='name']").val($(this).attr('data-name'))
		cat.find("[name='transaction_id']").val($(this).attr('data-transaction_id'))
		$('.select2').trigger("change")
	})
	$('.delete_window').click(function(){
		var cat = $('#manage-window')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		id=$('[name="id"]').val()
		delete_window(id)
	})

	function delete_window($id){
		if (confirm("Do you want to delete?") == true) {
			$.ajax({
				url:'ajax.php?action=delete_window',
				method:'POST',
				data:{id:$id},
				success:function(resp){
					if(resp==1){
						location.reload()
					}
				}
			})
		}
	}
</script>