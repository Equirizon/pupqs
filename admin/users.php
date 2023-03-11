<button id="new_user"><i class="fa fa-plus"></i> New user</button>
<div>
	<table>
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Window</th>
				<th>Username</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
				include 'db_connect.php';
				$query = $conn->query("SELECT w.*,t.name as tname FROM transaction_windows w inner join transactions t on t.id = w.transaction_id  order by name asc");
				while($row= $query->fetch_assoc()):
					$window[$row['id']] = ucwords($row['tname'].' '.$row['name']);
				endwhile;
				$users = $conn->query("SELECT * FROM users u order by name asc");
				$i = 1;
				while($row= $users->fetch_assoc()):
				?>
				<tr>
				<td>
					<?php echo $i++ ?>
				</td>
				<td>
					<?php echo ucwords($row['name']) ?>
				</td>
				<td>
					<?php echo isset($window[$row['window_id']]) ? $window[$row['window_id']] : "N/A" ?>
				</td>
				<td>
					<?php echo $row['username'] ?>
				</td>
				<td>
					<div>
						<div>
						<a class="edit_user" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Edit</a>
						<a class="delete_user" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Delete</a>
						</div>
					</div>
				</td>
				</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
</div>
<dialog id="favDialog">
	<?php
 		include 'manage_user.php';
	?>
</dialog>
<script>
	window.onload = function() {
		var url_string = window.location.href; 
		var url = new URL(url_string);
		var id = url.searchParams.get("id");
		if(id){
			favDialog.showModal();
		}
	};
	function hideDialog(){
		favDialog.close();
	}
	
	$('#new_user').click(function(){
		const favDialog = document.getElementById('favDialog');
		favDialog.showModal();
	})
	$('.edit_user').click(function(){
		window.history.replaceState(null, null, "?page=users&id="+$(this).attr('data-id'));
		location.reload()
		
		
	})
	$('.delete_user').click(function(){
			delete_user($(this).attr('data-id'))
			location.reload()
		})
	function delete_user($id){
		if (confirm("Do you want to delete?") == true) {
			$.ajax({
				url:'ajax.php?action=delete_user',
				method:'POST',
				data:{id:$id},
				success:function(resp){
					if(resp==1){
						alert("Data successfully deleted")
					}
				}
			})
		}
	}
</script>