<?php

function debugger($data, $is_die = false, $dump = false) {
	echo "<pre style='color: #ff0000;'>";
	if ($dump) {
		var_dump($data);
	} else {
		print_r($data);
	}
	echo "</pre>";
	if ($is_die) {
		exit;
	}
}

function getCurrentPage() {
	$current_page = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME); // project/ecom_11/pasalesghar/dashboard.php
	return $current_page;

}

function redirect($path, $status = null, $message = null) {
	if ($status != null) {
		if (!isset($_SESSION)) {
			session_start();
		}
		$_SESSION[$status] = $message;
	}

	@header('location: ' . $path);
	exit;
}

function flash() {
	if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
		echo "<p class='alert alert-success'>" . $_SESSION['success'] . "</p>";
		unset($_SESSION['success']);
	}
	if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
		echo "<p class='alert alert-danger'>" . $_SESSION['error'] . "</p>";
		unset($_SESSION['error']);
	}

	if (isset($_SESSION['warning']) && !empty($_SESSION['warning'])) {
		echo "<p class='alert alert-warning'>" . $_SESSION['warning'] . "</p>";
		unset($_SESSION['warning']);
	}

}

function randomString($length = 100) {
	$char = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$str_len = strlen($char);
	$random = "";
	for ($i = 0; $i < $length; $i++) {
		$random .= $char[rand(0, $str_len - 1)];
	}

	return $random;
}

function sanitize($str){
	$str = rtrim($str); // recr. trim
	$str = strip_tags($str);
	$str = rtrim($str);
	$str = stripslashes($str);
	$str = addslashes($str);

	return $str;
}

function uploadSingleImage($file, $folder_name){
	$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
	if(in_array(strtolower($ext), ALLOWED_EXTS)){
		if($file['size'] <= 5000000){
			$upload_dir = UPLOAD_DIR.$folder_name;
			if(!is_dir($upload_dir)){
				mkdir($upload_dir, '0777', true);
			}

			$file_name = ucfirst($folder_name)."-".date('Ymdhis').rand(0,999).".".$ext;

			$success = move_uploaded_file($file['tmp_name'],$upload_dir.'/'.$file_name);
			if($success){
				return $file_name;
			} else {
				return false;
			}
		} else{
			return false;
		}
	}else {
		return false;
	}
}

function api_response($body = null, $success = false, $message = null, $response_code = 400){
	$api_response = new stdClass();
	$api_response->status = array();
	$api_response->body = array();

	$api_response->status['status'] = $success;
	$api_response->status['message'] = $message;
	$api_response->status['response_code'] = $response_code;
	if($body != null){
		$api_response->body = $body;
	} else {
		$api_response->body = null;
	}

	if($success != false){
		$api_response->status['status'] = true;	
	} else {
		$api_response->status['status'] = false;
	}


	if($message != null){
		$api_response->status['message'] = $message;	
	} else {
		$api_response->status['message'] = null;
	}

	if($response_code != 400){
		$api_response->status['response_code'] = $response_code;	
	} else {
		$api_response->status['response_code'] = 400;
	}


	return json_encode($api_response);

} 