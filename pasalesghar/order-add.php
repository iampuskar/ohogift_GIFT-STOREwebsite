<?php require 'inc/top-link.php';
if (!isset($_SESSION, $_SESSION['session_id']) || empty($_SESSION['session_id'])) {
    redirect('logout');
}

require_once CLASS_PATH.'baseModel.php';
require_once CLASS_PATH.'category.php';
$category = new Category();
$all_parents = $category->getAllParentCategory();

?>
<div class="container body">
    <div class="main_container">
  <?php require 'inc/sidebar.php';?>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <?php flash();?>
                    <div class="title_left">
                        <h3>Product Add</h3>
                    </div>

                    <div class="title_right">
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Product Add</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                 <form action="process/product" method="post" enctype="multipart/form-data" class="form form-horizontal">
                                        <div class="form-group row">
                                            <label for="" class="control-label col-sm-3">Title: </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="title" required placeholder="Enter Title" class="form-control" id="title">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="control-label col-sm-3">Summary: </label>
                                            <div class="col-sm-8">
                                                <textarea name="summary" required id="summary" rows="4" style="resize: none;" class="form-control"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="control-label col-sm-3">Description: </label>
                                            <div class="col-sm-8">
                                                <textarea name="description" id="description" rows="4" style="resize: none;" class="form-control"></textarea>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="" class="control-label col-sm-3">Category: </label>
                                            <div class="col-sm-8">
                                                <select name="cat_id" required id="cat_id" class="form-control">
                                                    <option value="" selected disabled>--Select Any One--</option>
                                                    <?php 
                                                        if($all_parents){
                                                            foreach($all_parents as $parent_cats){
                                                    ?>
                                                            <option value="<?php echo $parent_cats->id; ?>"><?php echo $parent_cats->name ?></option>
                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row hidden" id="child_cat_div">
                                            <label for="" class="control-label col-sm-3">Sub Category: </label>
                                            <div class="col-sm-8">
                                                <select name="sub_cat_id" id="sub_cat_id" class="form-control">
                                                    <option value="" selected disabled>--Select Any One--</option>

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

                                        <div class="form-group row">
                                            <label for="" class="control-label col-sm-3">Keyword: </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="keyword" placeholder="Enter Keyword" class="form-control" id="keyword" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="control-label col-sm-3">Is Featured: </label>
                                            <div class="col-sm-8">
                                                <input type="checkbox" name="is_featured" value="1" > Yes
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="control-label col-sm-3">Is Branded: </label>
                                            <div class="col-sm-8">
                                                <input type="checkbox" name="is_branded" value="1" > Yes
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="control-label col-sm-3">Brand: </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="brand" id="brand"  class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="control-label col-sm-3">Thumbnail: </label>
                                            <div class="col-sm-8">
                                                <input type="file" name="thumbnail" accept="image/*" required />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="control-label col-sm-3">Status: </label>
                                            <div class="col-sm-8">
                                                <select name="status" id="status" class="form-control" required>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="control-label col-sm-3">Images: </label>
                                            <div class="col-sm-8">
                                                <input type="file" name="images[]" accept="image/*" multiple />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="control-label col-sm-3"> </label>
                                            <div class="col-sm-8">
                                                <button class="btn btn-success">
                                                    <i class="fa fa-send"></i> Submit
                                                </button>
                                            </div>
                                        </div>

                                        
                                 </form>
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
               &copy; <?php echo date('Y') ?> All rights Reserved. Powered By pasale
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>
<?php require 'inc/footer.php';?>
<script type="text/javascript" src="<?php echo ADMIN_VENDORS_URL.'tinymce/tinymce.min.js'; ?>"></script>
<script type="text/javascript">
    $('#cat_id').on('change', function(){
        var cat_id = $('#cat_id').val();

        $.post('inc/api', {category_id: cat_id, act: "<?php echo substr(md5('sub-cat-info-'.$_SESSION['session_id']), 5, 15);?>"}, function(res){
            var data = null;
            if(typeof(res) == 'string'){
                data = $.parseJSON(res);
            } else {
                data = res;
            }

            //console.log(data);

            if(data.status.status == true){
                var sub_cat_info = data.body;
                var option_html = '<option value="" selected disabled>--Select Any One--</option>';

                if(sub_cat_info){
                    $.each(sub_cat_info, function(key, value){
                        option_html += "<option value='"+value.id+"'>"+value.name+"</option>";
                    });
                    $('#sub_cat_id').html(option_html);

                    $('#child_cat_div').removeClass('hidden');
                } else {
                    $('#sub_cat_id').html(option_html);
                    $('#child_cat_div').addClass('hidden');
                }
            }
        });

        /*$.get();
        $.post();

        $.ajax();
        
        alert(cat_id);*/
    });

    tinymce.init({
      selector: '#description',
      height: 300,
      
      plugins: 'print preview searchreplace autolink directionality  visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
      toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
     });
</script>