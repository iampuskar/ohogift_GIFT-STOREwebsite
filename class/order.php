<?php

class Order extends BaseModel{
	public function __construct(){
		BaseModel::__construct();
		$this->table('orders');
	}

	  public function addOrder($data){
		return $this->insert($data);
	}

   public function getOrderByOrderId($id){
    $attr = array('where'=> array('id'=>$id));
    return  $this->select($attr);
  } 

  public function deleteOrder($id){

    $attrs=array('where'=> array('id'=>$id));
    return $this->delete($attrs);
  }
  public function updateOrder($data, $ban_id ){

    $attr=array('where'=> array('id'=>$ban_id));
    return $this->update($data, $attr);
  }

  public function getAllOrder(){

		$cond = array(
                   'fields'=>" id, cart_id , customer_id, quantity, order_status, delivery_type ",

                   'groupby'=> " cart_id ", 

                                    
    );
    return $this->select($cond);
	}

	 public function getOrderById($id){
    $cond = array(  
    	             
                   'where'=>" customer_id=".$id,
                   'join'=> " LEFT JOIN users ON orders.customer_id  =  users.id ".
                            " LEFT JOIN products ON orders.product_id  = products.id  "

    );
    return $this->select($cond);
   }

   //  public function getOrderById($id){
   //  return $this->select($args);
   //  $args['where'] =' id= '.$id;
   // }
}