<?php require 'inc/header.php'; 
require_once CLASS_PATH.'baseModel.php';
require_once CLASS_PATH.'order.php';


$order = new Order();
$order_list = $order->getAllOrder();
//debugger($order_list,true);
?>

	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="index">Home</a></li>
				<li class="active">Blank</li>
			</ul>
		</div>
	</div>
	<!-- /BREADCRUMB -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<?php echo flash();
                
				?>
				<span><h3>THANKYOU FOR YOUR SHOPPING.</h3></span><br>
           <h5>OUR DELIVERY TEAM WILL CONTACT YOU SOON.</h5>

			<!-- </div>
			<br><br>
			<h4 class="text-center">Your Cart Items:</h4>
				<hr>
				<table class="table table-hover table-bordered">
					<thead>
						<th>S.N</th>
						<th>Cart ID</th>
						<th>Products</th>
						
						
						<th>Quantity</th>
						<th>Amount</th>
					</thead>
					<tbody>
						<?php 
							$total_sum	= 0;
							if(isset($order_list) && !empty($order_list)){
								foreach($order_list as $key => $orders){
								?>
								<tr>
									<td><?php echo ($key+1) ?></td>
									<td><?php echo $orders->cart_id; ?></td>
									<td><?php echo $orders->product_id; ?></td>
									
									
									<td><?php echo $orders->quantity; ?></td>
									<td><?php echo "NPR. ".number_format($orders->total_amount); ?></td>
								</tr>
								<?php
									$total_sum = $total_sum + $orders->total_amount;
								}
							}
						?>
					</tbody>
					<tfoot>
						<tr>
							<th colspan="6" style="text-align: right">Sub Total: </th>
							<th><?php echo "NPR. ".number_format($total_sum, 2); ?></th>
						</tr>
						<tr>
							<th colspan="6" style="text-align: right">VAT(13%)</th>
							<th>
								<?php echo "NPR. ".number_format($total_sum*0.13, 2) ?>
							</th>
						</tr>
						<tr>
							<th colspan="6" style="text-align: right">Total: </th>
							<th>
								<?php echo "NPR.".number_format(($total_sum+($total_sum*0.13)), 2); ?>
							</th>
						</tr>
					</tfoot>
				</table>
				<small><i>* Delivery charge vary for differnet places. Please read our terms and condition for the delivery charge.</i></small>
				<br>
				<a href="index" class="btn btn-success" onclick="resetcart()">
					<i class="fa fa-send"></i>
					Go back to shopping
				</a> -->
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

<?php require 'inc/footer.php'; ?>
