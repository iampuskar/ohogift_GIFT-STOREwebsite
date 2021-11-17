<?php
require $_SERVER['DOCUMENT_ROOT'] . '/config/header.php';
if (!isset($_SESSION, $_SESSION['session_id']) || empty($_SESSION['session_id'])) {
    redirect('logout');
}
require CLASS_PATH . 'baseModel.php';
require CLASS_PATH . 'banner.php';

$banner = new Banner();
//debugger($_GET,true);


if (isset($_POST) && !empty($_POST)) {

    //debugger($_POST,true);
    //debugger($_FILES,true);
    $data             = array();
    $data['title']    = sanitize($_POST['title']);
    $data['summary']  = sanitize($_POST['summary']);
    $data['link']     = filter_var($_POST['link'], FILTER_VALIDATE_URL);
    $data['status']   = (int) $_POST['status'];
    $data['added_by'] = $_SESSION['auth_user_id'];
    //debugger($data,true);

    $ban_id= isset($_POST['banner_id'])? (int)$_POST['banner_id'] :null;



    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $file_name = uploadSingleImage($_FILES['image'], 'banner');
        //debugger($file_name, true);
        if ($file_name) {
            $data['image'] = $file_name;
        }
    }

    
    if($ban_id){

        $banner_info = $banner->getBannerById($ban_id);
       // debugger($banner_info,true);
        if(!$banner_info){
            redirect('../banner','error','Banner Not found');
        }

        if(isset($data['image']) && !empty($data['image']) && file_exists(UPLOAD_DIR.'banner/'.$banner_info[0]->image)){
            unlink(UPLOAD_DIR.'banner/'.$banner_info[0]->image);
        }

        $act="updat";
        $banner_id = $banner->updateBanner($data, $ban_id);

    }else{
        $act="add";  
        $banner_id = $banner->addBanner($data);
        //debugger($banner_id,true); 
    }
   
    if ($banner_id) {
        redirect('../banner', 'success', "Banner ".$act."ed successfully.");
        //debugger($data, true);
        }else { 
              redirect('../banner', 'error', "Sorry!!! There was a problem while ".$act."ing Banner.");
        }

       }

       else if(isset($_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])) {
        $id=(int)$_GET['id'];
        if($_GET['act'] === substr(md5('del-banner-'.$_SESSION['session_id'].'-'.$id), 3, 15)){
           //debugger($_GET,true);

            $banner_info = $banner->getBannerById($id);
            //debugger($banner_info,true);
            if($banner_info){
                $del= $banner->deleteBanner($id);
                
                if($del){
                    if(isset($banner_info[0]->image) && file_exists(UPLOAD_DIR.'banner/'.$banner_info[0]->image)){
                        unlink(UPLOAD_DIR.'banner/'.$banner_info[0]->image); 
                    }

                    redirect('../banner','success','Banner Deleted successfully');


                     }else{
                     redirect('../banner','error', 'sorry problem while deleting file');

                            }

                       }else{
                    redirect('../banner','error', 'The banner has been already deleted');   

                    }

                    }
                    else{
                    redirect('../banner','error', 'Token is mismatched');
                          }
                     }

                   else {
                   redirect('../banner', 'error', 'Unauthorized access.');
                } 