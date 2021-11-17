<?php
require '../config/config.php';
require '../config/functions.php';
require CLASS_PATH.'baseModel.php';
require CLASS_PATH.'product.php';


$product = new Product();


$act = (isset($_REQUEST['act'])) ? sanitize($_REQUEST['act']) : NULL;

if(isset($act) && !empty($act) && $act == substr(md5('add-to-cart'), 3, 15)) {
  $product_id = (int)$_POST['prod_id'];
  $quantity = (int)$_POST['quantity'];

  $product_info = $product->getProductById($product_id);
  //debugger($product_info,true);

  if($product_info){
    /*Product Exists*/
    $cart = (isset($_SESSION['_cart']) && !empty($_SESSION['_cart'])) ? $_SESSION['_cart'] : array();
    //debugger($product_info);

    $current_item = array();
    $current_item['id'] = $product_info[0]->id;
    $current_item['title'] = $product_info[0]->title;
    $current_item['summary'] = $product_info[0]->summary;
    $current_item['image'] = $product_info[0]->thumbnail;
    $current_item['original_price'] = $product_info[0]->price;


    $discount_price = ($product_info[0]->price*$product_info[0]->discount)/100;
    $unit_price = $product_info[0]->price-$discount_price;


    $current_item['unit_price'] = $unit_price;


    $total_amount = 0;
    $total_quantity = 0;

    if(!empty($cart)){
      /*cart_exists*/
      $index = null;

      foreach($cart as $key => $cart_item){
        if($cart_item['id'] == $product_id){
          $index = $key;
          break;
        }
      }

      if($index ===  null){
        $current_item['total_amount'] = $unit_price*$quantity;
        $current_item['total_quantity']  = $quantity;

        $total_amount = $unit_price*$quantity;
        $total_quantity = $quantity;

        $cart[] = $current_item;
      } else {
        $cart[$index]['total_amount'] = $cart[$index]['total_amount'] + ($unit_price*$quantity);
        $cart[$index]['total_quantity'] = $cart[$index]['total_quantity'] + ($quantity);

      }
    } else {
      $current_item['total_amount'] = $unit_price*$quantity;
      $current_item['total_quantity']  = $quantity;

      $total_amount = $unit_price*$quantity;
      $total_quantity = $quantity;

      $cart[] = $current_item;
    }
     //debugger($cart,true);
    $_SESSION['_cart'] = $cart;
    echo api_response($cart, true, 'Cart updated.', 200);
    exit;

  } else {
    /*Product Does not exists*/
    echo api_response(null, false, 'Product not found.', 403);
    exit;
  }
} else if(isset($act) && !empty($act) && $act == substr(md5('delete-from-cart'), 3,15)){
  $cart_index = (int)$_POST['cart_index'];
  if(isset($_SESSION['_cart'])){

    $cart = $_SESSION['_cart'];
    if(isset($cart[$cart_index])){
      unset($cart[$cart_index]);
      $_SESSION['_cart'] = $cart;

      echo api_response($cart, true, 'cart updated', 200);
      exit;
    } else {
      echo api_response(null, false, 'cart already deleted.', 403);
      exit;
    }

  } else {
    echo api_response(null, false, 'unauthorized access.', 403);
    exit;
  }
} else{
  echo api_response(null, false, 'unauthorized access.', 403);
  exit;
}