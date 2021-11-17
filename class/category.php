<?php

class Category extends BaseModel{
	public function __construct(){
		parent::__construct();
		$this->table('categories');
	}

	public function addCategory($data){
		return $this->insert($data);
	}

	public function getAllCategory(){
		return $this->select();
	}

	public function getCategoryById($id){
		$attr = array('where'=> array('id'=>$id));
         return $this->select($attr);
         
	}

	public function deleteCategory($id){
		$attr = array('where'=>array('id'=>$id));
		return $this->delete($attr);
	}

	public function updateCategory($data, $ban_id){
		$attr = array('where' => array('id'=>$ban_id));

		return $this->update($data, $attr);
	}

	public function getAllParentCategory($status = null){
		$where_array=array(
			                'is_parent' => 1,
							'parent_id'	=> 0
		);
		if($status != null){
			$where_array['status']= $status;


		}
		$attr=array('where'=> $where_array);
		return $this->select($attr);  
	}

	public function getAllSubCatsForApi($parent_id){

		$attr = array(
					'fields' => 'id,name',
					'where' => array(
							'is_parent' => 0,
							'parent_id'	=> $parent_id
						),
						'orderby' => 'name ASC' 
				);

		return $this->select($attr);
	}
}
