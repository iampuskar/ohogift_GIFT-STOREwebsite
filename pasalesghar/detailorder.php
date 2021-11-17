<?php 
$page_title="Dashboard";
require 'inc/top-link.php';
//debugger($_SESSION, true);
if(!isset($_SESSION,$_SESSION['session_id']) || empty($_SESSION['session_id']) || empty($_SESSION['full_name'])){
  redirect('index','error','Please login first.');
} 
//debugger($_SESSION, true);

require_once CLASS_PATH.'/baseModel.php';
require_once CLASS_PATH.'/order.php';


$order = new Order();
?>
      <div class="container body">
      <div class="main_container">
      <?php require 'inc/sidebar.php'; ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Plain Page</h3>
                <?php flash(); ?>
              </div>

              <div class="title_right">
                <a href="order" class="btn btn-success pull-right">Back to Order Page</a>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Plain Page</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                       <table class="table table-borderd table-hover jambo_table ">
                                  <thead>
                                    <th>S.N.</th>
                                    <th>Cart ID</th>
                                    <th>Product</th>
                                    <th>Image</th>
                                    <th>Quantity</th>
                                    <th>Customer</th>
                                    <th>Delivery Type</th>
                                    
                                    
                                    
                                    <th>Action</th>
                                  </thead>
                                    <tbody>
                                        <?php 
                                            $all_orders = $order->getOrderById($_GET['customer_id']);
                                            //debugger($all_orders,true);
                                            if($all_orders){
                                                foreach($all_orders as $key=>$order_info){
                                            ?>
                                            <tr>
                                                <td><?php echo $key+1; ?></td>
                                                <td><?php echo $order_info->cart_id; ?></td>
                                                <td><?php echo $order_info->title; ?></td>

                                                <td style="max-width: 200px;">
                                                    <?php  
                                                        if(file_exists(UPLOAD_DIR.'product/'.$order_info->thumbnail) && !empty($order_info->thumbnail)){
                                                        ?>
                                                        <img src="<?php echo UPLOAD_URL.'product/'.$order_info->thumbnail;?>" alt="" class="img img-thumbnail img-responsive">
                                                        <?php
                                                        } else {
                                                            echo "No file has been uploaded.";
                                                        }
                                                    ?>
                                                </td>

                                                <td><?php echo $order_info->quantity; ?></td>
                                                <td><?php echo $order_info->full_name; ?></td>
                                                <td><?php echo ($order_info->delivery_type == 1)? 'Normal Shipping' :'Special Shipping' ?></td>
                                                <td><?php echo ($order_info->order_status == 1) ? 'Delivered' : 'New'; ?></td>
                                                
                                               
                                              
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
        <h4 class="modal-title" id="myModalLabel">Order Status</h4>
      </div>
        <form action="process/detailorder" method="post" enctype="multipart/form-data" class="form form-horizontal">
            
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Status</label>
                    <div class="col-sm-9">
                        <select name="order_status" id="order_status" class="form-control">
                            <option value="2" selected="" disabled="" default="">----Select Any One---</option>
                            <option value="0">NEW</option>
                            <option value="1">DELIVERED</option>
                           
                            
                        </select>
                    </div>
                </div>

               
            <div class="modal-footer">
              <input type="hidden" name="order_id" value="" id="order_id">
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

    <script type="text/javascript" >
   function showModal(){
   
      $('.modal').modal('show'); 
  }

   function editorder(elem){
      var data = $(elem).data('data');
      if(data){
        if(typeof(data) != 'object'){
          data = $.parseJSON(data);
        }
        showModal();
        $('#myModalLabel').html('ORDER STATUS');
        
        $('#status').val(data.status);
        

           
    }else{
      alert('sorry!!! Data could not be fetched at this time');

    }
  }



</script>

   <?php require 'inc/footer.php'; ?>



