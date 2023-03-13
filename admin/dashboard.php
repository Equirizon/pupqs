<?php include 'db_connect.php' ?>

<?php 
include('db_connect.php');
$complete_transactions = "SELECT * FROM queue_list WHERE status = 1";
$complete_transactions_run = mysqli_num_rows(mysqli_query($conn, $complete_transactions));
$pending_transactions = "SELECT * FROM queue_list WHERE status = 0";
$pending_transactions_run = mysqli_num_rows(mysqli_query($conn, $pending_transactions));
$windows = "SELECT DISTINCT name FROM transaction_windows;";
$windows_run = mysqli_num_rows(mysqli_query($conn, $windows));
?>



<?php if($_SESSION['login_type'] == 1): ?>
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
          <img src="../assets/PUP-Logo.png" alt="">
          <h2>PUP<span class="danger">QS</span></h2>
        </div>

        <!--close btn-->
        <div class="close" id="close-btn">
          <span class="material-symbols-outlined">close</span>
        </div>


      </div>

      <div class="sidebar">

        <a href="#" class="active">
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


        <a href="index.php?page=users">
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
        <h1>Dashboard</h1>
        <div class="insights">
            <div class="active-transactions">
              <span class="material-symbols-outlined">description</span>
              <div class="middle">
                <div class="left">
                  <h3>Pending Transactions</h3>
                  <h1><?php echo $pending_transactions_run?></h1>
                </div>
              </div>
              <small class="text-muted">Last 24 hours</small>
            </div>
            <!--END OF TRANSACTIONS-->
            <div class="completed-transactions">
              <span class="material-symbols-outlined">task</span>
              <div class="middle">
                <div class="left">
                  <h3>Completed Transactions</h3>
                  <h1><?php echo $complete_transactions_run?></h1>
                </div>
              </div>
              <small class="text-muted">Last 24 hours</small>
            </div>
            <!--END OF COMPLETED TRANSACTIONS-->
            <div class="windows">
              <span class="material-symbols-outlined">window</span>
              <div class="middle">
                <div class="left">
                  <h3>Windows</h3>
                  <h1><?php echo $windows_run?></h1>
                </div>
              </div>
            </div>
            <!--END OF WINDOWS-->
        </div>
        <!--END OF INSIGHTS-->

       
<!--------------------------END OF MAIN--------------->
<!--
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
    
    </div>

  
  </div>
-->
<?php endif; ?>
<?php if($_SESSION['login_type'] == 2): ?>
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
          <img src="../assets/PUP-Logo.png" alt="">
          <h2>PUP<span class="danger">QS</span></h2>
        </div>

        <!--close btn-->
        <div class="close" id="close-btn">
          <span class="material-symbols-outlined">close</span>
        </div>


      </div>

      <div class="sidebar">

        <a href="#" class="active">
          <span class="material-symbols-outlined">dashboard</span>
          <h3>Dashboard</h3>
        </a>

        <a href="index.php?page=faculty">
          <span class="material-symbols-outlined">badge</span>
          <h3>Faculty</h3>
        </a>

        <a href="ajax.php?action=logout">
          <span class="material-symbols-outlined">logout</span>
          <h3>Log Out</h3>
        </a>
      </div>
    </aside>

    <!------------------------END OF ASIDE------------------------->
   
    <main>
        <h1>Dashboard</h1>
        <div class="insights">
            <div class="active-transactions">
              <span class="material-symbols-outlined">description</span>
              <div class="middle">
                <div class="left">
                  <h3>Pending Transactions</h3>
                  <h1><?php echo $pending_transactions_run?></h1>
                </div>
              </div>
              <small class="text-muted">Last 24 hours</small>
            </div>
            <!--END OF TRANSACTIONS-->
            <div class="completed-transactions">
              <span class="material-symbols-outlined">task</span>
              <div class="middle">
                <div class="left">
                  <h3>Completed Transactions</h3>
                  <h1><?php echo $complete_transactions_run?></h1>
                </div>
              </div>
              <small class="text-muted">Last 24 hours</small>
            </div>
            <!--END OF COMPLETED TRANSACTIONS-->
            <div class="windows">
              <span class="material-symbols-outlined">window</span>
              <div class="middle">
                <div class="left">
                  <h3>Windows</h3>
                  <h1><?php echo $windows_run?></h1>
                </div>
              </div>
            </div>
            <!--END OF WINDOWS-->
            <div class="active-transactions">
              
              <div class="middle">
                <div class="left">
                <h2>WINDOW #</h2>
                
                <h3 id="window"></h3>
          
                </form>
                </div>
              </div>
            </div>

            <div class="active-transactions">
            <div class="middle">
                <div class="left">
                <h2>NOW SERVING</h2>
                <h3 id="sname"></h3>
                <h1 id="squeue"></h1>
                <h3 id="window"></h3>
              <button class="submit">Next Serve</button>
                </form>
                </div>
              </div>
            </div>

            <div class="active-transactions">
              
              <div class="middle">
                <div class="left">
                <h2>NEXT IN LINE</h2>
                <h3 id="sname"></h3>
                <h1 id="squeue"></h1>
                <h3 id="window"></h3>              
                </form>
                </div>
              </div>
            </div>
        </div>
        <!--END OF INSIGHTS-->


        <!---------- QUEUE LIST table---------->
        <div class="transaction-table">
          <h2>Queue List</h2>
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
       
<!--------------------------END OF MAIN--------------->
<!--
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
    
    </div>

  
  </div>
-->
<?php endif; ?>
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


</script>