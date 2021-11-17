<?php

require 'config/header.php';
require CLASS_PATH.'baseModel.php';
require CLASS_PATH.'review.php';


//debugger($_POST,true);
$review = new Review();

if(isset($_POST) && !empty($_POST)){

    $data = array(
        
        'product_id' => (int)($_GET['id']), 
        'name' => sanitize($_POST['username']), 
        'email_address' => sanitize($_POST['email']), 
        'review' => sanitize($_POST['review']),
        'rate'   => (int)($_POST['rating']),
        'status'    => 1
    );


    $products = $review->addReview($data);
     redirect('index','success', 'Thank you for your review.');
   //debugger($products,true);
} else {
    redirect('index','error', 'Unauthorized access.');
}