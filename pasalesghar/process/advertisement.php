<?php
require $_SERVER['DOCUMENT_ROOT'] . '/config/header.php';
if (!isset($_SESSION, $_SESSION['session_id']) || empty($_SESSION['session_id'])) {
    redirect('logout');
}
require CLASS_PATH . 'baseModel.php';
require CLASS_PATH . 'advertisement.php';

$advertisement = new Advertisement();
//debugger($_GET,true);


if (isset($_POST) && !empty($_POST)) {

    //debugger($_POST);
    //debugger($_FILES,true);
    $data             = array();
    $data['title']    = sanitize($_POST['title']);
    $data['date_from'] = isset($_POST['date_from']) && !empty($_POST['date_from']) ? $_POST['date_from'] : 0 ;
    $data['date_to'] = isset($_POST['date_to']) && !empty($_POST['date_to']) ? $_POST['date_to'] : 0 ;
    $data['status']   = (int) $_POST['status'];
    $data['added_by'] = $_SESSION['auth_user_id'];
    

    $add_id= isset($_POST['advertisement_id'])? (int)$_POST['advertisement_id'] :null;


   
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $file_name = uploadSingleImage($_FILES['image'], 'advertisement');
        //debugger($file_name, true);
        if ($file_name) {
            $data['image'] = $file_name;
        }
    }

    
    if($add_id){

        $advertisement_info = $advertisement->getAdvertisementById($add_id);
       // debugger($advertisement_info,true);
        if(!$advertisement_info){
            redirect('../advertisement','error','advertisement Not found');
        }

        if(isset($data['image']) && !empty($data['image']) && file_exists(UPLOAD_DIR.'advertisement/'.$advertisement_info[0]->image)){
            unlink(UPLOAD_DIR.'advertisement/'.$advertisement_info[0]->image);
        }

        $act="updat";
        $advertisement_id = $advertisement->updateAdvertisement($data, $add_id);
        
    }else{
        $act="add";  
        $advertisement_id = $advertisement->addAdvertisement($data);
        //debugger($advertisement_id,true); 
    }
   
    if ($advertisement_id) {
        redirect('../advertisement', 'success', "advertisement ".$act."ed successfully.");
        //debugger($data, true);
        }else { 
              redirect('../advertisement', 'error', "Sorry!!! There was a problem while ".$act."ing advertisement.");
        }

       }

       else if(isset($_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])) {
        $id=(int)$_GET['id'];
        if($_GET['act'] === substr(md5('del-advertisement-'.$_SESSION['session_id'].'-'.$id), 3, 15)){
           //debugger($_GET,true);

            $advertisement_info = $advertisement->getAdvertisementById($id);
            //debugger($advertisement_info,true);
            if($advertisement_info){
                $del= $advertisement->deleteAdvertisement($id);
               // debugger($del,true);
                
                if($del){
                    if(isset($advertisement_info[0]->image) && file_exists(UPLOAD_DIR.'advertisement/'.$advertisement_info[0]->image)){
                        unlink(UPLOAD_DIR.'advertisement/'.$advertisement_info[0]->image); 
                    }

                    redirect('../advertisement','success','advertisement Deleted successfully');


                     }else{
                     redirect('../advertisement','error', 'sorry problem while deleting file');

                            }

                       }else{
                    redirect('../advertisement','error', 'The advertisement has been already deleted');   

                    }

                    }
                    else{
                    redirect('../advertisement','error', 'Token is mismatched');
                          }
                     }

                   else {
                   redirect('../advertisement', 'error', 'Unauthorized access.');
                } 