<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/header.php';
require_once CLASS_PATH . 'baseModel.php';
require_once CLASS_PATH . 'user.php';
$user = new User();

if (isset($_POST) && !empty($_POST)) {
	$user_name = filter_var($_POST['username'], FILTER_VALIDATE_EMAIL);
	if (!$user_name) {
		redirect('../', 'error', 'Invalid username.');
	}

	$enc_password = sha1($user_name . $_POST['password']);

	$user_info = $user->getUserByUsername($user_name);
	if (!$user_info) {
		redirect('../', 'error', 'User not found.');
	}

	if ($enc_password == $user_info[0]->password) {
		if ($user_info[0]->status == 1 && $user_info[0]->role_id == 1) {
			/*If user type admin*/
			$token = randomString();

			if (isset($_POST['remember_me']) && $_POST['remember_me'] == 1) {
				setcookie('_au_us_ad', $token, (time() + 864000), '/pasalesghar');
			}
			$_SESSION['session_id'] = $token;
			$_SESSION['full_name'] = $user_info[0]->full_name;
			$_SESSION['auth_user_id'] = $user_info[0]->id;

			/*UPDATE current User*/
			$user_update = array();

			$user_update['last_login'] = date('Y-m-d h:i:s A');
			$user_update['hash'] = $token;

			$user->user_id = $user_info[0]->id;

			$user->updateUser($user_update);
			redirect('../dashboard', 'success', 'Welcome ' . $user_info[0]->full_name . '! To Pasale\'s Ghar!!');
		} else {
			redirect('../', 'warning', 'User deactivated or suspended. Please contact admin.');
		}
	} else {
		redirect('../', 'password_error', 'Password does not match.');
	}
} else {
	redirect('../', 'error', 'Unauthorized access.');
}