<?php 
$page_title="categoryPage";
require 'inc/top-link.php';
if (!isset($_SESSION, $_SESSION['session_id']) || empty($_SESSION['session_id'])) {
    redirect('logout');
}

require CLASS_PATH.'baseModel.php';
require CLASS_PATH.'category.php';

$category = new Category;

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
                <h3>category List</h3>
               
              </div>

              <div class="title_right">

                <a href="javascript:;" class="btn btn-success pull-right" onclick="resetForm()">Add category</a>


              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>category List</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <table class="table table-borderd table-hover jambo_table">
                        <thead>
                          <th>S.N</th>
                          <th>category Title</th>
                          <th>category Image</th>
                          <th>category status</th>
                          <th>Is Parent</th>
                          <th>Parent Info</th>
                          <th>Action</th>

                        </thead>

                        <tbody>
                         <?php $all_category= $category->getAllcategory();
                         //debugger($all_category);


                         if($all_category){
                          foreach ($all_category as $key =>$category_info) {
                            ?>
                            <tr>
                              <td><?php echo $key+1; ?></td>
                              <td><?php echo $category_info->name; ?></td>
                              <td>
                                <?php 
                                if(file_exists(UPLOAD_DIR.'category/'.$category_info->image) && !empty($category_info->image)){
                                   ?>
                                   <img src="<?php echo UPLOAD_URL.'category/'.$category_info->image; ?>" alt="" class="img img-thumbnail img-responsive">
                                   <?php 
                                }else{

                                  echo "No files has been uploaded";

                                }

                                 ?>
                              </td>
                              <td><?php echo ($category_info->status ==1 )? 'Published' : 'Unpublished'; ?></td>
                             <td><?php echo ($category_info->is_parent ==1 )?'Yes':'No' ?></td>
                             <td><?php if($category_info->parent_id == 0){
                              echo '-';
                             }else{
                              $parent_cat_info =$category->getCategoryById($category_info->parent_id);
                              echo $parent_cat_info[0]->name;

                             } 
                             ?></td>
                              <td>

                                <?php 

                                $url= "process/category?id=".$category_info->id."&act=".substr(md5('del-category-'.$_SESSION['session_id'].'-'.$category_info->id), 3, 15);
                                ?>
                                 <a href="<?php echo $url; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">
                                 <i class="fa fa-trash"></i>
                              </a>

                              <a href="javascript:;"  data-data='<?php echo json_encode($category_info); ?>'  onclick="editcategory(this)" class="btn btn-success">
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
        <h4 class="modal-title" id="myModalLabel">category Add</h4>
      </div>
        <form action="process/category" method="post" enctype="multipart/form-data" class="form form-horizontal">
            <div class="modal-body">
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">category Title</label>
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
                    <label for="" class="col-sm-3 control-label">Is Parent</label>
                    <div class="col-sm-9">
                        
                        <input type="checkbox" name="is_parent"value="1" checked="" id="is_parent"> Yes
                    </div>
                </div>
                <div class="form-group hidden" id="parent_cat_div">
                    <label for="" class="col-sm-3 control-label">Parent Category</label>
                    <div class="col-sm-9">
                    <select name="parent_id" id="parent_id" class="form-control">  
                        <option value="" disabled="" selected="">--Select Any One--</option>
                         <?php $all_parent = $category->getAllParentCategory();
                               if($all_parent){
                               foreach($all_parent as $parent_info) {
                              ?>
                              <option value="<?php echo $parent_info->id; ?>"><?php echo $parent_info->name;?></option>
                              <?php
                            }
                          } 

                        ?>
                      </select>
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
              <input type="hidden" name="category_id" value="" id="category_id">
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

    function editcategory(elem){
      var data = $(elem).data('data');
      if(data){
        if(typeof(data) != 'object'){
          data = $.parseJSON(data);
        }
        showModal();
        $('#myModalLabel').html('category Update');
        $('#title').val(data.name);
        $('#summary').val(data.summary);
        $('#link').val(data.link);
        $('#status').val(data.status);

        if(data.is_parent == 1){
          $('#is_parent').prop('checked',true);
          $('#parent_cat_div').addClass('hidden');
          $('#parent_id').val('');
        }else{
          $('#is_parent').prop('checked',false);
          $('#parent_cat_div').removeClass('hidden');
          $('#parent_id').val(data.parent_id);
        }

        $('#image').removeAttr('required','required');
        $('#thumbnail').attr('src','<?php echo UPLOAD_URL;?>category/'+data.image);
        $('#category_id').val(data.id);

           
    }else{
      alert('sorry!!! Data could not be fetched at this time');

    }
  }

  function resetForm(){

        showModal();
        $('#myModalLabel').html('category Add');
        $('#title').val('');
        $('#summary').val('');
        $('#link').val('');
        $('#status').val('');
        $('#image').removeAttr('required','required');
        $('#thumbnail').attr('src','');
        $('#category_id').val(data.id);

          $('#is_parent').prop('checked',true);
          $('#parent_cat_div').addClass('hidden');
          $('#parent_id').val('');

           
  }

  $('#is_parent').on('click', function(){
    var prop = $('#is_parent').prop('checked');
    if (prop == false) {
      $('#parent_cat_div').removeClass('hidden');
    }else{
      $('#parent_cat_div').addClass('hidden');

    }


  });
   
   </script> 

   
  
   




