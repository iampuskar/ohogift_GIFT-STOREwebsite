<?php 

abstract class BaseModel{

	private $conn = null;
	private $table= null;

	private $stmt = null;
	private $sql = null;
	public function __construct(){
		try{
			$this->conn = new PDO('mysql:host='. DB_HOST .'; dbname=' . DB_NAME .';', DB_USER , DB_PASS );
			$this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$this->stmt =$this->conn->prepare('SET NAMES utf8');
			$this->stmt->execute();




		}catch(PDOException $e){
			error_log('PDO Message:'.$e->getMessage(),3, ERROR_LOG.'error_log');
			return false;

		}catch(Exception $e){
			error_log('General Exception:'.$e->getMessage(),3,ERROR_LOG.'error.log');
			return false;
		}
	}
	final protected function table($_table){
		$this->table = $_table;
	}
	final protected function select($args = array(), $is_die = false  ){
		try{

			$this->sql="SELECT ";
			if(!isset($args['fields'])|| empty($args['fields'])){
				$this->sql.=" * ";
			}else{
				if(is_array($args['fields'])){
					$this->sql.=implode(", ", $args['fields']);

				}else{
					$this->sql.=$args['fields'];
				}

			}

			$this->sql.= " FROM  ";
			if(!isset($this->table) || empty($this->table)){
				throw new Exception("Table Not set.");
				
			}

			$this->sql .=$this->table;

			/* JOIN */
			if(isset($args['join']) && !empty($args['join'])){
				$this->sql .="".$args['join'];
			}

			/* WHERE*/
			if(isset($args, $args['where']) && !empty($args['where'])){
				if(is_string($args['where'])){
					$this->sql.=" WHERE ".$args['where'];
				}else{

				$temp=array();
				foreach ($args['where'] as $column_name => $value) {
					$str=$column_name." = :".$column_name;
					$temp[]=$str;
						
					}
					$this->sql.=" WHERE ".implode(' AND ',$temp);	

				}
			}
                   if(isset($args['groupby']) && !empty($args['groupby'])){
                   	$this->sql .=" GROUP BY ".$args['groupby'];
                   }


			if(isset($args['orderby']) && !empty($args['orderby'])){
				$this->sql .= " ORDER BY ".$args['orderby'];
			}else{
				$this->sql .= " ORDER BY ".$this->table.".id DESC";
			}

			if(isset($args['limit']) && !empty($args['limit']))
			{
				$this->sql .= " LIMIT ".$args['limit'];
			}

			$this->stmt = $this->conn->prepare($this->sql);
			if(isset($args['where']) && !empty($args['where'])&& is_array($args['where'])){
				$temp=array();
				foreach ($args['where']  as $column_name => $value) {
					if(is_null($value)){
						$param = PDO::PARAM_NULL;

					}else if(is_bool($value)){
						$param = PDO::PARAM_BOOL;
					}else if(is_int($value)) {
                         $param= PDO::PARAM_INT;
					}else{
						$param= PDO::PARAM_STR;
					}

					if($param){
						$this->stmt->bindValue(":".$column_name, $value, $param);
					}
					
				}
			}
			
			if($is_die){
				echo $this->sql;
				die();
			}

			$this->stmt->execute();

			$data = $this->stmt->fetchALL(PDO::FETCH_OBJ);
			return $data;

		}catch(PDOException $e){
			error_log('PDO Message:'.$e->getMessage(),3, ERROR_LOG.'error_log');
			return false;

		}catch(Exception $e){
			error_log('General Exception:'.$e->getMessage(),3,ERROR_LOG.'error.log');
			return false;
		}
	}

	final protected function update($data= array(), $condition= array()){
		try{

			$this->sql ="UPDATE ";

			

			if(!isset($this->table)|| empty($this->table)){
				throw new Exception("Table not set"); 
			}
			$this->sql.=$this->table." SET ";



			if(isset($data) && !empty($data)){
				if(is_string($data)){
					$this->sql.=$data;
				}else{
					$temp=array();
					foreach ($data as $column_name => $value) {
						$str = $column_name." = :".$column_name;
						$temp[]=$str;
						
					}
					$this->sql.=implode(',', $temp);

				}
			}

			if(isset($condition['where']) && !empty($condition['where'])){
				if(is_string($condition['where'])){
					$this->sql.=" WHERE ".$condition;
				}else{
					$temp=array();
					foreach ($condition['where'] as $column_name => $value) {

						$str=$column_name." = :".$column_name;
						$temp[]=$str;
						
					}
					$this->sql .= " WHERE " . implode(" AND ", $temp);
				}
			}
			$this->stmt = $this->conn->prepare($this->sql);
			if (isset($data) && !empty($data) && is_array($data))  {
				foreach ($data as $column_name => $value) {
					if(is_null($value)){
						$param = PDO::PARAM_NULL; 
					}else if(is_int($value)){
						$param =PDO::PARAM_INT;
					}else if(is_bool($value)){
						$param =PDO::PARAM_BOOL;
					}else{
						$param=PDO::PARAM_STR;
					}

					if($param){
						$this->stmt->bindValue(":".$column_name, $value, $param);
					}
				}
				
			}

			if (isset($condition['where']) && !empty($condition['where']) && is_array($condition['where']))  {
				foreach ($condition['where'] as $column_name => $value) {
					if(is_null($value)){
						$param = PDO::PARAM_NULL; 
					}else if(is_int($value)){
						$param =PDO::PARAM_INT;
					}else if(is_bool($value)){
						$param =PDO::PARAM_BOOL;
					}else{
						$param=PDO::PARAM_STR;
					}

					if($param){
						$this->stmt->bindValue(":".$column_name, $value, $param);
					}
				}
				
			}

			return $this->stmt->execute();
			

		}catch(PDOException $e){
			error_log('PDO Message:'.$e->getMessage(),3, ERROR_LOG.'error_log');
			return false;

		}catch(Exception $e){
			error_log('General Exception:'.$e->getMessage(),3,ERROR_LOG.'error.log');
			return false;
		}
	}

	final protected function insert($data = array()){

		try{

			$this->sql ="INSERT  ";

			

			if(!isset($this->table)|| empty($this->table)){
				throw new Exception("Table not set"); 
			}
			$this->sql.=$this->table." SET ";



			if(isset($data) && !empty($data)){
				if(is_string($data)){
					$this->sql.=$data;
				}else{
					$temp=array();
					foreach ($data as $column_name => $value) {
						$str = $column_name." = :".$column_name;
						$temp[]=$str;
						
					}
					$this->sql.=implode(',', $temp);

				}
			}

			
			$this->stmt = $this->conn->prepare($this->sql);
			if (isset($data) && !empty($data) && is_array($data))  {
				foreach ($data as $column_name => $value) {
					if(is_null($value)){
						$param = PDO::PARAM_NULL; 
					}else if(is_int($value)){
						$param =PDO::PARAM_INT;
					}else if(is_bool($value)){
						$param =PDO::PARAM_BOOL;
					}else{
						$param=PDO::PARAM_STR;
					}

					if($param){
						$this->stmt->bindValue(":".$column_name, $value, $param);
					}
				}
				
			}

			

			$success = $this->stmt->execute();
			if($success){
				return $this->conn->lastInsertId();
			}else{
				return false;
			}
			

		}catch(PDOException $e){
			error_log('PDO Message:'.$e->getMessage(),3, ERROR_LOG.'error_log');
			return false;

		}catch(Exception $e){
			error_log('General Exception:'.$e->getMessage(),3,ERROR_LOG.'error.log');
			return false;
		}
	}

	final protected function delete($args = array()){
		try{  
			$this->sql="DELETE ";
			

			$this->sql.= " FROM  ";
			
			if(!isset($this->table) || empty($this->table)){
				throw new Exception("Table Not set.");
				
			}

			$this->sql .= $this->table;

			/* WHERE*/
			if(isset($args['where']) && !empty($args['where'])){
				if(is_string($args['where'])){
					$this->sql.=" WHERE ".$args['where'];
				}else{

				$temp=array();
				foreach ($args['where'] as $column_name => $value) {
					$str=$column_name." = :".$column_name;
					$temp[]=$str;
						
					}
					$this->sql.=" WHERE ".implode(' AND ',$temp);	

				}
			}

			$this->stmt = $this->conn->prepare($this->sql);
			if(isset($args['where']) && !empty($args['where'])&& is_array($args['where'])){
				$temp=array();
				foreach ($args['where']  as $column_name => $value) {
					if(is_null($value)){
						$param = PDO::PARAM_NULL;

					}else if(is_bool($value)){
						$param = PDO::PARAM_BOOL;
					}else if(is_int($value)) {
                         $param= PDO::PARAM_INT;
					}else{
						$param= PDO::PARAM_STR;
					}

					if($param){
						$this->stmt->bindValue(":".$column_name, $value, $param);
					}
					
				}
			}

			return $this->stmt->execute();
			

		}catch(PDOException $e){
			error_log('PDO Message:'.$e->getMessage(),3, ERROR_LOG.'error_log');
			return false;

		}catch(Exception $e){
			error_log('General Exception:'.$e->getMessage(),3,ERROR_LOG.'error.log');
			return false;
		}

	}
}    