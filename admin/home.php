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

<link rel="stylesheet" href="style.css">

  
<header class="row container">
        <button id="menu-btn">
          <span class="material-symbols-outlined">menu</span>
        </button>


      <div class="toggleMenu" onclick="toggleMenu();"></div>

      <nav class="navigation row">
        <ul class="row">
          <li><a href="#">Home</a></li>
          <li><a href="#">Admin</a></li>
          <li><button class="btn btn-outline">Register</button></li>
        </ul>
      </nav>

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

        <a href="#">
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
<script>
  const sideMenu = document.querySelector("aside");
  const menuBtn = document.querySelector("#menu-btn");
  const closeBtn = document.querySelector("#close-btn");

  menuBtn.addEventListener('click',()=>{
    sideMenu.style.display = 'block';
  })

  closeBtn.addEventListener('click', ()=>{
  sideMenu.style.display = 'none';
  menuBtn.style.display = 'block';
  })


</script>