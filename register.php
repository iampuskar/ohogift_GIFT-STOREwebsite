<?php

require 'config/header.php';
require CLASS_PATH.'baseModel.php';
require CLASS_PATH.'user.php';

$user = new User();
if(isset($_POST) && !empty($_POST)){
	
	$user_name = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

	if(!$user_name){
		redirect('login', 'error','Invalid Username');
	}

	$password = $_POST['password'];
	if($password !== $_POST['re_password']){
		redirect('login', 'error', 'Password does not match.');		
	}

	$password = sha1($user_name.$password);

	$data = array(
		'full_name' => sanitize($_POST['full_name']), 
		'email_address' => $user_name, 
		'password' => $password, 
		'role_id' => 2,
		'phone_number' => sanitize($_POST['phone_number']),
		'gender' => sanitize($_POST['gender']),
		'age'	=> (int)($_POST['age']),
		'billing_address' => sanitize($_POST['billing_address']),
		'shipping_address' => sanitize($_POST['shipping_address']),
		'status'	=> 1
	);


	$customer_id = $user->addUser($data);
	if($customer_id){
		$_SESSION['customer_id'] = $customer_id;
		redirect('cart','success','View your cart for final inspection.');
	} else {
		redirect('login', 'error', 'Sorry! Your account could not be created at this moment. Please contact our admin.');
	}
} else {
	redirect('login','error', 'Unauthorized access.');
}