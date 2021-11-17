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
                <h3>Order Page</h3>
                <?php flash(); ?>
              </div>

              <div class="title_right">
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
                                    <th>Customer</th>
                                  
                                    <th>Order Status</th>

                                    <th>Delivery Type</th>
                                    
                                    <th>Action</th>
                                  </thead>
                                    <tbody>
                                        <?php 
                                            $all_orders = $order->getAllOrder();
                                            //debugger($all_orders,true);
                                            if($all_orders){
                                                foreach($all_orders as $key=>$order_info){
                                            ?>
                                            <tr>
                                                <td><?php echo $key+1; ?></td>
                                                <td><?php echo $order_info->cart_id; ?></td>
                                                <td><?php echo $order_info->customer_id; ?></td>
                                               
                                                <td><?php echo ($order_info->delivery_type == 1)? 'Normal Shipping' :'Special Shipping' ?></td>

                                                 <td><?php echo ($order_info->order_status == 1) ? 'Delivered' : 'New'; ?></td>
                                               
                                                <td>
                                                     <?php 

                                                  $url= "process/order?id=".$order_info->id."&act=".substr(md5('del-order-'.$_SESSION['session_id'].'-'.$order_info->id), 3, 15);
                                                  ?>
                                                   <a href="<?php echo $url; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Banner?')">
                                                   <i class="fa fa-trash"></i>
                                                </a>

                                                <a href="javascript:;"  data-data='<?php echo json_encode($order_info); ?>'  onclick="editBanner(this)" class="btn btn-success">
                                                  <i class="fa fa-pencil"></i>
                                                </a>

                                                    <a href="detailorder?cart_id=<?php echo $order_info->cart_id;?>&amp;id=<?php echo $order_info->id;?>&amp;customer_id=<?php echo $order_info->customer_id;?>" class="btn btn-success" style="border-radius: 50%">Detail
                                                        <i class="fa fa-apple"></i>
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
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Order Update</h4>
      </div>
        <form action="process/order" method="post" enctype="multipart/form-data" class="form form-horizontal">
            <div class="modal-body">
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Cart ID</label>
                    <div class="col-sm-9">
                        <input type="text" name="cart_id" required id="cart_id" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Customer ID</label>
                    <div class="col-sm-9">
                        <textarea name="customer_id" id="customer_id" style="resize: none;" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Delivery Type</label>
                    <div class="col-sm-9">
                        <select name="delivery_type" id="delivery_type" class="form-control">
                        <option value="1">Normal Shipping</option>
                            <option value="0">Express Shipping</option>
                          </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Order Status</label>
                    <div class="col-sm-9">
                        <select name="order_status" id="order_status" class="form-control">
                            <option value="1">Delivered</option>
                            <option value="0">New</option>
                        </select>
                    </div>
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

<?php $scripts = '<script type="text/javascript" src="'.ADMIN_VENDORS_URL.'datatable/datatables.min.js"></script>
<script type="text/javascript">$(".table").dataTable();</script>'; ?>

<?php require 'inc/footer.php'; ?>

 <script type="text/javascript">
    $('.table').dataTable(); 

     </script>

<script type="text/javascript" >
   function showModal(){
   
      $('.modal').modal('show'); 
  }

  function editBanner(elem){
      var data = $(elem).data('data');
      if(data){
        if(typeof(data) != 'object'){
          data = $.parseJSON(data);
        }
        showModal();
        $('#myModalLabel').html('Order Update');
        $('#cart_id').val(data.cart_id);
        $('#customer_id').val(data.customer_id);
        $('#delivery_type').val(data.delivery_type);
        $('#order_status').val(data.order_status);
        $('#order_id').val(data.id);

           
    }else{
      alert('sorry!!! Data could not be fetched at this time');

    }
  }

</script>


