<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width = device-width, initial-scale = 1.0">
    <title>PUP Queuing System</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./assets/css/dashboard.css">
</head>
<body>
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
          <span class="material-symbols-outlined">home</span>
          <h3>Dashboard</h3>
        </a>
        <a href="#" class="active">
          <span class="material-symbols-outlined">receipt_long</span>
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
        <h1>Queue</h1>

        <div class="insights">
            <div class="active-transactions">
              
              <div class="middle">
                <div class="left">
                <h2>NOW SERVING</h2>
                <h3 id="sname"></h3>
                <h1 id="squeue"></h1>
                <h3 id="window"></h3>
                  <button class="next-serve">Next Serve</button>
                </form>
                </div>
              </div>
            </div>
            <!--END OF TRANSACTIONS-->
        </div>
        <!--END OF INSIGHTS-->

       
    </main>
<!--------------------------END OF MAIN--------------->

    <div class="right">
      <div class="top">
        <button id="menu-btn">
          <span class="material-symbols-outlined">menu</span>
        </button>
       
        </div>
      </div>
      <!--------------------------END OF TOP--------------->
    </div>


  </div>

<script>

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

  const sideMenu = document.querySelector("aside");
  const menuBtn = document.querySelector("#menu-btn");
  const closeBtn = document.querySelector("#close-btn");

  menuBtn.addEventListener('click',()=>{
    sideMenu.style.display = 'block';
  })

  closeBtn.addEventListener('click', ()=>{
  sideMenu.style.display = 'none';
  })


</script>


</body>
</html>