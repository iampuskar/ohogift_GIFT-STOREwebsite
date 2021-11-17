<?php
require 'config/header.php';
require CLASS_PATH.'baseModel.php';
require CLASS_PATH.'order.php';

//debugger($_SESSION,true);
if(isset($_SESSION['customer_id']) && !empty($_SESSION['customer_id'])){
	if(isset($_SESSION['_cart']) && !empty($_SESSION['_cart'])){
		$customer_id = $_SESSION['customer_id'];

		$cart_id = randomString(15);
		$cart = $_SESSION['_cart'];
		$total_order = array();

		foreach($cart as $cart_info){
			$order = new Order();
			$data = array();
			$data['product_id'] = $cart_info['id'];
			$data['cart_id'] = $cart_id;
			$data['customer_id'] = $customer_id;

			$data['quantity'] = $cart_info['total_quantity'];
			$data['total_amount'] = ($cart_info['total_amount']+$cart_info['total_amount']*0.13);
			
			$data['extra_cost'] = 0;
			$data['order_status'] = 0;
			$data['delivery_type'] = 1;

			$total_order[] = $order->addOrder($data);
			//debugger($total_order,true);
		}


		if(count($total_order) > 0){
			unset($_SESSION['_cart']);
			redirect('cartout', 'success', 'Thankyou. Your order has been placed. You will shortly receive notification regarding confirmation of your order.');
		} else {
			unset($_SESSION['_cart']);

			redirect('dashboard', 'error', 'Sorry! There was problem while creating order at this moment. Please contact our admin.');
		}

	} else {
		redirect('dashboard', 'success', 'You have noting to pay.');
	}
} else {
	redirect('login', 'warning', 'Please login first');
}