<?php


class Review extends BaseModel{
	public function __construct(){
		parent::__construct();
		$this->table('product_ratings');
	}

	public function addReview($data){
		return $this->insert($data);
	}	

	public function getAllReview(){
		return $this->select();
	}

	public function getReviewById($id){
		$attr = array('where'=> array('product_id'=>$id));
		return  $this->select($attr);
	} 

	public function deleteReview($id){

		$attrs=array('where'=> array('id'=>$id));
		return $this->delete($attrs);
	}
	public function updateReview($data, $ban_id ){

		$attr=array('where'=> array('id'=>$ban_id));
		return $this->update($data, $attr);
	}

	public function getHomeReview(){
		$attr = array(
			'where'=> array('status' => 1),
			'orderby' =>  ' id DESC ',
			'limit' => '0 , 5'

		);

		return $this->select($attr);
	}

	public function getTotalCount(){
    $cond = array(
                   'fields'=>" count(id) as total_review "
    );
    return $this->select($cond);
  }


}