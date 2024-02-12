<?php
session_start();
ini_set('display_errors', 1);
use PHPMailer\PHPMailer\PHPMailer;
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
		$qry = $this->db->query("SELECT * FROM admin where password = '".md5($password)."' ");
		if($qry->num_rows > 0){
			$_SESSION['user'] = 'admin';
			return 1;
		}else{
			return 2;
		}
	}

	function faculty_login(){
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM users where email = '$email' and password = '".md5($password)."' and user_type = 'faculty' ");
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
		$qry = $this->db->query("SELECT * FROM users where email = '$email' and password = '".md5($password)."' and user_type = 'student' ");
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
		header("location:../index.php?page=landing_page");
	}

	function student_register(){
		extract($_POST);
		$name = $_SESSION['name'];
		$birthday = $_SESSION['birthday'];
		$sex = $_SESSION['sex'];
		$student_no = $_SESSION['student_no'];
		$course = $_SESSION['course'];
		$year = $_SESSION['year'];
		$section = $_SESSION['section'];
		$email = $_SESSION['email'];
		$password = $_SESSION['password'];
		if($_SESSION['code'] != $code){
			return 2;
		}else{
			$hashed_password = md5($password);
			$save = $this->db->query("INSERT INTO users (user_type, name, birthday, sex, email, student_no, course, year, section, password, assessment_access, pic) VALUES ('student', '$name', '$birthday', '$sex', '$email', '$student_no', '$course', '$year', '$section', '$hashed_password', 0, 'default.png')");
			if($save){
				session_destroy();
				return 1;
			}
		}
	}
	function faculty_register(){
		extract($_POST);
		$name = $_SESSION['name'];
		$birthday = $_SESSION['birthday'];
		$sex = $_SESSION['sex'];
		$email = $_SESSION['email'];
		$password = $_SESSION['password'];
		if($_SESSION['code'] != $code){
			return 2;
		}else{
			$hashed_password = md5($password);
			$save = $this->db->query("INSERT INTO users (user_type, name, birthday, sex, email, student_no, course, year, section, password, assessment_access, pic) VALUES ('faculty', '$name', '$birthday', '$sex', '$email', '', '', '', '', '$hashed_password', 0, 'default.png')");
			if($save){
				session_destroy();
				return 1;
			}
			
		}
		
	}
	
	function guest_register(){
		extract($_POST);
		$save = $this->db->query("INSERT INTO guest (name, birthday, sex, email, assessment_access) VALUES ('$name', '$birthday', '$sex', '$email', 0)");
		if($save){
			$_SESSION['user'] = 'guest';
			$_SESSION['name'] = $name;
			$_SESSION['email'] = $email;
			$_SESSION['sex'] = $sex;
			$_SESSION['birthday'] = $birthday;
			$result = $this->db->query("SELECT id FROM guest ORDER BY id DESC LIMIT 1;");
			if ($result) {
				$row = $result->fetch_assoc();
				if ($row) {
					$_SESSION['id'] = $row['id'];
				}
			}
			return 1;
		}
	}

	function add_user(){
		extract($_POST);
		if($password != $password2){
			return 3;
		}else{
			$check = $this->db->query("SELECT email FROM users WHERE email='$email' LIMIT 1");
			if(mysqli_num_rows($check) == 1){
				return 2;
			}else{
				if($user_type == 'student'){
					$save = $this->db->query("INSERT INTO users (user_type, name, birthday, sex, email, student_no, course, year, section, password) VALUES ('student', '$name', '$birthday', '$sex', '$email', '$student_no', '$course', '$year', '$section', '".md5($password)."')");
					if($save){
						return 1;
					}
				}else{
					$save = $this->db->query("INSERT INTO users (user_type, name, birthday, sex, email, student_no, course, year, section, password) VALUES ('faculty', '$name', '$birthday', '$sex', '$email', '', '', '', '', '".md5($password)."')");
					if($save){
						return 1;
					}
				}
				
			}
		}
	}
	
	function get_height(){
		exec('/usr/bin/python /var/www/html/pupclinic/hardware/height.py 2>&1', $output, $return_code);
		echo "Output: " . implode("\n", $output);
		echo "\nReturn code: " . $return_code;
		return $output;
	}
	
	function save_height(){
		extract($_POST);
		$_SESSION['height'] = $data;
		return $this->update_queue_data($data, "height");
	}
	
	function get_temp(){
		exec('/usr/bin/python /var/www/html/pupclinic/hardware/temp.py 2>&1', $output, $return_code);
		echo "Output: " . implode("\n", $output);
		echo "\nReturn code: " . $return_code;
		return $output;
	}
	
	function save_temp(){
		extract($_POST);
		$_SESSION['temp'] = $data;
		return $this->update_queue_data($data, "temp");
	}
	
	function get_heart_rate(){
		exec('/usr/bin/python /var/www/html/pupclinic/hardware/heart_rate.py 2>&1', $output, $return_code);
		echo "Output: " . implode("\n", $output);
		echo "\nReturn code: " . $return_code;
		return $output;
	}
	
	function save_heart_rate(){	
		extract($_POST);
		$_SESSION['heart_rate'] = $data;
		return $this->update_queue_data($data, "heart_rate");
	}
	
	function get_oxygen(){
		exec('/usr/bin/python /var/www/html/pupclinic/hardware/oxygen.py 2>&1', $output, $return_code);
		echo "Output: " . implode("\n", $output);
		echo "\nReturn code: " . $return_code;
		return $output;
	}
	
	function save_oxygen(){	
		extract($_POST);
		$_SESSION['oxygen'] = $data;
		return $this->update_queue_data($data, "oxygen");
	}

	function update_queue_data($data, $vital_sign){
		$id = $_SESSION['id'];
		$user_type = $_SESSION['user'];
		if($user_type == "guest"){
			$update = $this->db->query("UPDATE queue 
				SET ".$vital_sign." = '$data'
				WHERE user_id = $id
				AND user_type = 'guest';");
			if($update){
				return 1;
			}
		}else{
			$update = $this->db->query("UPDATE queue 
				SET ".$vital_sign." = '$data' 
				WHERE user_id = $id
				AND (user_type = 'student'
				OR user_type = 'faculty');");
			if($update){
				return 1;
			}
		}
	}
	
	function get_all_data(){
		extract($_POST);	
		$transaction_no = 100001;
		
		$result = $this->db->query("SELECT id FROM records ORDER BY id DESC LIMIT 1;");
		if ($result) {
			$row = $result->fetch_assoc();
			if ($row) {
				$last_id = $row['id'];
				$transaction_no += $last_id;
			}
		}
		
		$_SESSION['transaction_no'] = $transaction_no;
		$data['user_type'] = $_SESSION['user'];
		$data['id'] = intval($_SESSION['id']);
		$data['name'] = $_SESSION['name'];
		$data['email'] = $_SESSION['email'];
		$data['height'] = $_SESSION['height'];
		$data['temp'] = $_SESSION['temp'];
		$data['heart_rate'] = $_SESSION['heart_rate'];
		$data['oxygen'] = $_SESSION['oxygen'];
		$prefix = "PUP";
		$suffix = "CLI";
		$data['transaction_no'] = $prefix . $transaction_no . $suffix;
		return json_encode(array('status'=>1,"data"=>$data));
	}
	
	function save_all_data(){
		extract($_POST);
		$user_type = $_SESSION['user'];
		$id = intval($_SESSION['id']);
		$name = $_SESSION['name'];
		$email = $_SESSION['email'];
		$height = $_SESSION['height'];
		$temp = $_SESSION['temp'];
		$heart_rate = $_SESSION['heart_rate'];
		$oxygen = $_SESSION['oxygen'];	
		$transaction_no = $_SESSION['transaction_no'];
		$assessment_status = 1;
		$save = $this->db->query("INSERT INTO records (user_id, user_type, name, email, height, temp, heart_rate, oxygen, transaction_no, assessment_status) VALUES ($id, '$user_type', '$name', '$email', '$height', '$temp', '$heart_rate', '$oxygen', '$transaction_no', '$assessment_status');");
		$_SESSION['height'] = "";
		$_SESSION['temp'] = "";
		$_SESSION['heart_rate'] = "";
		$_SESSION['oxygen'] = "";
		$_SESSION['transaction_no'] = "";
		$delete = $this->db->query("DELETE FROM queue WHERE name <> '';");
		return 1;
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
	
	function create_initial_record(){
		$id = intval($_SESSION['id']);
		$name = $_SESSION['name'];
		$user_type = $_SESSION['user'];
		$result = $this->db->query("SELECT user_id FROM queue where user_id = $id AND (user_type = 'student' OR user_type = 'faculty')");
		if($result->num_rows < 1){
			$save = $this->db->query("INSERT INTO queue (user_id, name, user_type) VALUES ($id, '$name', '$user_type');");
			if($save){
			return 1;
			}	
		}else{
			$result = $this->db->query("SELECT user_id FROM queue where user_id = $id and user_type = 'guest'");
			if($result->num_rows < 1){
				$save = $this->db->query("INSERT INTO queue (user_id, name, user_type) VALUES ($id, '$name', '$user_type');");
				if($save){
					return 1;
				}
			}
		}
			
	}
	
	function display_ongoing_check_up(){
		$result = $this->db->query("SELECT * FROM queue ORDER BY date DESC LIMIT 1;");
		$row = $result->fetch_assoc();
		if ($row['name'] != "") {
			return json_encode(array('status'=>1,"data"=>$row));
		}else{
			return json_encode(array('status'=>0));
		}
	}
	
	function delete_ongoing(){
		$result = $this->db->query("DELETE FROM queue WHERE name <> '';");
		return 1;
	}

	function give_access() {
		extract($_POST);
		$id = $_POST['id'];
		$sql = "UPDATE queue SET assessment_access = 1 WHERE id = $id";
	
		if ($this->db->query($sql) === TRUE) {
			echo "1";
		} else {
			echo "Error updating record: " . $this->db->error;
		}
	}
	
	
	function display_realtime_records(){

		/* $query = "SELECT * FROM records WHERE assessment_status = 0;"; */
		$query = "SELECT * FROM records;";  
		$query_run = mysqli_query($this->db, $query);

		$contents = "<table>
						<thead>
							<tr>
								<th>Name</th>
								<th>User Type</th>
								<th>Height (cm)</th>
								<th>Temp (℃)</th>
								<th>Heart Rate (bpm)</th>
								<th>Oxygen (%)</th>
								<th>Transaction no.</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>";

		if(mysqli_num_rows($query_run) > 0)
		{
			foreach($query_run as $items)
			{
				$id = $items['id'];
				$contents .= "<tr>
								<td>{$items['name']}</td>
								<td>{$items['user_type']}</td>
								<td>{$items['height']}</td>
								<td>{$items['temp']}</td>
								<td>{$items['heart_rate']}</td>
								<td>{$items['oxygen']}</td>
								<td>PUP-{$items['transaction_no']}-CLI</td>
								<td><button class=\"assess\">Assess</button></td>
							  </tr>";
			}
		}

		$contents .= "</tbody>
					</table>";
		if ($query_run) {
			return json_encode(array('status'=>1,"contents"=>$contents,"id"=>$id));
		}else{
			return json_encode(array('status'=>0));
		}
	}
	function send_otp(){
		extract($_POST);
		if($password != $password2){
			return 3;
		}else{
			if (!preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password) || strlen($password) < 8) {
				return 4;
			}else {
				if (strpos($email, '@') === false || strpos($email, '.') === false) {
					return 5;
				}else{
					$check = $this->db->query("SELECT email FROM users WHERE email='$email' LIMIT 1");
					if(mysqli_num_rows($check) == 1){
						return 2;
					}else{
						$_SESSION['register'] = $user;
						$_SESSION['name'] = $name;
						$_SESSION['birthday'] = $birthday;
						$_SESSION['sex'] = $sex;
						if($user == 'student'){
							$_SESSION['student_no'] = $student_no;
							$_SESSION['course'] = $course;
							$_SESSION['year'] = $year;
							$_SESSION['section'] = $section;
						}
						$_SESSION['email'] = $email;
						$_SESSION['password'] = $password;
						$randOtpNum = rand(100000, 999999);
						$randOtp = strval($randOtpNum);
						$_SESSION['code'] = $randOtp;
						$_SESSION['email'] = $email;
						return $this->send_code($email);
					}
				}
			}
		}
	}

	function forgot_password1(){
		extract($_POST);
		$check = $this->db->query("SELECT email FROM users WHERE email='$email' LIMIT 1");
		if(mysqli_num_rows($check) == 1){
			$_SESSION['email'] = $email;
			return $this->send_code($email);
		}else{
			return 2;
		}
	}

	function forgot_password2(){
		extract($_POST);
		if($_SESSION['code'] == $code){
			return 1;
		}else{
			return 2;
		}
	}

	function forgot_password3(){
		extract($_POST);
		$email = $_SESSION['email'];
		if($password == $password2){
			$update = $this->db->query("UPDATE users SET password = '$password' WHERE email = '$email';");
			if($update){
				$result = $this->db->query("SELECT user_type FROM users WHERE email = '$email';");
				$row = $result->fetch_assoc();
				session_destroy();
				return $row['user_type'];
			}else{
				return 0;
			}

		}else{
			return 2;
		}
	}

	function update_user(){
		extract($_POST);
		if($u_password == $u_password2){
			if($u_password == ""){
				$u_password = $u_password3;
			}else{
				$u_password = md5($u_password3);
			}
			if($u_user_type == 'student'){
				$update = $this->db->query("UPDATE users 
				SET name = '$u_name', 
					birthday = '$u_birthday', 
					sex = '$u_sex', 
					student_no = '$u_student_no', 
					course = '$u_course', 
					year = '$u_year', 
					section = '$u_section', 
					password = '$u_password' 
				WHERE id = ".intval($u_id).";");
				if($update){
					return 1;
				}else{
					return 0;
				}
			}else{
				$update = $this->db->query("UPDATE users 
				SET name = '$u_name', 
					birthday = '$u_birthday', 
					sex = '$u_sex',
					password = '$u_password' 
				WHERE id = ".intval($u_id).";");
				if($update){
					return 1;
				}else{
					return 0;
				}
			}
				
			
			
		}else{
			return 2;
		}
	}

	function send_code($email){
		$subject = "OTP";
		$randOtpNum = rand(100000, 999999);
		$randOtp = strval($randOtpNum);
		$message = "Your Code: $randOtp";
		$resp = $this->send_email($subject, $email, $message);
		if(substr($resp, -1) == "1"){
			$_SESSION['code'] = $randOtp;
			return 1;
		}else{
			return 0;
		}
	}

	function send_email($subject, $email, $message){
		require 'vendor/phpmailer/phpmailer/src/Exception.php';
		require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
		require 'vendor/phpmailer/phpmailer/src/SMTP.php';
		require 'vendor/autoload.php';
		$mail = new PHPMailer();
		$emailStr = strval($email);
		$messageStr = strval($message);
		$mail->IsSMTP();
		$mail->Mailer = "smtp";
		$mail->SMTPDebug  = 1;  
		$mail->SMTPAuth   = TRUE;
		$mail->SMTPSecure = "tls";
		$mail->Port       = 587;
		$mail->Host       = "smtp.gmail.com";
		$mail->Username   = "pupclinic01@gmail.com";
		$mail->Password   = "yrpb rdmp apec ymku";
		$mail->IsHTML(true);
		$mail->AddAddress("$emailStr", "You");
		$mail->SetFrom("pupclinic01@gmail.com", "PUPClinic");
		$mail->Subject = $subject;
		$mail->MsgHTML($messageStr);
		if (!filter_var($emailStr, FILTER_VALIDATE_EMAIL)) {
			return 6;
		} 
		if(!$mail->Send()) {
			return 0;
		} else {
			return 1;
		}
	}

	function upload_profile_pic(){
		if(isset($_FILES["image"]["name"])){
			$email = $_POST["profileEmail"];
			$name = $_POST["profileName"];
	
			$imageName = $_FILES["image"]["name"];
			$imageSize = $_FILES["image"]["size"];
			$tmpName = $_FILES["image"]["tmp_name"];
	
			$validImageExtension = ['jpg', 'jpeg', 'png'];
			$imageExtension = explode('.', $imageName);
			$imageExtension = strtolower(end($imageExtension));
			if (!in_array($imageExtension, $validImageExtension)){
				echo "diff";
			}
			elseif ($imageSize > 1200000){
				echo "max";
			}
			else{
				$newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa") . '.' . $imageExtension;
				$destinationDirectory = 'profile_pic/';
	
				if (!file_exists($destinationDirectory)) {
					mkdir($destinationDirectory, 0777, true);
					chmod($destinationDirectory, 0777);
				}
	
				if(move_uploaded_file($tmpName, $destinationDirectory . $newImageName)) {
					$query = "UPDATE users SET pic = '$newImageName' WHERE email = '$email'";
					mysqli_query($this->db, $query);
					echo 0;
				} else {
					echo "Error uploading file.";
				}
			}
		}
	}

	function remove_queue(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM queue where id = ".$id);
		if($delete)
			return 1;
		return $id;
	}
	
	
}
