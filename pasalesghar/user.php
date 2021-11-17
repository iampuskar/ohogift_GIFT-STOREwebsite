<?php 
$page_title="User Detail";
require 'inc/top-link.php';
//debugger($_SESSION, true);
if(!isset($_SESSION,$_SESSION['session_id']) || empty($_SESSION['session_id']) || empty($_SESSION['full_name'])){
  redirect('index','error','Please login first.');
} 
//debugger($_SESSION, true);

require_once CLASS_PATH.'/baseModel.php';
require_once CLASS_PATH.'/user.php';


$user = new User();


?>
    <div class="container body">
      <div class="main_container">
      <?php require 'inc/sidebar.php'; ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Customers Details</h3>
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
                                    <th>Cutomer Name</th>
                                    <th>Email</th>
                                  
                                    <th>Phone</th>

                                    <th>Gender</th>

                                    
                                    <th>Address</th>
                                  </thead>
                                    <tbody>
                                        <?php 
                                            $all_users = $user->getAllUser();
                                            //debugger($all_users,true);
                                            if($all_users){
                                                foreach($all_users as $key=>$user_info){
                                            ?>
                                            <tr>
                                                <td><?php echo $key+1; ?></td>
                                                <td><?php echo $user_info->full_name; ?></td>
                                                <td><?php echo $user_info->email_address; ?></td>
                                                <td><?php echo $user_info->phone_number; ?></td>
                                                <td><?php echo $user_info->gender; ?></td>
                                                <td><?php echo $user_info->shipping_address; ?></td>
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
        $('#myModalLabel').html('Banner Update');
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


