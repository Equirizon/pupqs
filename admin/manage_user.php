<?php 
include('db_connect.php');
if(isset($_GET['id'])){
$user = $conn->query("SELECT * FROM users where id =".$_GET['id']);
foreach($user->fetch_array() as $k =>$v){
	$meta[$k] = $v;
}
}
?>
<div>
	<form action="" id="manage-user">	
		<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" id="name" value="<?php echo isset($meta['name']) ? $meta['name']: '' ?>" required>
		</div>
		<div>
			<label for="username">Username</label>
			<input type="text" name="username" id="username" value="<?php echo isset($meta['username']) ? $meta['username']: '' ?>" required  autocomplete="off">
		</div>
		<div>
			<label for="password">Password</label>
			<input type="password" name="password" id="password" value="" autocomplete="off">
			<?php if(isset($meta['id'])): ?>
			<small><i>Leave this blank if you dont want to change the password.</i></small>
		<?php endif; ?>
		</div>
		<div class="form-group">
			<label for="type">User Type</label>
			<select name="type" id="type" class="custom-select">
				<option value="2" <?php echo isset($meta['type']) && $meta['type'] == 2 ? 'selected': '' ?>>Staff</option>
				<option value="1" <?php echo isset($meta['type']) && $meta['type'] == 1 ? 'selected': '' ?>>Admin</option>
			</select>
		</div>
		<div id="window-field">
			<label for="type">Window</label>
			<select name="window_id" id="window_id">
				<option value="" <?php echo isset($meta['window_id']) && $meta['window_id'] == 0 ? 'selected': '' ?>></option>
				<?php 
				$query = $conn->query("SELECT w.*,t.name as tname FROM transaction_windows w inner join transactions t on t.id = w.transaction_id where w.status = 1 order by name asc");
				while($row= $query->fetch_assoc()):
				?>
				<option value="<?php echo $row['id'] ?>" <?php echo isset($meta['window_id']) && $meta['window_id'] == $row['id'] ? 'selected': ''; ?>><?php echo $row['tname']. ' '. $row['name'] ?></option>
				<?php endwhile; ?>
			</select>
		</div>
		<button>save</button>
		<button type="button" onclick="hideDialog()"> Cancel</button>

	</form>
</div>
<script>
	$('#type').change(function(){
		if($(this).val() == 1){
			$('#window-field').hide()
		}else{
			$('#window-field').show()
		}
	})
	$('#manage-user').submit(function(e){
		e.preventDefault();
		$.ajax({
			url:'ajax.php?action=save_user',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp ==1){
					alert("Data successfully saved")
					window.location = "index.php?page=users";

				}else{
					alert("Username already exist")
				}
			}
		})
	})
	if($('#type').val() == 1){
			$('#window-field').hide()
		}else{
			$('#window-field').show()
		}
</script>