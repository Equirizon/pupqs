<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".md5($password)."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'passwors' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
				return 1;
		}else{
			return 3;
		}
	}
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:../index.php?page=login");
	}

	function save_user(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", username = '$username' ";
		if(!empty($password))
		$data .= ", password = '".md5($password)."' ";
		$data .= ", type = '$type' ";
		$data .= ", window_id = '$window_id' ";
		$chk = $this->db->query("Select * from users where username = '$username' and id !='$id' ")->num_rows;
		if($chk > 0){
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set ".$data);
		}else{
			$save = $this->db->query("UPDATE users set ".$data." where id = ".$id);
		}
		if($save){
			return 1;
		}
	}
	function delete_user(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = ".$id);
		if($delete)
			return 1;
	}
	function signup(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", contact = '$contact' ";
		$data .= ", address = '$address' ";
		$data .= ", username = '$email' ";
		$data .= ", password = '".md5($password)."' ";
		$data .= ", type = 3";
		$chk = $this->db->query("SELECT * FROM users where username = '$email' ")->num_rows;
		if($chk > 0){
			return 2;
			exit;
		}
			$save = $this->db->query("INSERT INTO users set ".$data);
		if($save){
			$qry = $this->db->query("SELECT * FROM users where username = '".$email."' and password = '".md5($password)."' ");
			if($qry->num_rows > 0){
				foreach ($qry->fetch_array() as $key => $value) {
					if($key != 'passwors' && !is_numeric($key))
						$_SESSION['login_'.$key] = $value;
				}
			}
			return 1;
		}
	}
	function save_transaction(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", department = '$department' ";
		$cwhere ='';
		if(!empty($id)){
			$cwhere = " and id != $id ";
		}
		$chk =  $this->db->query("SELECT * FROM transactions where name = '$name' and department = '$department' ".$cwhere)->num_rows;
		if($chk > 0){
			return 3;
			exit;
		}
		if(empty($id)){
			$this->db->query("INSERT INTO transactions set ".$data);
			return 1;
		}else{
			$this->db->query("UPDATE transactions set ".$data." where id=".$id);
			return 2;
		}
	}
	function delete_transaction(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM transactions where id = ".$id);
		if($delete)
			return 1;
	}
	
	function save_window(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", transaction_id = '$transaction_id' ";
		$cwhere ='';
		if(!empty($id)){
			$cwhere = " and id != $id ";
		}
		$chk =  $this->db->query("SELECT * FROM transaction_windows where name = '$name' and transaction_id = '$transaction_id' ".$cwhere)->num_rows;
		if($chk > 0){
			return 3;
			exit;
		}
		if(empty($id)){
			$this->db->query("INSERT INTO transaction_windows set ".$data);
			return 1;
		}else{
			$this->db->query("UPDATE transaction_windows set ".$data." where id=".$id);
			return 2;
		}
			
	}
	function delete_window(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM transaction_windows where id = ".$id);
		if($delete)
			return 1;
	}
function save_queue(){
		date_default_timezone_set('Asia/Manila');
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", transaction_id = '$transaction_id' ";
		$data .= ", student_no = '$student_no' ";
		$queue_no = 1001;
		$chk = $this->db->query("SELECT * FROM queue_list where transaction_id = $transaction_id and date(date_created) = '".date("Y-m-d")."' ")->num_rows;
		if($chk > 0){
			$queue_no += $chk;
		}
		$data .= ", queue_no = '$queue_no' ";
		
			$save = $this->db->query("INSERT INTO queue_list set ".$data);

		if($save)
			return $this->db->insert_id;
	}
	function get_queue(){
		date_default_timezone_set('Asia/Manila');
		extract($_POST);
		$query = $this->db->query("SELECT q.*,t.name as wname FROM queue_list q inner join transaction_windows t on t.id = q.window_id where date(q.date_created) = '".date('Y-m-d')."' and q.transaction_id = '$id' and q.status = 1 order by q.id desc limit 1 ");
		if($query->num_rows > 0){
		foreach ($query->fetch_array() as $key => $value) {
			if(!is_numeric($key))
			$data[$key] = $value;
		}
			return json_encode(array('status'=>1,"data"=>$data));
		}else{
			return json_encode(array('status'=>0));

		}
	}

	function update_queue(){
		date_default_timezone_set('Asia/Manila');
		$tid = $this->db->query("SELECT * FROM transaction_windows where id =".$_SESSION['login_window_id'])->fetch_array()['transaction_id'];

	    $this->db->query("UPDATE queue_list set status = 1 , window_id = '".$_SESSION['login_window_id']."' where transaction_id = '$tid' and  date(date_created) = '".date('Y-m-d')."' and status=0 order by id asc limit 1");

	    $query = $this->db->query("SELECT q.*,t.name as wname FROM queue_list q inner join transaction_windows t on t.id = q.window_id where date(q.date_created) = '".date('Y-m-d')."' and q.window_id = '".$_SESSION['login_window_id']."' and q.status = 1 order by q.id desc limit 1  ");
	    if($query->num_rows > 0){
	        foreach ($query->fetch_array() as $key => $value) {
	            if(!is_numeric($key))
	            $data[$key] = $value;
	        }
	        return json_encode(array('status'=>1,"data"=>$data));
	    }else{
	        return json_encode(array('status'=>0));

	    }
	}
	function get_wqueue(){
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM transaction_windows where transaction_id = '62'");
		if($qry->num_rows > 0){
			$data = mysqli_fetch_all($qry,MYSQLI_ASSOC);
			return json_encode($data);
		}
	}
	function display_queue(){
		date_default_timezone_set('Asia/Manila');
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
		$qry = $this->db->query("SELECT * FROM queue_list where transaction_id = '".$transaction_id."' AND date(date_created) BETWEEN '".$date1."' AND '".$date2."'");
		while($row=mysqli_fetch_assoc($qry)){
			$contents .= "<tr>
			<td>".$i++."</td>
			<td>".$row['name']."</td>
			<td>".$row['queue_no']."</td>
			<td>".date("m/d/Y",strtotime($row['created_timestamp']))."</td>
			<td>".date("h:i a",strtotime($row['created_timestamp']))."</td>
			</td>
		  </tr>";
		}
		$contents .= "</tbody>
		</table>";
		echo $contents;
	}
	function display_graph(){
		date_default_timezone_set('Asia/Manila');
		$transaction_id = $_POST['transaction_id'];
		$date1 = date("Y-m-d",strtotime($_POST['date1']));
		$date2 = date("Y-m-d",strtotime($_POST['date2']));
		$i = 1;
		$dates = array();
		$no_per_day = array();
		$diff = floor((strtotime($date2)  - strtotime($date1))/(24*60*60));
		for($x = 0; $x <= $diff; $x++){
			$dates[$x] = $date1;
			$qry = $this->db->query("SELECT * FROM queue_list where transaction_id = '".$transaction_id."' AND date(date_created) = '".$date1."'");
			$no_per_day[$x] = $qry->num_rows;
			$date1 = date("Y-m-d",strtotime($date1.' +1 day'));

		}
		echo json_encode(array('no_per_day'=>$no_per_day,"dates"=>$dates));
		exit();
	}

}