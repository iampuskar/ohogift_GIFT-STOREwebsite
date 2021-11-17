<?php 
$page_title="ProductPage";
require 'inc/top-link.php';
if (!isset($_SESSION, $_SESSION['session_id']) || empty($_SESSION['session_id'])) {
    redirect('logout');
}

require CLASS_PATH.'baseModel.php';
require CLASS_PATH.'product.php';
require CLASS_PATH.'category.php';

$Product = new Product;
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
                <h3>Product List</h3>
               
              </div>

              <div class="title_right">

                <a href="javascript:;" class="btn btn-success pull-right" onclick="resetForm()">Add Product</a>


              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Product List</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <table class="table table-borderd table-hover jambo_table" >
                        <thead>
                                        <th>S.N.</th>
                                        <th>product Title</th>
                                        <th>product Image</th>
                                        <th>product Status</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $all_products = $Product->getAllProduct();
                                            //debugger($all_products);
                                            if($all_products){
                                                foreach($all_products as $key=>$product_info){
                                            ?>
                                            <tr>
                                                <td><?php echo $key+1; ?></td>
                                                <td><?php echo $product_info->title; ?></td>
                                                <td style="max-width: 200px;">
                                                    <?php  
                                                        if(file_exists(UPLOAD_DIR.'product/'.$product_info->thumbnail) && !empty($product_info->thumbnail)){
                                                        ?>
                                                        <img src="<?php echo UPLOAD_URL.'product/'.$product_info->thumbnail;?>" alt="" class="img img-thumbnail img-responsive">
                                                        <?php
                                                        } else {
                                                            echo "No file has been uploaded.";
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo ($product_info->status == 1) ? 'Published' : 'Unpublished'; ?></td>
                                                <td>
                                                    NPR. <?php echo $product_info->price; ?>
                                                </td>
                                                <td>
                                                    <?php echo $product_info->discount ?> %
                                                </td>
                                                <td>
                                                    <?php 
                                                        $url= "process/product?id=".$product_info->id."&act=".substr(md5('del-product-'.$_SESSION['session_id'].'-'.$product_info->id), 3, 15);
                                                    ?>
                                                    <a href="<?php echo $url;?>" class="btn btn-danger" style="border-radius: 50%" onclick="return confirm('Are you sure you want to delete this product?');">
                                                        <i class="fa fa-trash"></i>
                                                    </a>

                                                     <a href="javascript:;"  data-data='<?php echo json_encode($product_info); ?>'  onclick="editProduct(this)" class="btn btn-success">
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
               &copy; <?php echo date('Y') ?> All rights Reserved.
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
            <h4 class="modal-title" id="myModalLabel">Products Add</h4>
         </div>
         <form action="process/product" method="post" enctype="multipart/form-data" class="form form-horizontal">
            <div class="modal-body">
               <div class="form-group">
                  <label for="" class="col-sm-3 control-label">Title</label>
                  <div class="col-sm-9">
                     <input type="text" name="title" required id="title" class="form-control">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="" class="col-sm-3 control-label">Summary</label>
                  <div class="col-sm-9">
                     <input type="text" name="summary" required id="summary" class="form-control">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="" class="control-label col-sm-3">Description: </label>
                  <div class="col-sm-8">
                     <textarea name="description" id="description" rows="4" style="resize: none;" class="form-control"></textarea>
                  </div>
               </div>
               <div class="form-group">
                  <label for="" class="col-sm-3 control-label">Parent Category</label>
                  <div class="col-sm-9">
                     <select name="cat_id" id="cat_id" class="form-control">
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
               <div class="form-group row">
                  <label for="" class="control-label col-sm-3">Price: </label>
                  <div class="col-sm-8">
                     <input type="number" name="price" required placeholder="Enter Price" class="form-control" id="price" min="1">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="" class="control-label col-sm-3">Discount(in %): </label>
                  <div class="col-sm-8">
                     <input type="number" name="discount" placeholder="Enter Discount" class="form-control" id="discount" max="100">
                  </div>
               </div>
               <div class="form-group">
                  <label for="" class="col-sm-3 control-label">Keyword</label>
                  <div class="col-sm-9">
                     <input type="text" name="keyword" required id="keyword" class="form-control">
                  </div>
               </div>
             <!--   <div class="form-group row">
                  <label for="" class="control-label col-sm-3">Is Featured: </label>
                  <div class="col-sm-8">
                     <input type="checkbox" name="is_featured"  id="is_featured" value="" > Yes
                  </div>
               </div>
               <div class="form-group row">
                  <label for="" class="control-label col-sm-3">Is Branded: </label>
                  <div class="col-sm-8">
                     <input type="checkbox" name="is_branded"  id="is_branded" value="" > Yes
                  </div>
               </div> -->
               <!-- <div class="form-group">
                  <label for="" class="col-sm-3 control-label">Brand</label>
                  <div class="col-sm-9">
                     <input  name="brand" required id="brand" class="form-control">
                  </div>
               </div> -->
               <!-- <div class="form-group row">
                  <label for="" class="control-label col-sm-3">Images: </label>
                  <div class="col-sm-8">
                     <input type="file" name="images[]" accept="image/*" multiple />
                  </div>
               </div> -->
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
                  <label for="" class="col-sm-3 control-label">Thumbnail</label>
                  <div class="col-sm-4">
                     <input type="file" name="thumbnail" onchange="showThumbnail(this)" accept="image/*" required id="image">
                  </div>
                  <div class="col-sm-4">
                     <img src="" id="thumbnail" alt="" class="img img-thumbnail img-responsive">
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <input type="hidden" name="product_id" value="" id="product_id">
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



<?php $scripts = '<script type="text/javascript" src="'.ADMIN_VENDORS_URL.'datatable/datatables.min.js"></script>
<script type="text/javascript">$(".table").dataTable();</script>'; ?>
<?php require 'inc/footer.php';?>

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

    function editProduct(elem){
      var data = $(elem).data('data');
      if(data){
        if(typeof(data) != 'object'){
          data = $.parseJSON(data);
        }
        showModal();
        $('#myModalLabel').html('product Update');
        $('#title').val(data.title);
        $('#summary').val(data.summary);
        $('#description').val(data.description);
        $('#cat_id').val(data.cat_id);
        $('#price').val(data.price);
        $('#discount').val(data.discount);
        $('#keyword').val(data.keyword);
        $('#is_featured').val(data.is_featured);
        $('#is_branded').val(data.is_branded);
        $('#brand').val(data.brand);
        $('#thumbnail').attr('src','<?php echo UPLOAD_URL;?>product/'+data.image);
        $('#status').val(data.status);
        $('#image').removeAttr('required','required');
        $('#product_id').val(data.id);

           
    }else{
      alert('sorry!!! Data could not be fetched at this time');

    }
  }

  function resetForm(){

        showModal();
        $('#myModalLabel').html('Product Add');
        $('#title').val('');
        $('#summary').val('');
        $('#description').val('');
        $('#cat_id').val('');
        $('#price').val('');
        $('#discount').val('');
        $('#keyword').val('');
        $('#is_featured').val('');
        $('#is_branded').val('');
        $('#brand').val('');
        $('#thumbnail').attr('src','');
        $('#status').val('');
        $('#image').removeAttr('required','required');
        $('#product_id').val(data.id);
           
  }
   
   </script> 