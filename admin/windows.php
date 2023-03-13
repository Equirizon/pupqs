 
 <header class="row-container">
 
	<button id="menu-btn" class="menu">
		<span class="material-symbols-outlined">menu</span>
	</button>
 
</header>
 
 
 
 <div class="container">
    <aside>
      <div class="top">

        <!--top btn-->
        <div class="logo">
          <img src="/assets/images/PUP-Star.png" alt="">
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

			<a href="#" class="active">
			<span class="material-symbols-outlined">window</span>
			<h3>Windows</h3>
			</a>


			<a href="index.php?page=users">
			<span class="material-symbols-outlined">group</span>
			<h3>Users</h3>
			</a>

			<a href="">
			<span class="material-symbols-outlined">logout</span>
			<h3>Log Out</h3>
			</a>

      </div>
    </aside>
    <!------------------------END OF ASIDE------------------------->
    <main>
		<form action="" id="manage-window">
        <h1>Windows</h1>
		<input type="hidden" name="id">
        <div class="insights">
            <div class="active-transactions">
              <span class="material-symbols-outlined">description</span>
              <div class="middle">
                <div class="left">
                  <h3>Windows Form</h3>
                  <form action="" method="post">
                    <div class="dropdown">
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
                    <div class="input-field">
                        <input name="name" id="name" type="text" placeholder="insert name here..">
                    </div>
                    <button class="btn">Submit</button>
                </form>
                </div>
              </div>
            </div>
            <!--END OF TRANSACTIONS-->
        </div>
		</form>
        <!--END OF INSIGHTS-->

        <div class="transaction-table">
          <h2>Window List</h2>
          <table>
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Transaction Type</th>
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
                  <td><?php echo $row['tname'] ?></td>
                  <td><p> <b><?php echo $row['name'] ?></td>
                  <td><button class="edit_window" type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>" data-transaction_id="<?php echo $row['transaction_id'] ?>"  >Edit</button>
					<button class="delete_window" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
				</td>
                </tr>
				<?php endwhile; ?>
              </tbody>

             

          </table>
        </div>
    </main>
<!--------------------------END OF MAIN--------------->
</div>

<script>
	const sideMenu = document.querySelector("aside");
  	const menuBtn = document.querySelector("#menu-btn");
  	const closeBtn = document.querySelector("#close-btn");

	
	menuBtn.addEventListener('click',()=>{
    sideMenu.style.display = 'block';
    menuBtn.style.display = 'none';
  })

  closeBtn.addEventListener('click', ()=>{
  sideMenu.style.display = 'none';
  menuBtn.style.display = 'block';
  })


	function _reset(){
		$('[name="id"]').val('');
		$('#manage-window').get(0).reset();
	}
	
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