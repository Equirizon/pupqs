<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "admin/db_connect.php" ?>
    <?php 
    $tname = $conn->query("SELECT * FROM transactions where id =".$_GET['id0'])->fetch_array()['name'];
    function nserving(){
        include "admin/db_connect.php";

        $query = $conn->query("SELECT q.*,t.name as wname FROM queue_list q inner join transaction_windows t on t.id = q.window_id where date(q.date_created) = '".date('Y-m-d')."' and q.transaction_id = '".$_GET['id']."' and q.status = 1 order by q.id desc limit 1  ");
        if($query->num_rows > 0){
            foreach ($query->fetch_array() as $key => $value) {
                if(!is_numeric($key))
                $data[$key] = $value;
            }
            return json_encode(array('status'=>1,"data"=>$data));
        }else{
            return json_encode(array('status'=>0));

        }
        $conn->close();
    }
    ?>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Now Serving</title>
	<link rel="stylesheet" href="admin/SDK.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body class="display-body">

    <div class="display-background">
        <img src="assets/banner3.jpg" alt="bg">
    </div>

        <?php $tname = $conn->query("SELECT * FROM transactions where id =".$_GET['id0'])->fetch_array()['name']; ?>
        <div class="display-container">
            <div class="display-transaction-type">
                <div>
                    <h1><?php echo strtoupper($tname) ?></h1><!-- transaction name -->
                </div>
                <div>
                    <h1 id="window">-</h1>
                </div>
            </div>
            
            <div class="display-transaction-serving">
                <div>
                    <h1>Now Serving</h1>
                </div>
                <div>
                    <div><h1 id="sname">-</h1></div>
                    <div><h1 id="squeue">-</h1> </div>
                </div>
            </div>
            <div>

            </div>
        </div>
        <?php $tname = $conn->query("SELECT * FROM transactions where id =".$_GET['id1'])->fetch_array()['name']; ?>
        <div class="display-container" id="div">
            <div class="display-transaction-type">
                <div>
                    <h1><?php echo strtoupper($tname) ?></h1><!-- transaction name -->
                </div>
                <div>
                    <h1 id="window1">-</h1>
                </div>
            </div>
            
            <div class="display-transaction-serving">
                <div>
                    <h1>Now Serving</h1>
                </div>
                <div>
                    <div><h1 id="sname1">-</h1></div>
                    <div><h1 id="squeue1">-</h1> </div>
                </div>
            </div>
            <div>

            </div>
        </div>
        <?php $tname = $conn->query("SELECT * FROM transactions where id =".$_GET['id2'])->fetch_array()['name']; ?>
        <div class="display-container" id="div">
            <div class="display-transaction-type">
                <div>
                    <h1><?php echo strtoupper($tname) ?></h1><!-- transaction name -->
                </div>
                <div>
                    <h1 id="window1">-</h1>
                </div>
            </div>
            
            <div class="display-transaction-serving">
                <div>
                    <h1>Now Serving</h1>
                </div>
                <div>
                    <div><h1 id="sname1">-</h1></div>
                    <div><h1 id="squeue1">-</h1> </div>
                </div>
            </div>
            <div>

            </div>
        </div>


</body>
<script>
        function register(){
            window.location = "index.php?page=queue_registration";
        }
        $(document).ready(function(){
            var queue = '';
            var renderServe = setInterval(function(){
                $.ajax({
                    url:'admin/ajax.php?action=get_queue',
                    method:"POST",
                    data:{id:'<?php echo $_GET['id0'] ?>'},
                    success:function(resp){
                        resp = JSON.parse(resp)
                        $('#sname').html(resp.data.name)
                        $('#squeue').html(resp.data.queue_no)
                        $('#window').html(resp.data.wname)
                    }
                })
                
            },1500)
            
        })
        $(document).ready(function(){
            var queue = '';
            var renderServe = setInterval(function(){
                $.ajax({
                    url:'admin/ajax.php?action=get_queue',
                    method:"POST",
                    data:{id:'<?php echo $_GET['id1'] ?>'},
                    success:function(resp){
                        resp = JSON.parse(resp)
                        $('#sname1').html(resp.data.name)
                        $('#squeue1').html(resp.data.queue_no)
                        $('#window1').html(resp.data.wname)
                    }
                })
                
            },1500)
            
        })
        $(document).ready(function(){
            var queue = '';
            var renderServe = setInterval(function(){
                $.ajax({
                    url:'admin/ajax.php?action=get_queue',
                    method:"POST",
                    data:{id:'<?php echo $_GET['id2'] ?>'},
                    success:function(resp){
                        resp = JSON.parse(resp)
                        $('#sname1').html(resp.data.name)
                        $('#squeue1').html(resp.data.queue_no)
                        $('#window1').html(resp.data.wname)
                    }
                })
                
            },1500)
            
        })
  
    </script>
</html>
