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

if($action == 'save_height'){
	$save_height = $crud->save_height();
	if($save_height)
		echo $save_height;
}

if($action == 'get_height'){
	$get_height = $crud->get_height();
	if($get_height)
		echo $get_height;
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

if($action == 'save_oxygen'){
	$save_oxygen = $crud->save_oxygen();
	if($save_oxygen)
		echo $save_oxygen;
}

if($action == 'get_oxygen'){
	$get_oxygen = $crud->get_oxygen();
	if($get_oxygen)
		echo $get_oxygen;
}

if($action == 'get_temp'){
	$get_temp = $crud->get_temp();
	if($get_temp)
		echo $get_temp;
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

if($action == 'assess'){
	$assess = $crud->assess();
	if($assess)
		echo $assess;
}

if($action == 'display_realtime_records'){
	$display_realtime_records = $crud->display_realtime_records();
	if($display_realtime_records)
		echo $display_realtime_records;
}
