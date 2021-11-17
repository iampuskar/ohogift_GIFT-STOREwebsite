<?php 
$page_title="BannerPage";
require 'inc/top-link.php';
if (!isset($_SESSION, $_SESSION['session_id']) || empty($_SESSION['session_id'])) {
    redirect('logout');
}

require CLASS_PATH.'baseModel.php';
require CLASS_PATH.'banner.php';

$banner = new Banner;

//debugger($_SESSION, true);
?>
      <div class="container body">
      <div class="main_container">
      <?php require 'inc/sidebar.php'; ?>
    
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <?php flash(); ?>
            <div class="page-title">
              <div class="title_left">
                <h3>Banner List</h3>
               
              </div>

              <div class="title_right">

                <a href="javascript:;" class="btn btn-success pull-right" onclick="resetForm()">Add Banner</a>


              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Banner List</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <table class="table table-borderd table-hover jambo_table" >
                        <thead>
                          <th>S.N</th>
                          <th>Banner Title</th>
                          <th>Banner Image</th>
                          <th>Banner status</th>
                          <th>Banner Link</th>
                          <th>Action</th>

                        </thead>

                        <tbody>
                         <?php $all_banner= $banner->getAllBanner();
                         //debugger($all_banner);


                         if($all_banner){
                          foreach ($all_banner as $key =>$banner_info) {
                            ?>
                            <tr>
                              <td><?php echo $key+1; ?></td>
                              <td><?php echo $banner_info->title; ?></td>
                              <td>
                                <?php 
                                if(file_exists(UPLOAD_DIR.'banner/'.$banner_info->image) && !empty($banner_info->image)){
                                   ?>
                                   <img src="<?php echo UPLOAD_URL.'banner/'.$banner_info->image; ?>" alt="" class="img img-thumbnail img-responsive">
                                   <?php 
                                }else{

                                  echo "No files has been uploaded";

                                }

                                 ?>
                              </td>
                              <td><?php echo ($banner_info->status ==1 )? 'Published' : 'Unpublished'; ?></td>
                              <td><?php

                              if($banner_info->link !=""){
                                echo'<a href="'.$banner_info->link.'" class="btn-link" target="_link">'.$banner_info->link.'</a>';
                              } 

                               ?></td>
                              <td>

                                <?php 

                                $url= "process/banner?id=".$banner_info->id."&act=".substr(md5('del-banner-'.$_SESSION['session_id'].'-'.$banner_info->id), 3, 15);
                                ?>
                                 <a href="<?php echo $url; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Banner?')">
                                 <i class="fa fa-trash"></i>
                              </a>

                              <a href="javascript:;"  data-data='<?php echo json_encode($banner_info); ?>'  onclick="editBanner(this)" class="btn btn-success">
                                <i class="fa fa-pencil"></i>
                              </a>


                            </td>
                            </tr>
                            <?php
                          }
                         }


                         ?>

                        </tbody>
                        
                      </table>
                  </div>
                </div>
              </div>  
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
           &copy;<?php echo date('Y') ?> All rights Reserved.
           Powered by Pasale Admin
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" backdrop="static" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Banner Add</h4>
      </div>
        <form action="process/banner" method="post" enctype="multipart/form-data" class="form form-horizontal">
            <div class="modal-body">
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Banner Title</label>
                    <div class="col-sm-9">
                        <input type="text" name="title" required id="title" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Summary</label>
                    <div class="col-sm-9">
                        <textarea name="summary" id="summary" rows="6" style="resize: none;" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Link</label>
                    <div class="col-sm-9">
                        <input type="url" name="link" required id="link" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Status</label>
                    <div class="col-sm-9">
                        <select name="status" id="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Image</label>
                    <div class="col-sm-4">
                        <input type="file" name="image" onchange="showThumbnail(this)" accept="image/*" required id="image">
                    </div>
                    <div class="col-sm-4">
                        <img src="" id="thumbnail" alt="" class="img img-thumbnail img-responsive">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
              <input type="hidden" name="banner_id" value="" id="banner_id">
                <button type="reset" class="btn btn-danger" data-dismiss="modal">
                    <i class="fa fa-trash"></i>
                    Close
                </button>
                <button type="submit" class="btn btn-success" >
                    <i class="fa fa-send"></i>
                    Save changes</button>
            </div>
        </form>
    </div>
  </div>
</div>


    <?php $scripts = '<script type="text/javascript" src="'.ADMIN_VENDORS_URL.'datatable/datatables.min.js"' ;?>
  
  <?php require 'inc/footer.php'; ?>
   

   <script type="text/javascript">
    $('.table').dataTable(); 

     </script>
    
    <script type="text/javascript" >
   function showModal(){
   
      $('.modal').modal('show'); 
  }
     
      //setTimeout(function(){
      //showModal();
     // }, 1000);
      //showModal();

       function showThumbnail(elem){
        if(elem.files && elem.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#thumbnail').attr('src', e.target.result);
            }
            reader.readAsDataURL(elem.files[0]);
        }
    }

    function editBanner(elem){
      var data = $(elem).data('data');
      if(data){
        if(typeof(data) != 'object'){
          data = $.parseJSON(data);
        }
        showModal();
        $('#myModalLabel').html('Banner Update');
        $('#title').val(data.title);
        $('#summary').val(data.summary);
        $('#link').val(data.link);
        $('#status').val(data.status);
        $('#image').removeAttr('required','required');
        $('#thumbnail').attr('src','<?php echo UPLOAD_URL;?>banner/'+data.image);
        $('#banner_id').val(data.id);

           
    }else{
      alert('sorry!!! Data could not be fetched at this time');

    }
  }

  function resetForm(){

        showModal();
        $('#myModalLabel').html('Banner Add');
        $('#title').val('');
        $('#summary').val('');
        $('#link').val('');
        $('#status').val('');
        $('#image').removeAttr('required','required');
        $('#thumbnail').attr('src','');
        $('#banner_id').val(data.id);

           
  }
   
   </script> 

   
  
   




