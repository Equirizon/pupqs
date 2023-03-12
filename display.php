<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "admin/db_connect.php" ?>
    <?php 
    $tname = $conn->query("SELECT * FROM transactions where id =".$_GET['id'])->fetch_array()['name'];
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
    <script>
        $(document).ready(function(){
            var queue = '';
            var renderServe = setInterval(function(){
                $.ajax({
                    url:'admin/ajax.php?action=get_queue',
                    method:"POST",
                    data:{id:'<?php echo $_GET['id'] ?>'},
                    success:function(resp){
                        resp = JSON.parse(resp)
                        $('#sname').html(resp.data.name)
                        $('#squeue').html(resp.data.queue_no)
                        $('#window').html(resp.data.wname)
                    }
                })
                
            },1500)
        })
    </script>
	<link rel="stylesheet" href="admin/SDK.css">
</head>
<body class="display-body">

    <div class="display-background">
        <img src="assets/banner3.jpg" alt="bg">
    </div>
    <!-- <a href="index.php"><i class="fa fa-home"></i> Home</a> -->

    <div class="header-blur"></div>
    <div class="header">
        <header class="landing-header">
            <a href="#" class="logo landing-header">
                <img src="assets/PUP-Logo.png" id="logo" alt="puplogo">
                <h1>PUP<b>QS</b></h1>
            </a>
            <div class="toggleMenu" onclick="toggleMenu();"></div>
            <nav class="navigation landing-header">
                <ul class="landing-header">
                <li><a href="index.php?page=home">Home</a></li>
                <li><a href="index.php?page=login">Admin</a></li>
                <li><button onclick="register()" class="btn btn-outline">Register</button></li>
                </ul>
            </nav>
        </header>
    </div>

    <div class="display-container">
        <div class="display-transaction-type">
            <div>
                <h1><?php echo strtoupper($tname) ?></h1><!-- transaction name -->
            </div>
            <div>
                <h1 id="window">Window 3 <!-- placeholder --></h1>
            </div>
        </div>
        
        <div class="display-transaction-serving">
            <div>
                <h1>Now Serving</h1>
            </div>
            <div>
                <div><h1 id="sname">Number<!-- placeholder --></h1></div>
                <div><h1 id="squeue">420<!-- placeholder --></h1> </div>
            </div>
        </div>
    </div>
</body>
</html>
