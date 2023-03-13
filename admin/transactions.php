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

        <a href="index.php?page=home">
          <span class="material-symbols-outlined">dashboard</span>
          <h3>Dashboard</h3>
        </a>

        <a href="#" class="active">
          <span class="material-symbols-outlined">receipt_long</span>
          <h3>Transactions</h3>
        </a>

        <a href="index.php?page=windows">
          <span class="material-symbols-outlined">window</span>
          <h3>Windows</h3>
        </a>


        <a href="index.php?page=users">
          <span class="material-symbols-outlined">group</span>
          <h3>Users</h3>
        </a>

        <a href="#">
          <span class="material-symbols-outlined">logout</span>
          <h3>Log Out</h3>
        </a>

      </div>
    </aside>
    <!------------------------END OF ASIDE------------------------->
    <main>
		<form action="" id="manage-transaction">
        <h1>Transactions</h1>
		<input type="hidden" name="id">
        <div class="insights">
            <div class="active-transactions">
              <span class="material-symbols-outlined">description</span>
              <div class="middle">
                <div class="left">
                  <h3>Transactions Form</h3>
                  <form action="" method="post">
                    <div class="input-field">
                        <input name="name" id="name" type="text" placeholder="insert transaction here..">
						<input name="department" id="department" type="text" placeholder="insert department here..">
                        
                    </div>
                    <button class="submit">Submit</button>
                </div>
              </div>
            </div>
            <!--END OF TRANSACTIONS-->
        </div>
		</form>
        <!--END OF INSIGHTS-->

        <div class="transaction-table">
          <h2>Transactions List</h2>
          <table>

              <thead>
                <tr>
                  <th>ID</th>
                  <th>Transaction Type</th>
                  <th>Department</th>
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
                  <td><?php echo $row['name'] ?></td>
                  <td><?php echo $row['department'] ?></td>
                  <td>
				  	<button class="edit_transaction" type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>" data-department="<?php echo $row['department'] ?>" >Edit</button>
					<button class="delete_transaction" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
				  </td>
                </tr>
              </tbody>

              <tbody>
				<?php endwhile; ?>
              </tbody>

          </table>
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
            <p>Hey, <b><?php echo $_SESSION['login_name']?></b></p>
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



</script>
<script>
	const sideMenu = document.querySelector("aside");
  	const menuBtn = document.querySelector("#menu-btn");
  	const closeBtn = document.querySelector("#close-btn");

	menuBtn.addEventListener('click',()=>{
		sideMenu.style.display = 'block';
	})

	closeBtn.addEventListener('click', ()=>{
	sideMenu.style.display = 'none';
	})

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
		cat.find("[name='department']").val($(this).attr('data-department'))
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