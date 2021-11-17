<?php
require $_SERVER['DOCUMENT_ROOT'] . '/config/header.php';
if (!isset($_SESSION, $_SESSION['session_id']) || empty($_SESSION['session_id'])) {
    redirect('logout');
}
require CLASS_PATH . 'baseModel.php';
require CLASS_PATH . 'order.php';

$order = new Order();
//debugger($_GET,true);


if (isset($_POST) && !empty($_POST)) {

    //debugger($_POST,true);
    //debugger($_FILES,true);
    $data             = array();
    $data['cart_id']    = sanitize($_POST['cart_id']);
    $data['customer_id']  = (int)($_POST['customer_id']);
    $data['delivery_type']   = (int) $_POST['delivery_type'];
    $data['order_status']   = (int) $_POST['order_status'];
   
    //debugger($data,true);

    $ban_id= isset($_POST['order_id'])? (int)$_POST['order_id'] :null;
    //debugger($ban_id,true);
    
    if($ban_id){

        $order_info = $order->getOrderByOrderId($ban_id);
       // debugger($order_info,true);
        if(!$order_info){
            redirect('../order','error','order Not found');
        }

        $act="updat";
        $order_id = $order->updateOrder($data, $ban_id);

    }else{
        $act="add";  
        $order_id = $order->addOrder($data);
        //debugger($order_id,true); 
    }
   
    if ($order_id) {
        redirect('../order', 'success', "order ".$act."ed successfully.");
        //debugger($data, true);
        }else { 
              redirect('../order', 'error', "Sorry!!! There was a problem while ".$act."ing order.");
        }

       }

       else if(isset($_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])) {
        $id=(int)$_GET['id'];
        if($_GET['act'] === substr(md5('del-order-'.$_SESSION['session_id'].'-'.$id), 3, 15)){
           //debugger($_GET,true);

            $order_info = $order->getOrderByOrderId($id);
            //debugger($order_info,true);
            if($order_info){
                $del= $order->deleteOrder($id);
                
                if($del){
                    if(isset($order_info[0]->image) && file_exists(UPLOAD_DIR.'order/'.$order_info[0]->image)){
                        unlink(UPLOAD_DIR.'order/'.$order_info[0]->image); 
                    }

                    redirect('../order','success','order Deleted successfully');


                     }else{
                     redirect('../order','error', 'sorry problem while deleting file');

                            }

                       }else{
                    redirect('../order','error', 'The order has been already deleted');   

                    }

                    }
                    else{
                    redirect('../order','error', 'Token is mismatched');
                          }
                     }

                   else {
                   redirect('../order', 'error', 'Unauthorized access.');
                } 