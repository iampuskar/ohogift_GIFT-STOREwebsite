<?php

class Advertisement extends BaseModel{
    public function __construct(){
        parent::__construct();
        $this->table('advertisements');
    }

    public function addAdvertisement($data){
        return $this->insert($data);
    }   

    public function getAllAdvertisement(){
        return $this->select();
    }

     public function getAdvertisementlimit(){
   $args = array(

      'fields'=> "advertisements.id, advertisements.title, advertisements.date_from, advertisements.date_to, advertisements.image, advertisements.status",

          
    );
            $where = " advertisements.status = 1 ";
            
            

            
            //debugger($search_options);
            $args['where'] = $where;
            $args['groupby']= " advertisements.id"; 
            $args['limit'] = " 0,3";


            $data = $this->select($args);
            //debugger($data,true);
            return $data;
  }

    public function getAdvertisementById($id){
        $attr = array('where'=> array('id'=>$id));
        return  $this->select($attr);
    } 

    public function deleteAdvertisement($id){

        $attrs=array('where'=> array('id'=>$id));
        return $this->delete($attrs);
    }
    public function updateAdvertisement($data, $add_id ){

        $attr=array('where'=> array('id'=>$add_id));
        return $this->update($data, $attr);
    }

}