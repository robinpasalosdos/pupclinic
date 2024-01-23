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

	function admin_login(){
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM admin where password = '".$password."' ");
		if($qry->num_rows > 0){
			$_SESSION['user'] = 'admin';
			return 1;
		}else{
			return 2;
		}
	}

	function faculty_login(){
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM users where email = '".$email."' and password = '".$password."' ");
		if($qry->num_rows > 0){
			$row = $qry->fetch_assoc();
			$id = $row['id'];
			$name = $row['name'];
			$_SESSION['user'] = 'faculty';
			$_SESSION['id'] = $id;
			$_SESSION['name'] = $name;
			$_SESSION['email'] = $email;
			return 1;
		}else{
			return 3;
		}
	}

	function student_login(){
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM users where email = '".$email."' and password = '".$password."' ");
		if($qry->num_rows > 0){
			$row = $qry->fetch_assoc();
			$id = $row['id'];
			$name = $row['name'];
			$_SESSION['user'] = 'student';
			$_SESSION['id'] = $id;
			$_SESSION['name'] = $name;
			$_SESSION['email'] = $email;
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
		header("location:../index.php?page=login_menu");
	}

	function student_register(){
		extract($_POST);
		$data = "user_type = 'student' ";
		$data .= ", name = '$name' ";
		$data .= ", email = '$email' ";
		$data .= ", student_no = '$student_no' ";
		$data .= ", course = '$course' ";
		$data .= ", year = '$year' ";
		$data .= ", section = '$section' ";
		$data .= ", password = '$password' ";
		
		$check = $this->db->query("SELECT email FROM users WHERE email='$email' LIMIT 1");
		if(mysqli_num_rows($check) == 1){
			return 2;
		}else{
			$save = $this->db->query("INSERT INTO users set ".$data);
			if($save)
			return 1;
		}
		
		
		
	}
	function faculty_register(){
		extract($_POST);
		$data = "user_type = 'faculty' ";
		$data .= ", name = '$name' ";
		$data .= ", email = '$email' ";
		$data .= ", student_no = '' ";
		$data .= ", course = '' ";
		$data .= ", year = '' ";
		$data .= ", section = '' ";
		$data .= ", password = '$password' ";
		
		$check = $this->db->query("SELECT email FROM users WHERE email='$email' LIMIT 1");
		if(mysqli_num_rows($check) == 1){
			return 2;
		}else{
			$save = $this->db->query("INSERT INTO users set ".$data);
			if($save)
			return 1;
		}
	}
	
	function guest_register(){
		extract($_POST);
		$_SESSION['user'] = 'guest';
		$_SESSION['name'] = $name;
		$_SESSION['email'] = $email;
		$_SESSION['id'] = 0;
		return 1;
	}
	
	function get_height(){
		exec('/usr/bin/python /var/www/html/pupclinic/hardware/height.py 2>&1', $output, $return_code);
		echo "Output: " . implode("\n", $output);
		echo "\nReturn code: " . $return_code;
		return $output;
	}
	
	function get_temp(){
		$output = shell_exec('/usr/bin/python3 /var/www/html/pupclinic/hardware/temp.py 2>&1');
		echo "Output: " . $output;
		return $output;
	}
	
	function save_height(){
		
		$user_type = $_SESSION['user'];
		extract($_POST);
		$id = intval($_SESSION['id']);
		$name = $_SESSION['name'];
		$email = $_SESSION['email'];
		$height = $data;
		$heart_rate = "";
		$oxygen = "";	
		$transaction_no = 100001;
		
		$result = $this->db->query("SELECT id FROM records ORDER BY id DESC LIMIT 1;");
		if ($result) {
			$row = $result->fetch_assoc();
			if ($row) {
				$last_id = $row['id'];
				$transaction_no += $last_id;
			}
		}


		$save = $this->db->query("INSERT INTO records (user_id, user_type, name, email, height, heart_rate, oxygen, transaction_no) VALUES ($id, '$user_type', '$name', '$email', '$height', '$heart_rate', '$oxygen', '$transaction_no');");
		$_SESSION['transaction_no'] = $transaction_no;
		return 1;
		
		
		$user_type = $_SESSION['user'];
		extract($_POST);
		$id = intval($_SESSION['id']);
		$name = $_SESSION['name'];
		$email = $_SESSION['email'];
		$height = $data;
		$heart_rate = "";
		$oxygen = "";	
		$transaction_no = 100001;
		
		$result = $this->db->query("SELECT id FROM records ORDER BY id DESC LIMIT 1;");
		if ($result) {
			$row = $result->fetch_assoc();
			if ($row) {
				$last_id = $row['id'];
				$transaction_no += $last_id;
			}
		}


		$save = $this->db->query("INSERT INTO records (user_id, user_type, name, email, height, heart_rate, oxygen, transaction_no) VALUES ($id, '$user_type', '$name', '$email', '$height', '$heart_rate', '$oxygen', '$transaction_no');");
		$_SESSION['transaction_no'] = $transaction_no;
		return 1; 



	}
	
	function get_heart_rate(){
		exec('/usr/bin/python /var/www/html/pupclinic/hardware/height.py 2>&1', $output, $return_code);
		echo "Output: " . implode("\n", $output);
		echo "\nReturn code: " . $return_code;
		return $output;
	}
	
	function save_heart_rate(){
		extract($_POST);
		$id = intval($_SESSION['id']);
		$transaction_no = $_SESSION['transaction_no'];
		$save = $this->db->query("UPDATE records SET heart_rate = '$data' WHERE transaction_no = $transaction_no;");
		return $save;
	}
	
	function get_oxygen(){
		exec('/usr/bin/python /var/www/html/pupclinic/hardware/height.py 2>&1', $output, $return_code);
		echo "Output: " . implode("\n", $output);
		echo "\nReturn code: " . $return_code;
		return $output;
	}
	
	function get_all_data(){
		extract($_POST);
		$prefix = "PUP";
		$suffix = "CLI";
		$transaction_no = $_SESSION['transaction_no'];
		$query = $this->db->query("SELECT * FROM records WHERE transaction_no = $transaction_no;");
		if($query->num_rows > 0){
			foreach ($query->fetch_array() as $key => $value){
				if(!is_numeric($key)){
					$data[$key] = $value;
				}
			}
			$data['transaction_no'] = $prefix . $transaction_no . $suffix;
			return json_encode(array('status'=>1,"data"=>$data));
		}else{
			return json_encode(array('status'=>0));
		}
	}
	
	function delete_record(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM records where id = ".$id);
		if($delete)
			return 1;
		return $id;
	}
	
	function delete_user(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = ".$id);
		if($delete)
			return 1;
		return $id;
	}


		

}
