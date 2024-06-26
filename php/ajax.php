<?php
ob_start();
$action = $_GET['action'];
include 'functions.php';
$crud = new Action();

if($action == 'admin_login'){
    $admin_login = $crud->admin_login();
    if($admin_login)
        echo $admin_login;
}
if($action == 'student_login'){
    $student_login = $crud->student_login();
    if($student_login)
        echo $student_login;
}
if($action == 'faculty_login'){
    $faculty_login = $crud->faculty_login();
    if($faculty_login)
        echo $faculty_login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}

if($action == 'student_register'){
	$student_register = $crud->student_register();
	if($student_register)
		echo $student_register;
}

if($action == 'faculty_register'){
	$faculty_register = $crud->faculty_register();
	if($faculty_register)
		echo $faculty_register;
}

if($action == 'guest_register'){
	$guest_register = $crud->guest_register();
	if($guest_register)
		echo $guest_register;
}

if($action == 'get_height'){
	$get_height = $crud->get_height();
	if($get_height)
		echo $get_height;
}

if($action == 'save_height'){
	$save_height = $crud->save_height();
	if($save_height)
		echo $save_height;
}

if($action == 'get_weight'){
	$get_weight = $crud->get_weight();
	if($get_weight)
		echo $get_weight;
}

if($action == 'save_weight'){
	$save_weight = $crud->save_weight();
	if($save_weight)
		echo $save_weight;
}

if($action == 'get_heart_rate'){
	$get_heart_rate = $crud->get_heart_rate();
	if($get_heart_rate)
		echo $get_heart_rate;
}

if($action == 'save_heart_rate'){
	$save_heart_rate = $crud->save_heart_rate();
	if($save_heart_rate)
		echo $save_heart_rate;
}

if($action == 'get_oxygen'){
	$get_oxygen = $crud->get_oxygen();
	if($get_oxygen)
		echo $get_oxygen;
}

if($action == 'save_oxygen'){
	$save_oxygen = $crud->save_oxygen();
	if($save_oxygen)
		echo $save_oxygen;
}

if($action == 'get_bp'){
	$get_bp = $crud->get_bp();
	if($get_bp)
		echo $get_bp;
}

if($action == 'save_bp'){
	$save_bp = $crud->save_bp();
	if($save_bp)
		echo $save_bp;
}

if($action == 'get_temp'){
	$get_temp = $crud->get_temp();
	if($get_temp)
		echo $get_temp;
}

if($action == 'save_temp'){
	$save_temp = $crud->save_temp();
	if($save_temp)
		echo $save_temp;
}

if($action == 'save_all_data'){
	$save_all_data = $crud->save_all_data();
	if($save_all_data)
		echo $save_all_data;
}

if($action == 'get_all_data'){
	$get_all_data = $crud->get_all_data();
	if($get_all_data)
		echo $get_all_data;
}

if($action == 'delete_record'){
	$delete_record = $crud->delete_record();
	if($delete_record)
		echo $delete_record;
}

if($action == 'delete_user'){
	$delete_user = $crud->delete_user();
	if($delete_user)
		echo $delete_user;
}
if($action == 'create_initial_record'){
	$create_initial_record = $crud->create_initial_record();
	if($create_initial_record)
		echo $create_initial_record;
}
if($action == 'display_ongoing_check_up'){
	$display_ongoing_check_up = $crud->display_ongoing_check_up();
	if($display_ongoing_check_up)
		echo $display_ongoing_check_up;
}

if($action == 'delete_ongoing'){
	$delete_ongoing = $crud->delete_ongoing();
	if($delete_ongoing)
		echo $delete_ongoing;
}

if($action == 'display_realtime_records'){
	$display_realtime_records = $crud->display_realtime_records();
	if($display_realtime_records)
		echo $display_realtime_records;
}

if($action == 'send_otp'){
	$send_otp = $crud->send_otp();
	if($send_otp)
		echo $send_otp;
}

if($action == 'forgot_password1'){
	$forgot_password1 = $crud->forgot_password1();
	if($forgot_password1)
		echo $forgot_password1;
}

if($action == 'forgot_password2'){
	$forgot_password2 = $crud->forgot_password2();
	if($forgot_password2)
		echo $forgot_password2;
}

if($action == 'forgot_password3'){
	$forgot_password3 = $crud->forgot_password3();
	if($forgot_password3)
		echo $forgot_password3;
}

if($action == 'add_user'){
	$add_user = $crud->add_user();
	if($add_user)
		echo $add_user;
}

if($action == 'update_user'){
	$update_user = $crud->update_user();
	if($update_user)
		echo $update_user;
}

if($action == 'upload_profile_pic'){
	$upload_profile_pic = $crud->upload_profile_pic();
	if($upload_profile_pic)
		echo $upload_profile_pic;
}

if($action == 'give_access'){
	$give_access = $crud->give_access();
	if($give_access)
		echo $give_access;
}

if($action == 'remove_queue'){
	$remove_queue = $crud->remove_queue();
	if($remove_queue)
		echo $remove_queue;
}

if($action == 'save_discomfort_rate'){
	$save_discomfort_rate = $crud->save_discomfort_rate();
	if($save_discomfort_rate)
		echo $save_discomfort_rate;
}

if($action == 'assessment'){
	$assessment = $crud->assessment();
	if($assessment)
		echo $assessment;
}

if($action == 'save_health_record'){
	$save_health_record = $crud->save_health_record();
	if($save_health_record)
		echo $save_health_record;
}

if($action == 'verify_email'){
	$verify_email = $crud->verify_email();
	if($verify_email)
		echo $verify_email;
}

if($action == 'profile_send_code'){
	$profile_send_code = $crud->profile_send_code();
	if($profile_send_code)
		echo $profile_send_code;
}

if($action == 'assess'){
	$assess = $crud->assess();
	if($assess)
		echo $assess;
}

if($action == 'hold_health_record'){
	$hold_health_record = $crud->hold_health_record();
	if($hold_health_record)
		echo $hold_health_record;
}

if($action == 'verify_email'){
	$verify_email = $crud->verify_email();
	if($verify_email)
		echo $verify_email;
}
