<?php  


include 'db_connect.php';
    
if(isset($_POST["export"]))
{
    $transaction_id = $_POST['transaction_id'];
    $date1 = date("Y-m-d",strtotime($_POST['date1']));
    $date2 = date("Y-m-d",strtotime($_POST['date2']));
    $i = 1;
    $contents = "<table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Queue No.</th>
              <th>Date</th>
				      <th>Time</th>
            </tr>
          </thead>
          <tbody>";
    $qry = $conn->query("SELECT * FROM queue_list where transaction_id = '".$transaction_id."' AND date(date_created) BETWEEN '".$date1."' AND '".$date2."'");
    while($row=mysqli_fetch_assoc($qry)){
        $contents .= "<tr>
        <td>".$i++."</td>
        <td>".$row['name']."</td>
        <td>".$row['queue_no']."</td>
        <td>".date("m/d/Y",strtotime($row['created_timestamp']))."</td>
			  <td>".date("h:i a",strtotime($row['created_timestamp']))."</td>
      </tr>";
    }
    $contents .= "</tbody>
    </table>";
    header("Content-Type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=download.xls");      
    echo $contents;
}
?>
