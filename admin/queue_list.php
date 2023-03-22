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


        <a href="index.php?page=users">
          <span class="material-symbols-outlined">group</span>
          <h3>Users</h3>
        </a>

        <a href="#">
          <span class="material-symbols-outlined" class="active">group</span>
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
    <p>Select Transaction Type</p>
    <form method="post" action="export.php">
        <div class="registration-form-container">
            <select name="transaction_id" id="transaction_id" require>
                <?php 
                $first = 1;
                $trans = $conn->query("SELECT * FROM transactions where status = 1 order by name asc");?>
                <?php while($row=$trans->fetch_assoc()):?>
                    <?php if($first = 1):?>
                        <?php $selected_trans = $row['id'];?>
                        <option selected value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                        <?php $first++?>
                    <?php else:?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                    <?php endif; ?>
                <?php endwhile; ?>
            </select>
            
            <input type="date" placeholder="Start" id="date1" name="date1" required>
            <input type="date" placeholder="End" id="date2" name="date2" disabled>
            <button class="generate">Generate Table and Graph</button>
            <input type="submit" name="export" value="Export" />
            
            
        </div>
    
    </form>
    
    <div class="transaction-table">
          <h2>Queue List</h2>
          <table id="refresh">

              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Queue No.</th>
                  <th>Date</th>
				          <th>Time</th>
                </tr>
              </thead>

              <tbody>
				<?php
                
                $i = 1;
				$types = $conn->query("SELECT * FROM queue_list where transaction_id = $selected_trans and status = 0 order by id asc");
				while($row=$types->fetch_assoc()):
				?>
                <tr>
                  <td><?php echo $i++ ?></td>
                  <td><?php echo $row['name'] ?></td>
                  <td><?php echo $row['queue_no'] ?></td>
                  <td><?php echo date("m/d/Y",strtotime($row['created_timestamp'])) ?></td>
			            <td><?php echo date("h:i a",strtotime($row['created_timestamp'])) ?></td>
		            </tr>
                <?php endwhile; ?>
              </tbody>
          </table>
          <div style="width:50%;height:20%;text-align:center">
          <h2>Analytics</h2>
    <canvas id="chartjs_line"></canvas>
          </div>
    </div>
    
    </main>
    <script>
        $('#transaction_id').change(function(){

	})
    $(document).ready(function () {
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day2 = dtToday.getDate();
        var day1 = dtToday.getDate() - 1;
        var year = dtToday.getFullYear();

        if(month < 10)
            month = '0' + month.toString();
        if(day2 < 10)
            day2 = '0' + day.toString();
        if(day1 < 10)
            day1 = '0' + day.toString();

        var maxDate2 = year + '-' + month + '-' + day2;
        var maxDate1 = year + '-' + month + '-' + day1;
        $('#date2').val(maxDate2);       
        $('#date2').attr('max', maxDate2);
        $('#date1').attr('max', maxDate1);
        

        $('.generate').click(function(e){
          e.preventDefault()
          var date1 = $("#date1").val().trim();
          var date2 = $("#date2").val().trim();
          var transaction_id = $("#transaction_id").val().trim();
          if(date1 == ""){
            alert("Insert start date")
          }else{
            $.ajax({
              url:'ajax.php?action=display_queue',
              data: {date1:date1,date2:date2,transaction_id:transaction_id},
              method: 'POST',
              success:function(resp){
                  $('#refresh').html(resp);
              }
            })
            $.ajax({
              url:'ajax.php?action=display_graph',
              data: {date1:date1,date2:date2,transaction_id:transaction_id},
              method: 'POST',
              success:function(resp){
                resp = JSON.parse(resp)
                  var ctx = document.getElementById("chartjs_line").getContext('2d');
                  var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels:resp.dates,
                        datasets: [{
                            data:resp.no_per_day,
                        }]
                    },
                });
              }
            })
          }

            
          
        })
        })
    
    $('#date1').change(function(){
      $("#date2").prop("disabled",false)
      $('#date2').attr('min', $('#date1').val());
    })

    </script>
