<?php include('db_connect.php');?>
<div>
<form action="" id="manage-transaction">
	<div>
		<div>
			Transactions Form
		</div>
		<div>
			<input type="hidden" name="id">
			<div>
				<label>Name</label>
				<textarea name="name" id="name" cols="30" rows="2"></textarea>
			</div>
			<div>
				<label>Department</label>
				<textarea name="department" id="department" cols="30" rows="2"></textarea>
			</div>
		</div>
		<div>
			<button> Save</button>
			<button type="button" onclick="_reset()"> Cancel</button>
		</div>
	</div>
</form>
</div>

<div>
	<table>
		<thead>
			<tr>
				<th>#</th>
				<th>Transaction Type</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$i = 1;
			$types = $conn->query("SELECT * FROM transactions where status = 1 order by id asc");
			while($row=$types->fetch_assoc()):
			?>
			<tr>
				<td><?php echo $i++ ?></td>
				<td>
					<p> <b><?php echo $row['name'] ?></b></p>
				</td>
				<td class="text-center">
					<button class="edit_transaction" type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>"  >Edit</button>
					<button class="delete_transaction" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
				</td>
			</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
</div>
<script>
	function _reset(){
		$('[name="id"]').val('');
		$('#manage-transaction').get(0).reset();
	}
	
	$('#manage-transaction').submit(function(e){
		e.preventDefault()

		if($('#name').val() != ''){
			if($('#department').val() != ''){
				$.ajax({
					url:'ajax.php?action=save_transaction',
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
						else if(resp==2){
							alert("Data successfully updated")
							location.reload()
						}
						else if(resp==3){
							alert("Name already exist")
						}
					}
				})
			}else{
				alert("Insert department!")
			}
		}else{
			alert("Insert name!")
		}
	})
	$('.edit_transaction').click(function(){
		var cat = $('#manage-transaction')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='name']").val($(this).attr('data-name'))
	})
	$('.delete_transaction').click(function(){
		var cat = $('#manage-transaction')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		id=$('[name="id"]').val()
		delete_transaction(id)
	})

	function delete_transaction($id){
		if (confirm("Do you want to delete?") == true) {
			$.ajax({
				url:'ajax.php?action=delete_transaction',
				method:'POST',
				data:{id:$id},
				success:function(resp){
					if(resp==1){
						location.reload();
					}
				}
			})
		}
	}
</script>