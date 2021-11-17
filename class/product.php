<?php

class Product extends BaseModel{
	public function __construct(){
		BaseModel::__construct();
		$this->table('products');
	}

	public function addProduct($data){
		return $this->insert($data);
	}

	public function getAllProduct(){
		$args = array(

      'fields'=> "products.id, products.title, products.summary, products.description, products.price, products.discount, products.keyword, products.is_featured, products.is_branded, products.brand, products.thumbnail, products.cat_id, count(product_ratings.id) as total_user, SUM(product_ratings.rate) as total_rate, products.added_date, products.status", 
          'join'=> " LEFT JOIN product_ratings ON product_ratings.product_id = products.id" 
    );
            $where = " products.status = 1 ";
            $where = " products.cat_id = 15 ";

            
            //debugger($search_options);
            $args['where'] = $where;
            $args['groupby']= " products.id"; 
            $data = $this->select($args);
            //debugger($data,true);
            return $data;
	}

  public function getAllProduct2(){
    $args = array(

      'fields'=> "products.id, products.title, products.summary, products.description, products.price, products.discount, products.keyword, products.is_featured, products.is_branded, products.brand, products.thumbnail, products.cat_id, count(product_ratings.id) as total_user, SUM(product_ratings.rate) as total_rate, products.added_date, products.status", 
          'join'=> " LEFT JOIN product_ratings ON product_ratings.product_id = products.id" 
    );
            $where = " products.status = 1 ";
            $where = " products.cat_id = 17 ";
            


            
            //debugger($search_options);
            $args['where'] = $where;
            $args['groupby']= " products.id"; 
            $data = $this->select($args);
            //debugger($data,true);
            return $data;
  }

   public function getAllProduct3(){
    $args = array(

      'fields'=> "products.id, products.title, products.summary, products.description, products.price, products.discount, products.keyword, products.is_featured, products.is_branded, products.brand, products.thumbnail, products.cat_id, count(product_ratings.id) as total_user, SUM(product_ratings.rate) as total_rate, products.added_date, products.status", 
          'join'=> " LEFT JOIN product_ratings ON product_ratings.product_id = products.id" 
    );
            $where = " products.status = 1 ";
            $where = " products.cat_id = 18 ";
            


            
            //debugger($search_options);
            $args['where'] = $where;
            $args['groupby']= " products.id"; 
            $data = $this->select($args);
            //debugger($data,true);
            return $data;
  }

   public function getAllProduct4(){
    $args = array(

      'fields'=> "products.id, products.title, products.summary, products.description, products.price, products.discount, products.keyword, products.is_featured, products.is_branded, products.brand, products.thumbnail, products.cat_id, count(product_ratings.id) as total_user, SUM(product_ratings.rate) as total_rate, products.added_date, products.status", 
          'join'=> " LEFT JOIN product_ratings ON product_ratings.product_id = products.id" 
    );
            $where = " products.status = 1 ";
            $where = " products.cat_id = 20 ";
            


            
            //debugger($search_options);
            $args['where'] = $where;
            $args['groupby']= " products.id"; 
            $data = $this->select($args);
            //debugger($data,true);
            return $data;
  }

  public function getAllProduct5(){
    $args = array(

      'fields'=> "products.id, products.title, products.summary, products.description, products.price, products.discount, products.keyword, products.is_featured, products.is_branded, products.brand, products.thumbnail, products.cat_id, count(product_ratings.id) as total_user, SUM(product_ratings.rate) as total_rate, products.added_date, products.status", 
          'join'=> " LEFT JOIN product_ratings ON product_ratings.product_id = products.id" 
    );
            $where = " products.status = 1 ";
            $where = " products.cat_id = 19 ";
            


            
            //debugger($search_options);
            $args['where'] = $where;
            $args['groupby']= " products.id"; 
            $data = $this->select($args);
            //debugger($data,true);
            return $data;
  }

  public function getAllProduct6(){
    $args = array(

      'fields'=> "products.id, products.title, products.summary, products.description, products.price, products.discount, products.keyword, products.is_featured, products.is_branded, products.brand, products.thumbnail, products.cat_id, count(product_ratings.id) as total_user, SUM(product_ratings.rate) as total_rate, products.added_date, products.status", 
          'join'=> " LEFT JOIN product_ratings ON product_ratings.product_id = products.id" 
    );
            $where = " products.status = 1 ";
            $where = " products.cat_id = 15 ";
            


            
            //debugger($search_options);
            $args['where'] = $where;
            $args['groupby']= " products.id";
            $args['limit'] = " 0,1"; 
            $data = $this->select($args);
            //debugger($data,true);
            return $data;
  }

public function getAllProduct7(){
    $args = array(

      'fields'=> "products.id, products.title, products.summary, products.description, products.price, products.discount, products.keyword, products.is_featured, products.is_branded, products.brand, products.thumbnail, products.cat_id, count(product_ratings.id) as total_user, SUM(product_ratings.rate) as total_rate, products.added_date, products.status", 
          'join'=> " LEFT JOIN product_ratings ON product_ratings.product_id = products.id" 
    );
            $where = " products.status = 1 ";
            $where = " products.cat_id = 17 ";
            


            
            //debugger($search_options);
            $args['where'] = $where;
            $args['groupby']= " products.id";
            $args['limit'] = " 0,1"; 
            $data = $this->select($args);
            //debugger($data,true);
            return $data;
  }

public function getAllProduct8(){
    $args = array(

      'fields'=> "products.id, products.title, products.summary, products.description, products.price, products.discount, products.keyword, products.is_featured, products.is_branded, products.brand, products.thumbnail, products.cat_id, count(product_ratings.id) as total_user, SUM(product_ratings.rate) as total_rate, products.added_date, products.status", 
          'join'=> " LEFT JOIN product_ratings ON product_ratings.product_id = products.id" 
    );
            $where = " products.status = 1 ";
            $where = " products.cat_id = 18 ";
            


            
            //debugger($search_options);
            $args['where'] = $where;
            $args['groupby']= " products.id";
            $args['limit'] = " 0,1"; 
            $data = $this->select($args);
            //debugger($data,true);
            return $data;
  }


public function getAllProduct9(){
    $args = array(

      'fields'=> "products.id, products.title, products.summary, products.description, products.price, products.discount, products.keyword, products.is_featured, products.is_branded, products.brand, products.thumbnail, products.cat_id, count(product_ratings.id) as total_user, SUM(product_ratings.rate) as total_rate, products.added_date, products.status", 
          'join'=> " LEFT JOIN product_ratings ON product_ratings.product_id = products.id" 
    );
            $where = " products.status = 1 ";
            $where = " products.cat_id = 20 ";
            


            
            //debugger($search_options);
            $args['where'] = $where;
            $args['groupby']= " products.id";
            $args['limit'] = " 0,1"; 
            $data = $this->select($args);
            //debugger($data,true);
            return $data;
  }

  public function getAllProduct10(){
    $args = array(

      'fields'=> "products.id, products.title, products.summary, products.description, products.price, products.discount, products.keyword, products.is_featured, products.is_branded, products.brand, products.thumbnail, products.cat_id, count(product_ratings.id) as total_user, SUM(product_ratings.rate) as total_rate, products.added_date, products.status", 
          'join'=> " LEFT JOIN product_ratings ON product_ratings.product_id = products.id" 
    );
            $where = " products.status = 1 ";
            $where = " products.cat_id = 19 ";
            


            
            //debugger($search_options);
            $args['where'] = $where;
            $args['groupby']= " products.id";
            $args['limit'] = " 0,1"; 
            $data = $this->select($args);
            //debugger($data,true);
            return $data;
  }

    public function getAllProduct11(){
    $args = array(

      'fields'=> "products.id, products.title, products.summary, products.description, products.price, products.discount, products.keyword, products.is_featured, products.is_branded, products.brand, products.thumbnail, products.cat_id, count(product_ratings.id) as total_user, SUM(product_ratings.rate) as total_rate, products.added_date, products.status", 
          'join'=> " LEFT JOIN product_ratings ON product_ratings.product_id = products.id" 
    );
            $where = " products.status = 1 ";
            $where = " products.cat_id = 20 ";
            


            
            //debugger($search_options);
            $args['where'] = $where;
            $args['groupby']= " products.id";
            $args['limit'] = " 0,8"; 
            $data = $this->select($args);
            //debugger($data,true);
            return $data;
  }



	public function getSearchResult($search_options = array()){
		//debugger($search_options,true);
		$args = array(

			'fields'=> "products.id, products.title, products.price, products.discount, products.thumbnail, count(product_ratings.id) as total_user, SUM(product_ratings.rate) as total_rate, products.added_date", 
			    'join'=> " LEFT JOIN product_ratings ON product_ratings.product_id = products.id" 
		);
            $where = " products.status = 1 ";

            if(isset($search_options['keyword']) && !empty($search_options['keyword'])){
           	$where.=" AND (products.title LIKE '%".$search_options['keyword']."%' OR products.summary LIKE  '%".$search_options['keyword']."%' OR products.description LIKE '%".$search_options['keyword']."%') ";  
            }
            if(isset($search_options['cat_id']) && !empty($search_options['cat_id'])){
           	$where.=" AND products.cat_id = ".$search_options['cat_id'] ;   
            }
            if(isset($search_options['min_price']) && !empty($search_options['min_price'])){
           	$where.=" AND products.price >= ".$search_options['min_price'] ;  
            }
            if(isset($search_options['max_price']) && !empty($search_options['max_price'])){
           	$where.=" AND products.price <= ".$search_options['max_price'] ;  
           }
            //debugger($search_options);
            $args['where'] = $where;
            $args['groupby']= " products.id"; 

            if(isset($search_options['orderby']) && !empty($search_options['orderby'])){
              $search_options['orderby'] = $search_options['orderby'];
            }

            if(isset($search_options['limit']) && !empty($search_options['limit'])){
              $args['limit']= $search_options['limit'][0].", ".$search_options['limit'][1];
            }


            $data = $this->select($args);
            //debugger($data,true);
            return $data;

         
   }

   // public function getProductById($id){
   //  $args['where'] =' id= '.$id;
   //  return $this->select($args);
   // }

    public function getProductById($id){
     $attr = array(
      'fields'=> "products.id, products.title, products.price, products.discount, products.thumbnail, products.brand, products.summary, products.description, count(product_ratings.id) as total_user, SUM(product_ratings.rate) as total_rate, products.added_date",
      'where'=> ' products.id= '.$id,
      
      'join'=> " LEFT JOIN product_ratings ON product_ratings.product_id = products.id"
    );

    return $this->select($attr);
   }

   public function getProductLimit(){
   $args = array(

      'fields'=> "products.id, products.title, products.price, products.discount, products.thumbnail, count(product_ratings.id) as total_user, products.cat_id, SUM(product_ratings.rate) as total_rate, products.added_date", 
          'join'=> " LEFT JOIN product_ratings ON product_ratings.product_id = products.id" 
    );
            $where = " products.status = 1 ";
            $where = " products.cat_id = 19 ";

            
            //debugger($search_options);
            $args['where'] = $where;
            $args['groupby']= " products.id"; 
            $args['limit'] = " 0,8";


            $data = $this->select($args);
            //debugger($data,true);
            return $data;
  }

  public function getTotalCount(){
    $cond = array(
                   'fields'=>" count(id) as total_product "
    );
    return $this->select($cond);
  }

  public function deleteProduct($id){
    $attr = array('where'=>array('id'=>$id));
    return $this->delete($attr);
  }

  public function updateProduct($data, $ban_id){
    $attr = array('where' => array('id'=>$ban_id));

    return $this->update($data, $attr);
  }

} 