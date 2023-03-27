<?php include 'db_connect.php' ?>

<?php 
include('db_connect.php');
$complete_transactions = "SELECT * FROM queue_list WHERE status = 1";
$complete_transactions_run = mysqli_num_rows(mysqli_query($conn, $complete_transactions));
$pending_transactions = "SELECT * FROM queue_list WHERE status = 0";
$pending_transactions_run = mysqli_num_rows(mysqli_query($conn, $pending_transactions));
$windows = "SELECT name FROM transaction_windows;";
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

        <a href="index.php?page=queue_list">
          <span class="material-symbols-outlined">group</span>
          <h3>Queue List</h3>
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
              <!-- <small class="text-muted">Last 24 hours</small> -->
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
              <!-- <small class="text-muted">Last 24 hours</small> -->
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
              <!-- <small class="text-muted">Last 24 hours</small> -->
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
              <!-- <small class="text-muted">Last 24 hours</small> -->
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
                
                <h3 id="window">-</h3>
          
                </form>
                </div>
              </div>
            </div>

            <div class="active-transactions">
            <div class="middle">
                <div class="left">
                <h2>NOW SERVING</h2>
                <h3 id="sname">-</h3>
                <h1 id="squeue">-</h1>
              <button class="submit" onclick="queueNow()">Next Serve</button>
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
                  <th>Name</th>
                  <th>Student No.</th>
                  <th>Queue No.</th>
                  <th>Date</th>
				          <th>Time</th>
              </thead>

              <tbody>
				<?php 
				$i = 1;
        $id = $_SESSION['login_id'];
        $window_id = $conn->query("SELECT window_id FROM users where id = $id");
        $result = mysqli_fetch_row($window_id);
        $trans_id = $conn->query("SELECT transaction_id FROM transaction_windows where id = $result[0]");
        $result1 = mysqli_fetch_row($trans_id);
				$types = $conn->query("SELECT * FROM queue_list where transaction_id = $result1[0] and status = 0 order by id asc");
				while($row=$types->fetch_assoc()):
				?>
                <tr>
                  <td><?php echo $i++ ?></td>
                  <td><?php echo $row['name'] ?></td>
                  <td><?php echo $row['student_no'] ?></td>
                  <td><?php echo $row['queue_no'] ?></td>
                  <td><?php echo date("m/d/Y",strtotime($row['created_timestamp'])) ?></td>
			            <td><?php echo date("h:i a",strtotime($row['created_timestamp'])) ?></td>
					
				  </td>
                </tr>
              </tbody>

              <tbody>
				<?php endwhile; ?>
              </tbody>

          </table>
       
<!--------------------------END OF MAIN--------------->
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
  function queueNow(){
          $.ajax({
              url:'ajax.php?action=update_queue',
              success:function(resp){
                  resp = JSON.parse(resp)
                  $('#sname').html(resp.data.name)
                  $('#squeue').html(resp.data.queue_no)
                  $('#window').html(resp.data.wname)
              }
          })
  }


</script>