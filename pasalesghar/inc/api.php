<?php
require $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
require $_SERVER['DOCUMENT_ROOT'].'/config/function.php';
require CLASS_PATH.'baseModel.php';
require CLASS_PATH.'category.php';
$category = new Category();


$act = (isset($_REQUEST['act']) && !empty($_REQUEST['act'])) ? sanitize($_REQUEST['act']) : NULL;



if($act){
	if($act == substr(md5('sub-cat-info-'.$_SESSION['session_id']), 5, 15) && isset($_POST['category_id'])){
		$cat_id = (int)$_POST['category_id'];

		if($cat_id <= 0){
			echo api_response(null, false,  'Invalid category Id.', 200);
			exit;
		}

	$sub_cats = $category->getAllSubCatsForApi($cat_id);

	echo api_response($sub_cats, true,  null, 200);
	exit;


	} else {
		echo api_response(null, false,  "Invalid token.", 400);
		exit;
	}
} else {
	echo api_response(null, false,  "Unauthorized access.", 400);
	exit;
}
