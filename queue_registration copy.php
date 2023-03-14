<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="admin/SDK.css">
</head>
<?php include "admin/db_connect.php" ?>
<body class="reqistration-body">
    
    <div class="display-background">
        <img src="assets/banner3.jpg" alt="bg">
    </div>

    <div class="registration-container">
        <div>    
            <h1> Register </h1>
        </div>
        <div class="registration-form-container">
            <form action="" id="new_queue">
                <div>
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name">
                </div>
                <div>
                    <label for="transaction_id">Transaction</label>
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
                <div>
                    <label for="window">Window</label>
                    <select name="window" id="window" require>
                            <option></option>
                            <?php 
                                $selected = $_COOKIE['selected'];
                                $tran_selected = $conn->query("SELECT id FROM transaction_windows where name = $selected");
                                $row=$tran_selected->fetch_row();
                                $win = $conn->query("SELECT * FROM transaction_windows where transaction_id = $row[0] status = 1 order by name asc");
                                while($row=$win->fetch_assoc()):
                            ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                            <?php endwhile; ?>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button>Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</body>
<script>
    $('#window_div').hide()
    $('#window').change(function(){
        document.cookie="selected=".$(this).val()

	})
    $('#transaction_id').change(function(){
		if($(this).val() == ""){
			$('#window_div').hide()
		}else{
			$('#window_div').show()
		}
	})
        $('#new_queue').submit(function(e){
            e.preventDefault()
            var name = $("#name").val().trim();
            if(name == ""){
                alert("Insert name!");
            }
            else{
                if($('#transaction_id').val() == ""){
                    alert("Select Transaction!");
                }
                else{
                    $.ajax({
                        url:'admin/ajax.php?action=save_queue',
                        method:'POST',
                        data:$(this).serialize(),
                        error:function(err){
                            console.log(err)
                            alert("An error occured");
                        },
                        success:function(resp){
                            if(resp > 0){
                                $('#name').val('')
                                var nw = window.open("queue_print.php?id="+resp,"_blank","height=500,width=800")
                                nw.print()
                                setTimeout(function(){
                                    nw.close()
                                },1500)
                            
                            }
                        }
                    })
                }
            }
        })
    </script>
</html>
