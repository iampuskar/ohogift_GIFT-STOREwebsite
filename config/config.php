<?php 

ob_start();
session_start();
  
define('ENVIROMENT', 'DEVELOPMENT');
date_default_timezone_set('Asia/Kathmandu');

if(ENVIROMENT=="DEVELOPMENT"){
	error_reporting(E_ALL);
	ini_set('display_error', true);
	define('SITE_URL', 'http://pasale.com/');
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'pasale');
	define('DB_PORT', '');
	
}

else{
	error_reporting(0);
	ini_set('display_error', false);
	define('SITE_URL', 'http://ohogift.com/');
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'pasale');
	define('DB_PORT', ''); 

}

define('ADMIN_URL', SITE_URL.'pasalesghar/');
define('ADMIN_ASSETS_URL', ADMIN_URL. "assets/");
define('ADMIN_CSS_URL', ADMIN_ASSETS_URL. "css/");
define('ADMIN_JS_URL', ADMIN_ASSETS_URL. "js/");
define('ADMIN_IMAGES_URL', ADMIN_ASSETS_URL. "images/");
define('ADMIN_VENDORS_URL', ADMIN_ASSETS_URL. "vendors/");
define('ADMIN_TITLE', "Pasale's Home");

define('CLASS_PATH',$_SERVER['DOCUMENT_ROOT'].'/class/');
$error_path=$_SERVER['DOCUMENT_ROOT'].'/error/';

define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'].'/upload/');
// define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'].'/project_path/upload/');
define('UPLOAD_URL', SITE_URL.'/upload/');

if (!is_dir($error_path)) {
	mkdir($error_path);
}

define('ALLOWED_EXTS', array('jpg','jpeg','png','gif')); // >= 7
$allowed_exts = array('jpg','jpeg','png','gif');

define('ERROR_LOG',$error_path);


/* For Frontend*/ 

define('SITE_TITLE', 'pasale.com');
define('KEYWORDS', 'Online ecommerce, nepali ecommerce');
define('DESCRIPTION', 'best nepali e-commerce site.');

define('ASSETS_URL', SITE_URL. "assets/");
define('CSS_URL', ASSETS_URL. "css/");
define('JS_URL', ASSETS_URL. "js/");
define('IMAGES_URL', ASSETS_URL. "img/");
