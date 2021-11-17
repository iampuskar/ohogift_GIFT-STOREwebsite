<?php

class Banner extends BaseModel{
	public function __construct(){
		parent::__construct();
		$this->table('banners');
	}

	public function addBanner($data){
		return $this->insert($data);
	}	

	public function getAllBanner(){
		return $this->select();
	}

	public function getBannerById($id){
		$attr = array('where'=> array('id'=>$id));
		return  $this->select($attr);
	} 

	public function deleteBanner($id){

		$attrs=array('where'=> array('id'=>$id));
		return $this->delete($attrs);
	}
	public function updateBanner($data, $ban_id ){

		$attr=array('where'=> array('id'=>$ban_id));
		return $this->update($data, $attr);
	}

	public function getHomeBanner(){
		$attr = array(
			'where'=> array('status' => 1),
			'orderby' =>  ' id DESC ',
			'limit' => '0 , 5'

		);

		return $this->select($attr);
	}


}