<?php include('db_connect.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <a href="#">Transaction</a><br>
    <a href="windows.php">Window</a><br>
    <a href="user.php">User</a>
    <br><br>
    <div>
        <div id="msg"></div>
        <form action="" id="manage-transaction">
            <input type="hidden" name="id">
            <label>Name</label><br>
            <input type="text" name="name" id=""><br>
            <button> Save</button>
            <button onclick="_reset()"> Cancel</button>
        </form>
    </div>
    <br><br>
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
                <td class="text-center"><?php echo $i++ ?></td>
                
                <td class="">
                        <p> <b><?php echo $row['name'] ?></b></p>
                </td>
                <td class="text-center">
                    <button class="btn btn-sm btn-primary edit_transaction" type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>"  >Edit</button>
                    <button class="btn btn-sm btn-danger delete_transaction" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
</table>

</body>
</html>
<script>
    $('#manage-transaction').submit(function(e){
		e.preventDefault()
		start_load()
		$('#msg').html('')
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
					alert_toast("Data successfully added",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else if(resp==2){
					$('#msg').html("<div class='alert alert-danger'>Name already exist.</div>")
					end_load()

				}
			}
		})
	})
</script>