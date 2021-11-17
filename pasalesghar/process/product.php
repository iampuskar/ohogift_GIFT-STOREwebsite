<?php
require $_SERVER['DOCUMENT_ROOT'].'/config/header.php';
if (!isset($_SESSION, $_SESSION['session_id']) || empty($_SESSION['session_id'])) {
    redirect('logout');
}
require CLASS_PATH.'baseModel.php';
require CLASS_PATH.'product.php';
require CLASS_PATH.'images.php';

$product = new Product();

//debugger($_POST,true);

    
if(isset($_POST) && !empty($_POST)){
     //debugger($_POST,true);
     //debugger($_FILES,true);
    $data = array();

    $data['title'] = sanitize($_POST['title']);
    $data['summary'] = sanitize($_POST['summary']);
    $data['description'] = htmlentities($_POST['description']);
    $data['cat_id'] = (int)$_POST['cat_id'];

    if(isset($_POST['sub_cat_id'])  && !empty($_POST['sub_cat_id'])){
        $data['sub_cat_id'] = (int)$_POST['sub_cat_id'];
    }

    
    $data['price'] = (float)$_POST['price'];
    $data['discount'] = (float)$_POST['discount'];
    $data['keyword'] = sanitize($_POST['keyword']);
    $data['is_featured'] = (isset($_POST['is_featured']) && !empty($_POST['is_featured'])) ? 1 : 0;
    $data['is_branded'] = (isset($_POST['is_branded']) && !empty($_POST['is_branded'])) ? 1 : 0;
    $data['brand'] = sanitize($_POST['is_branded']);

    //debugger($data,true);

    if(isset($_POST['vendor'])  && !empty($_POST['vendor'])){
        $data['vendor'] = (int)$_POST['vendor'];
    }


    $data['status'] = (int)$_POST['status'];
    $data['added_by'] = $_SESSION['auth_user_id'];

    if(isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0){
        $file_name = uploadSingleImage($_FILES['thumbnail'], 'product');
        if($file_name){
            $data['thumbnail'] = $file_name;
            //debugger($data,true);
        }
    }

    $product_id= isset($_POST['product_id']) ? (int)$_POST['product_id'] :null;
    //debugger($data,true);
//     $product_id = $product->addProduct($data);
//     //debugger($product_id,true);
//     if($product_id){
//         if(isset($_FILES['images']) && !empty($_FILES['images']['name'])){
//             foreach($_FILES['images']['name'] as $key=>$image_name){
//                 $temp = array();
//                 $temp['name'] = $image_name;
//                 $temp['type'] = $_FILES['images']['type'][$key];
//                 $temp['tmp_name'] = $_FILES['images']['tmp_name'][$key];
//                 $temp['error'] = $_FILES['images']['error'][$key];
//                 $temp['size'] = $_FILES['images']['size'][$key];

//                 $upload_image = uploadSingleImage($temp, 'product');
//                 if($upload_image){
//                     $image_db = new Images();
//                     $img_upload = array();
//                     $img_upload['product_id'] = $product_id;
//                     $img_upload['image_name'] = $upload_image;

//                     $image_db->addProductImage($img_upload);
//                 }
//             }

//         }
//         redirect('../product','success', "Product added successfully.");
//     } else {
//         redirect('../product', 'error', 'Sorry! There was problem while adding product.');
//     }
// } else if(isset($_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])) {
//         $id=(int)$_GET['id'];
//         if($_GET['act'] === substr(md5('del-product-'.$_SESSION['session_id'].'-'.$id), 3, 15)){
//            //debugger($_GET,true);

//             $product_info = $product->getProductById($id);
//             //debugger($product_info,true);
//             if($product_info){
//                 $del= $product->deleteProduct($id);
                
//                 if($del){
//                     if(isset($product_info[0]->image) && file_exists(UPLOAD_DIR.'product/'.$product_info[0]->image)){
//                         unlink(UPLOAD_DIR.'product/'.$product_info[0]->image); 
//                     }

//                     redirect('../product','success','product Deleted successfully');


//                      }else{
//                      redirect('../product','error', 'sorry problem while deleting file');

//                             }

//                        }else{
//                     redirect('../product','error', 'The product has been already deleted');   

//                     }

//                     }
//                     else{
//                     redirect('../product','error', 'Token is mismatched');
//                           }
//                      }
// else {
//     redirect('../product','error','Unauthorized access');
// }

// //debugger($_POST,true);

    if($product_id){

        $product_info = $product->getProductById($product_id);
        
        
        if(!$product_info){
            redirect('../product','error','product Not found');
        }

        if(isset($data['image']) && !empty($data['image']) && file_exists(UPLOAD_DIR.'product/'.$product_info[0]->image)){
            unlink(UPLOAD_DIR.'product/'.$product_info[0]->image);
        }

        $act="updat";
        $product_id = $product->updateProduct($data, $product_id);

    }else{
        $act="add";  
        $product_id = $product->addProduct($data); 
    }
   
    if ($product_id) {
        redirect('../product', 'success', "product ".$act."ed successfully.");
        //debugger($data, true);
        }else { 
              redirect('../product', 'error', "Sorry!!! There was a problem while ".$act."ing product.");
        }

       }

       else if(isset($_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])) {
        $id=(int)$_GET['id'];
        if($_GET['act'] === substr(md5('del-product-'.$_SESSION['session_id'].'-'.$id), 3, 15)){
           //debugger($_GET,true);

            $product_info = $product->getProductById($id);
            //debugger($product_info,true);
            if($product_info){
                $del= $product->deleteProduct($id);
                
                if($del){
                    if(isset($product_info[0]->image) && file_exists(UPLOAD_DIR.'product/'.$product_info[0]->image)){
                        unlink(UPLOAD_DIR.'product/'.$product_info[0]->image); 
                    }

                    redirect('../product','success','product Deleted successfully');


                     }else{
                     redirect('../product','error', 'sorry problem while deleting file');

                            }

                       }else{
                    redirect('../product','error', 'The product has been already deleted');   

                    }

                    }
                    else{
                    redirect('../product','error', 'Token is mismatched');
                          }
                     }

                   else {
                   redirect('../product', 'error', 'Unauthorized access.');
                } 