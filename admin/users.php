<div class="container">
    <aside>
      <div class="top">

        <!--top btn-->
        <div class="logo">
          <img src="./assets/images/pup.png" alt="">
          <h2>PUP<span class="danger">QS</span></h2>
        </div>

        <!--close btn-->
        <div class="close" id="close-btn">
          <span class="material-symbols-outlined">close</span>
        </div>


      </div>

      <div class="sidebar">

        <a href="index.php?page=dashboard">
          <span class="material-symbols-outlined">dashboard</span>
          <h3>Dashboard</h3>
        </a>

        <a href="index.php?page=transactions">
          <span class="material-symbols-outlined">receipt_long</span>
          <h3>Transactions</h3>
        </a>

        <a href="index.php?page=windows">
          <span class="material-symbols-outlined">window</span>
          <h3>Windows</h3>
        </a>


        <a href="#" class="active">
          <span class="material-symbols-outlined">group</span>
          <h3>Users</h3>
        </a>

        <a href="ajax.php?action=logout">
          <span class="material-symbols-outlined">logout</span>
          <h3>Log Out</h3>
        </a>

      </div>
    </aside>
    <!------------------------END OF ASIDE------------------------->
    <main>
        <h1>Users</h1>
		<form action="" id="manage-user">
        <div class="insights">
            <div class="active-transactions">
              <span class="material-symbols-outlined">person</span>
              <div class="middle">
                <div class="left">
                  <h3>Windows Form</h3>
				  <input type="hidden" name="id">
                    <div class="input-field">
                        <input name="name" id="name" type="text" placeholder="name">
                    </div>
                    <div class="input-field">
                        <input name="username" id="username" type="text" placeholder="username">
                    </div>
                    <div class="input-field">
                        <input name="password" id="password" type="password" placeholder="password">
                    </div>
                    <div class="dropdown">
						<select name="type" id="type" class="custom-select">
						<option value="2">Staff</option>
						<option value="1">Admin</option>
						</select>
                    </div>
                    <div class="dropdown">
						<select name="window_id" id="window_id">
						<option value=""></option>
							<?php 
							$query = $conn->query("SELECT w.*,t.name as tname FROM transaction_windows w inner join transactions t on t.id = w.transaction_id where w.status = 1 order by name asc");
							while($row= $query->fetch_assoc()):
							?>
							<option value="<?php echo $row['id'] ?>" <?php echo isset($meta['window_id']) && $meta['window_id'] == $row['id'] ? 'selected': ''; ?>><?php echo $row['tname']. ' '. $row['name'] ?></option>
							<?php endwhile; ?>
						</select>
                    </div>
                    <button class="btn">Submit</button>
                </div>
              </div>
            </div>
            <!--END OF TRANSACTIONS-->
        </div>
		</form>
        <!--END OF INSIGHTS-->

        <div class="transaction-table">
          <h2>User List</h2>
          <table>

              <thead>
                <tr>
                  <th>ID</th>
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
                  <td><?php echo $i++ ?></td>
                  <td><?php echo ucwords($row['name']) ?></td>
                  <td><?php echo isset($window[$row['window_id']]) ? $window[$row['window_id']] : "N/A" ?></td>
                  <td><?php echo $row['username'] ?></td>
                  <td class="warning"><a class="edit_user" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>" data-username="<?php echo $row['username'] ?>" data-type="<?php echo $row['type'] ?>" data-window_id="<?php echo $row['window_id'] ?>">Edit</a>
						<a class="delete_user" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Delete</a>
					</td>
                </tr>
				<?php endwhile; ?>
              </tbody>

             

          </table>
          <a href="#">Show All</a>
        </div>
    </main>
<!--------------------------END OF MAIN--------------->

    <div class="right">
      <div class="top">
        <button id="menu-btn">
          <span class="material-symbols-outlined">menu</span>
        </button>
        <div class="profile">
          <div class="info">
            <p>Hey, <b>Flor</b></p>
            <small class="text-muted">Admin</small>
          </div>
          <div class="profile-photo">
            <span class="material-symbols-outlined">account_circle</span>
          </div>
        </div>
      </div>
      <!--------------------------END OF TOP--------------->
    </div>

  </div>
	

<script>
	$('#type').change(function(){
		if($(this).val() == 1){
			$('#window_id').hide()
		}else{
			$('#window_id').show()
		}
	})
	const sideMenu = document.querySelector("aside");
	const menuBtn = document.querySelector("#menu-btn");
	const closeBtn = document.querySelector("#close-btn");

	menuBtn.addEventListener('click',()=>{
		sideMenu.style.display = 'block';
	})

	closeBtn.addEventListener('click', ()=>{
	sideMenu.style.display = 'none';
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

				}
			}
		})
	})
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
		var cat = $('#manage-user')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='name']").val($(this).attr('data-name'))
		cat.find("[name='username']").val($(this).attr('data-username'))
		cat.find("[name='password']").val($(this).attr('data-password'))
		cat.find("[name='type']").val($(this).attr('data-type'))
		cat.find("[name='window_id']").val($(this).attr('data-window_id'))
		
		
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