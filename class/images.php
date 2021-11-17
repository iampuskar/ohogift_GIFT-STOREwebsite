<?php


class Images extends BaseModel{
	public function __construct(){
		BaseModel::__construct();
		$this->table('product_images');
	}

	public function addProductImage($data){
		return $this->insert($data);
	}
}