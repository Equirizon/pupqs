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
<div>
    Dashboard<br>
    <input type="date">
    <h4>Pending Transactions</h4>
    <h3 id="active_transactions"><?php echo $pending_transactions_run?></h3>
    <h4>Complete Transaction</h4>
    <h3 id="complete_transaction"><?php echo $complete_transactions_run?></h3>
    <h4>Window</h4>
    <h3 id="windows"><?php echo $windows_run?></h3>
</div>