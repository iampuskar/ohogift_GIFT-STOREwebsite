<?php 

class User extends BaseModel{

	public $user_id=null;

	public function __construct(){

		parent::__construct();
		$this->table('users');
	}
	public function getUserByUsername($user_name) {
		$attr = array(
			'fields' => array('id', 'full_name', 'email_address', 'password', 'role_id', 'status'),
			//'where' => array('email_address' => $user_name, 'status' => 1),
			'where' => "email_address = '" . $user_name . "'",
		);
		/* SELECT * FROM users WHERE email_address = '$user_name'*/
		return $this->select($attr);
	}
	
	public function getUserByhash($session_id){
		$attr = array('where' => array('hash'=>$session_id));
		return $this->select($attr);
	}

	public function updateUser($data){
		$attr=array('where'=>array('id'=>$this->user_id));
		return $this->update($data, $attr);	
	}

	public function addUser($data){
		return $this->insert($data);
	}

	public function getAllUser(){
		
		return $this->select();
	}
}














 ?>