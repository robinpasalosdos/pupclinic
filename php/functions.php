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
						$hashed_password = md5($password);
						$save = $this->db->query("INSERT INTO users (user_type, name, birthday, sex, email, student_no, course, year, section, password, assessment_access, verified, pic) VALUES ('student', '$name', '$birthday', '$sex', '$email', '$student_no', '$course', '$year', '$section', '$hashed_password', 0, 0, 'default.png')");
						if($save){
							return 1;
						}
					}
				}
			}
		}
		
	}
	function faculty_register(){
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
						$hashed_password = md5($password);
						$save = $this->db->query("INSERT INTO users (user_type, name, birthday, sex, email, student_no, course, year, section, password, assessment_access, verified, pic) VALUES ('faculty', '$name', '$birthday', '$sex', '$email', '', '', '', '', '$hashed_password', 0, 0, 'default.png')");
						if($save){
							return 1;
						}	
					}
				}
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
		}
		else{
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
						if($user_type == 'student'){
							$save = $this->db->query("INSERT INTO users (user_type, name, birthday, sex, email, student_no, course, year, section, password, assessment_access, verified, pic) VALUES ('student', '$name', '$birthday', '$sex', '$email', '$student_no', '$course', '$year', '$section', '".md5($password)."', 0, 0, 'default.png')");
							if($save){
								return 1;
							}
						}else{
							$save = $this->db->query("INSERT INTO users (user_type, name, birthday, sex, email, student_no, course, year, section, password, assessment_access, verified, pic) VALUES ('faculty', '$name', '$birthday', '$sex', '$email', '', '', '', '', '".md5($password)."', 0, 0, 'default.png')");
							if($save){
								return 1;
							}
						}
						
					}
				}
			}
			
		}
	}
	
	function get_height(){
		$output = shell_exec('sudo /usr/bin/python3 /var/www/html/pupclinic/hardware/height.py');
		echo $output;

	}
	
	function save_height(){
		extract($_POST);
		$_SESSION['height'] = $height;
		$_SESSION['weight'] = $weight;
		$id = $_SESSION['id'];
		$user_type = $_SESSION['user'];
		if($user_type == "guest"){
			$update = $this->db->query("UPDATE queue 
				SET height = '$height', weight = '$weight'
				WHERE user_id = $id
				AND user_type = 'guest';");
			if($update){
				return 1;
			}
		}else{
			$update = $this->db->query("UPDATE queue 
				SET height = '$height', weight = '$weight'
				WHERE user_id = $id
				AND (user_type = 'student'
				OR user_type = 'faculty');");
			if($update){
				return 1;
			}
		}
	}
	
	function get_weight(){
		$output = shell_exec('sudo /usr/bin/python3 /var/www/html/pupclinic/hardware/weight.py');
		echo $output;
	}
	
	function save_weight(){
		extract($_POST);
		$_SESSION['weight'] = $data;
		return $this->update_queue_data($data, "weight");
	}
	function get_temp(){
		$output = shell_exec('sudo /usr/bin/python3 /var/www/html/pupclinic/hardware/temp.py');
		echo $output;
	}
	
	function save_temp(){
		extract($_POST);
		$_SESSION['temp'] = $resp;
		return $this->update_queue_data($resp, "temp");
	}

	function get_bp(){
		$output = shell_exec('sudo /usr/bin/python3 /var/www/html/pupclinic/hardware/temp.py');
		echo $output;
	}
	
	function save_bp(){
		extract($_POST);
		$_SESSION['bp'] = $resp;
		return $this->update_queue_data($resp, "bp");
	}
	
	function get_heart_rate(){
		$output = shell_exec('sudo /usr/bin/python3 /var/www/html/pupclinic/hardware/heart_rate.py');
		echo $output;
	}
	
	function save_heart_rate(){	
		extract($_POST);
		$_SESSION['heart_rate'] = $heart_rate;
		$_SESSION['bp'] = $bp;
		$id = $_SESSION['id'];
		$user_type = $_SESSION['user'];
		if($user_type == "guest"){
			$update = $this->db->query("UPDATE queue 
				SET heart_rate = '$heart_rate', bp = '$bp'
				WHERE user_id = $id
				AND user_type = 'guest';");
			if($update){
				return 1;
			}
		}else{
			$update = $this->db->query("UPDATE queue 
				SET heart_rate = '$heart_rate', bp = '$bp'
				WHERE user_id = $id
				AND (user_type = 'student'
				OR user_type = 'faculty');");
			if($update){
				return 1;
			}
		}
	}
	
	function get_oxygen(){
		$output = shell_exec('sudo /usr/bin/python3 /var/www/html/pupclinic/hardware/oxygen.py');
		echo $output;
	}
	
	function save_oxygen(){	
		extract($_POST);
		$_SESSION['oxygen'] = $resp;
		return $this->update_queue_data($resp, "oxygen");
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
		$height = intval($_SESSION['height']);
		$height_m = $height / 100;
		$weight = intval($_SESSION['weight']);
		$_SESSION['transaction_no'] = $transaction_no;
		$data['user_type'] = $_SESSION['user'];
		$data['id'] = intval($_SESSION['id']);
		$data['name'] = $_SESSION['name'];
		$data['email'] = $_SESSION['email'];
		$data['height'] = $height;
		$data['weight'] = $weight;
		$data['bmi'] = number_format($weight/($height_m * $height_m), 2);
		$data['temp'] = $_SESSION['temp'];
		$data['heart_rate'] = $_SESSION['heart_rate'];
		$data['oxygen'] = $_SESSION['oxygen'];
		$data['bp'] = $_SESSION['bp'];
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
		$height = intval($_SESSION['height']);
		$height_m = $height / 100;
		$weight = intval($_SESSION['weight']);
		$bmi = number_format($weight/($height_m * $height_m), 2);
		$temp = $_SESSION['temp'];
		$heart_rate = $_SESSION['heart_rate'];
		$oxygen = $_SESSION['oxygen'];	
		$bp = $_SESSION['bp'];	
		$transaction_no = $_SESSION['transaction_no'];
		$assessment_status = 1;
		$save = $this->db->query("INSERT INTO records (user_id, user_type, name, email, height, weight, bmi, temp, heart_rate, oxygen, bp, transaction_no, assessment_status) VALUES ($id, '$user_type', '$name', '$email', '$height', '$weight', '$bmi', '$temp', '$heart_rate', '$oxygen', '$bp', '$transaction_no', '$assessment_status');");
		if ($user_type == "guest"){
			$sql = $this->db->query("UPDATE guest SET 
			heart_rate = '$heart_rate',
			oxygen = '$oxygen',
			bp = '$bp',
			temp = '$temp',
			height = '$height',
			weight = '$weight',
			bmi = '$bmi',
			assessment_access = 0  
			WHERE id = $id");
		}else{
			$sql = $this->db->query("UPDATE users SET 
			assessment_access = 0  
			WHERE id = $id");
		}
		$_SESSION['height'] = "";
		$_SESSION['temp'] = "";
		$_SESSION['heart_rate'] = "";
		$_SESSION['oxygen'] = "";
		$_SESSION['transaction_no'] = "";
		$delete = $this->db->query("DELETE FROM queue WHERE user_id = $id;");
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
			if ($user_type == "guest"){
				$sql1 = "UPDATE guest SET assessment_access = 1 WHERE id = $user_id";
			}else{
				$sql1 = "UPDATE users SET assessment_access = 1 WHERE id = $user_id";
			}
			
			if ($this->db->query($sql1) === TRUE) {
				return $user_type;
			}else{
				return "Error updating record: " . $this->db->error;
			}
		} else {
			return "Error updating record: " . $this->db->error;
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
			if (!preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password) || strlen($password) < 8) {
				return 4;
			}else{
				$hashed_password = md5($password);
				$update = $this->db->query("UPDATE users SET password = '$hashed_password' WHERE email = '$email';");
				if($update){
					$result = $this->db->query("SELECT user_type FROM users WHERE email = '$email';");
					$row = $result->fetch_assoc();
					session_destroy();
					return $row['user_type'];
				}else{
					return 0;
				}
			}
		}else{
			return 2;
		}
	}

	function verify_email(){
		extract($_POST);
		$id = $_SESSION['id'];
		if($_SESSION['code'] == $code){
			$update = $this->db->query("UPDATE users SET verified = 1 WHERE id = $id;");
			$_SESSION['code'] = "";
			return 0;
		}else{
			return 7;
		}
	}

	function profile_send_code(){
		extract($_POST);
		return $this->send_code($email);
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
					password = '$u_password',
					email = '$u_email'
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
					password = '$u_password',
					email = '$u_email' 
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
		if($delete){
			
			if ($user_type == "guest"){
				$sql = $this->db->query("UPDATE guest SET 
				assessment_access = 0  
				WHERE id = $user_id");
			}else{
				$sql = $this->db->query("UPDATE users SET 
				assessment_access = 0  
				WHERE id = $user_id");
			}
			return 1;
		}
		return $id;	
	}

	function save_discomfort_rate() {
		extract($_POST);
		$id = intval($_SESSION['id']);
		$name = $_SESSION['name'];
		$user_type = $_SESSION['user'];
		$result = $this->db->query("SELECT user_id FROM queue WHERE user_id = $id");
	
		if ($result->num_rows < 1) {
			$save = $this->db->query(
				"INSERT INTO queue (user_id, name, user_type, height, weight, bmi, heart_rate, oxygen, bp, temp, assessment_access, discomfort_rate) 
				VALUES ($id, '$name', '$user_type', '', '', '', '', '', '', '', 0, $discomfort_rate);"
			);
	
			if ($save) {
				return 1; 
			} else {
				return 2;
			}
		} else {
			return 0;
		}
	}
	

	function assessment(){
		$id = $_SESSION['id'];
		$update = $this->db->query("UPDATE queue 
				SET assessment_access = 2
				WHERE user_id = $id;");
		if($update){
			return 1;
		}

	}

	function hold_health_record(){
		extract($_POST);
		$childhood_illness = $this->array_to_string($childhood_illness);
		$family_history =$this->array_to_string($family_history);
		$head = $this->array_to_string($head);
		$eyes = $this->array_to_string($eyes);
		$ears = $this->array_to_string($ears);
		$throat = $this->array_to_string($throat);
		$chest_lungs = $this->array_to_string($chest_lungs);
		$skin = $this->array_to_string($skin);
		$referred_to = $this->array_to_string($referred_to);
		if($xray_result == ""){
			$xray_result = "with findings";
		}
		if($vertebral_column == ""){
			$vertebral_column = "with deformity";
		}
		if($family_history == ""){
			$family_history = "others";
		}
		if($childhood_illness == ""){
			$childhood_illness = "others";
		}
		$_SESSION['tn'] = $tn;
		$_SESSION['name'] = $name;
		$_SESSION['date'] = $date;
		$_SESSION['sex'] = $sex;
		$_SESSION['address'] = $address;
		$_SESSION['contact'] = $contact;
		$_SESSION['emergency'] = $emergency;
		$_SESSION['age'] = $age;
		$_SESSION['civil_status'] = $civil_status;
		$_SESSION['college_department'] = $college_department;
		$_SESSION['course_school_year'] = $course_school_year;
		$_SESSION['contact_no'] = $contact_no;
		$_SESSION['childhood_illness'] = $childhood_illness;
		$_SESSION['previous_hospitalization'] = $previous_hospitalization;
		$_SESSION['operation_surgery'] = $operation_surgery;
		$_SESSION['current_medications'] = $current_medications;
		$_SESSION['allergies'] = $allergies;
		$_SESSION['family_history'] = $family_history;
		$_SESSION['cigarette_smoking'] = $cigarette_smoking;
		$_SESSION['alcohol_drinking'] = $alcohol_drinking;
		$_SESSION['traveled_abroad'] = $traveled_abroad;
		$_SESSION['working_impression'] = $working_impression;
		$_SESSION['vital_signs'] = $vital_signs;
		$_SESSION['height'] = $height;
		$_SESSION['weight'] = $weight;
		$_SESSION['bmi'] = $bmi;
		$_SESSION['bp'] = $bp;
		$_SESSION['hr'] = $hr;
		$_SESSION['rr'] = $rr;
		$_SESSION['temp'] = $temp;
		$_SESSION['head'] = $head;
		$_SESSION['eyes'] = $eyes;
		$_SESSION['ears'] = $ears;
		$_SESSION['throat'] = $throat;
		$_SESSION['chest_lungs'] = $chest_lungs;
		$_SESSION['xray_result'] = $xray_result;
		$_SESSION['breast'] = $breast;
		$_SESSION['murmur'] = $murmur;
		$_SESSION['rhythm'] = $rhythm;
		$_SESSION['abdomen'] = $abdomen;
		$_SESSION['genito_urinary'] = $genito_urinary;
		$_SESSION['extremities'] = $extremities;
		$_SESSION['vertebral_column'] = $vertebral_column;
		$_SESSION['skin'] = $skin;
		$_SESSION['scars'] = $scars;
		$_SESSION['referred_to'] = $referred_to;
		$_SESSION['follow_up_on'] = $follow_up_on;
		$_SESSION['fit'] = $fit;
		$_SESSION['for_work_up'] = $for_work_up;



		return 1;
	}

	function save_health_record(){
		$id = $_SESSION['id'];
		$tn = $_SESSION['tn'];
		$name = $_SESSION['name'];
		$date = $_SESSION['date'];
		$sex = $_SESSION['sex'];
		$address = $_SESSION['address'];
		$contact = $_SESSION['contact'];
		$emergency = $_SESSION['emergency'];
		$age = $_SESSION['age'];
		$civil_status = $_SESSION['civil_status'];
		$college_department = $_SESSION['college_department'];
		$course_school_year = $_SESSION['course_school_year'];
		$contact_no = $_SESSION['contact_no'];
		$childhood_illness = $_SESSION['childhood_illness'];
		$previous_hospitalization = $_SESSION['previous_hospitalization'];
		$operation_surgery = $_SESSION['operation_surgery'];
		$current_medications = $_SESSION['current_medications'];
		$allergies = $_SESSION['allergies'];
		$family_history = $_SESSION['family_history'];
		$cigarette_smoking = $_SESSION['cigarette_smoking'];
		$alcohol_drinking = $_SESSION['alcohol_drinking'];
		$traveled_abroad = $_SESSION['traveled_abroad'];
		$working_impression = $_SESSION['working_impression'];
		$vital_signs = $_SESSION['vital_signs'];
		$height = $_SESSION['height'];
		$weight = $_SESSION['weight'];
		$bmi = $_SESSION['bmi'];
		$bp = $_SESSION['bp'];
		$hr = $_SESSION['hr'];
		$rr = $_SESSION['rr'];
		$temp = $_SESSION['temp'];
		$head = $_SESSION['head'];
		$eyes = $_SESSION['eyes'];
		$ears = $_SESSION['ears'];
		$throat = $_SESSION['throat'];
		$chest_lungs = $_SESSION['chest_lungs'];
		$xray_result = $_SESSION['xray_result'];
		$breast = $_SESSION['breast'];
		$murmur = $_SESSION['murmur'];
		$rhythm = $_SESSION['rhythm'];
		$abdomen = $_SESSION['abdomen'];
		$genito_urinary = $_SESSION['genito_urinary'];
		$extremities = $_SESSION['extremities'];
		$vertebral_column = $_SESSION['vertebral_column'];
		$skin = $_SESSION['skin'];
		$scars = $_SESSION['scars'];
		$referred_to = $_SESSION['referred_to'];
		$follow_up_on = $_SESSION['follow_up_on'];
		$fit = $_SESSION['fit'];
		$for_work_up = $_SESSION['for_work_up'];

		$sql = "INSERT INTO health_record (transaction_no, name, date, sex, address, contact, emergency_contact, age, civil_status, college_department, course_school_year, contact_no, childhood_illness, previous_hospitalization, operation_surgery, current_medications, allergies, family_history, cigarette_smoking, alcohol_drinking, traveled_abroad, working_impression, vital_signs, height, weight, bmi, bp, hr, rr, temp, head, eyes, ears, throat, chest_lungs, xray_result, breast, heart_murmur, heart_rhythm, abdomen, genito_urinary, extremities, vertebral_column, skin, scars, referred_to, follow_up_on, fit, for_work_up)
				VALUES ('$tn', '$name', '$date', '$sex', '$address', '$contact', '$emergency', '$age', '$civil_status', '$college_department', '$course_school_year', '$contact_no', '$childhood_illness', '$previous_hospitalization', '$operation_surgery', '$current_medications', '$allergies', '$family_history', '$cigarette_smoking', '$alcohol_drinking', '$traveled_abroad', '$working_impression', '$vital_signs', '$height', '$weight', '$bmi', '$bp', '$hr', '$rr', '$temp', '$head', '$eyes', '$ears', '$throat', '$chest_lungs', '$xray_result', '$breast', '$murmur', '$rhythm', '$abdomen', '$genito_urinary', '$extremities', '$vertebral_column', '$skin', '$scars', '$referred_to', '$follow_up_on', '$fit', '$for_work_up')";
		$assessment_status_off = "UPDATE records SET assessment_status = 0 WHERE id = $id;";
		if ($this->db->query($sql) === TRUE) {
			$this->db->query($assessment_status_off);
			$_SESSION['id'] = "";
			echo "Record saved successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $this->db->error;
		}
	}

	function array_to_string($array) {

		if (count($array) > 1) {
			$filtered_array = array_diff($array, ["none"]);
			$data = implode(", ", $filtered_array);
		}
		else {
			$data = $array[0];
		}
		return $data;
		
	}

	function assess(){
		extract($_POST);
		$height_m = $height / 100;
		$bmi = number_format($weight/($height_m * $height_m), 2);
		$_SESSION['id'] = $id;
		$_SESSION['name'] = $name;
		$_SESSION['height'] = $height;
		$_SESSION['weight'] = $weight;
		$_SESSION['temp'] = $temp;
		$_SESSION['heart_rate'] = $heart_rate;
		$_SESSION['oxygen'] = $oxygen;
		$_SESSION['bp'] = $bp;
		$_SESSION['tn'] = $tn;
		$_SESSION['address'] = "";
        $_SESSION['date'] = "";
        $_SESSION['address'] = "";
        $_SESSION['contact'] = "";
        $_SESSION['emergency'] = "";
        $_SESSION['civil_status'] = "";
        $_SESSION['college_department'] = "";
        $_SESSION['course_school_year'] = "";
        $_SESSION['contact_no'] = "";
        $_SESSION['current_medications'] = "";
        $_SESSION['allergies'] = "";
        $_SESSION['working_impression'] = "";
        $_SESSION['genito_urinary'] = "";
        $_SESSION['fit'] = "";
        $_SESSION['for_work_up'] = "";
        $_SESSION['follow_up_on'] = "";
		return 1;
	}

	
}
