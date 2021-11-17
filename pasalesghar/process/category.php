<?php
require $_SERVER['DOCUMENT_ROOT'] . '/config/header.php';
if (!isset($_SESSION, $_SESSION['session_id']) || empty($_SESSION['session_id'])) {
    redirect('logout');
}
require CLASS_PATH . 'baseModel.php';
require CLASS_PATH . 'category.php';

$category = new Category();
//debugger($_GET,true);


if (isset($_POST) && !empty($_POST)) {

    debugger($_POST);
    //debugger($_FILES,true);
    $data               = array();
    $data['name']       = sanitize($_POST['title']);
    $data['summary']    = sanitize($_POST['summary']);
    $data['is_parent']  = isset($_POST['is_parent']) ? 1 : 0;
    $data['parent_id'] = isset($_POST['parent_id']) && !empty($_POST['parent_id']) ? (int)$_POST['parent_id'] : 0;
    $data['status']   = (int)$_POST['status'];
    $data['added_by'] = $_SESSION['auth_user_id'];

    $cat_id= isset($_POST['category_id']) ? (int)$_POST['category_id'] :null;
     //debugger($cat_id,true);


    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $file_name = uploadSingleImage($_FILES['image'], 'category');
        //debugger($file_name, true);
        if ($file_name) {
            $data['image'] = $file_name;
        }
    }

    
    if($cat_id){

        $category_info = $category->getCategoryById($cat_id);
        
        
        if(!$category_info){
            redirect('../category','error','category Not found');
        }

        if(isset($data['image']) && !empty($data['image']) && file_exists(UPLOAD_DIR.'category/'.$category_info[0]->image)){
            unlink(UPLOAD_DIR.'category/'.$category_info[0]->image);
        }

        $act="updat";
        $category_id = $category->updateCategory($data, $cat_id);

    }else{
        $act="add";  
        $category_id = $category->addCategory($data); 
    }
   
    if ($category_id) {
        redirect('../category', 'success', "category ".$act."ed successfully.");
        //debugger($data, true);
        }else { 
              redirect('../category', 'error', "Sorry!!! There was a problem while ".$act."ing category.");
        }

       }

       else if(isset($_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])) {
        $id=(int)$_GET['id'];
        if($_GET['act'] === substr(md5('del-category-'.$_SESSION['session_id'].'-'.$id), 3, 15)){
           //debugger($_GET,true);

            $category_info = $category->getCategoryById($id);
            //debugger($category_info,true);
            if($category_info){
                $del= $category->deleteCategory($id);
                
                if($del){
                    if(isset($category_info[0]->image) && file_exists(UPLOAD_DIR.'category/'.$category_info[0]->image)){
                        unlink(UPLOAD_DIR.'category/'.$category_info[0]->image); 
                    }

                    redirect('../category','success','category Deleted successfully');


                     }else{
                     redirect('../category','error', 'sorry problem while deleting file');

                            }

                       }else{
                    redirect('../category','error', 'The category has been already deleted');   

                    }

                    }
                    else{
                    redirect('../category','error', 'Token is mismatched');
                          }
                     }

                   else {
                   redirect('../category', 'error', 'Unauthorized access.');
                } 