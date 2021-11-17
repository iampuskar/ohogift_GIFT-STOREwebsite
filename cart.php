<?php require 'inc/header.php'; ?>

	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="./">Home</a></li>
				<li class="active">Cart</li>
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
				<h4 class="text-center">Your Cart Items:</h4>
				<hr>
				<table class="table table-hover table-bordered">
					<thead>
						<th>S.N</th>
						<th>Product title</th>
						<th>Image</th>
						<th>Summary</th>
						<th>Unit Price</th>
						<th>Quantity</th>
						<th>Amount</th>
					</thead>
					<tbody>
						<?php 
							$total_sum	= 0;
							if(isset($_SESSION['_cart']) && !empty($_SESSION['_cart'])){
								foreach($_SESSION['_cart'] as $key => $cart_items){
								?>
								<tr>
									<td><?php echo ($key+1) ?></td>
									<td><?php echo $cart_items['title'] ?></td>
									<td>
										<?php 
											$thumbnail = IMAGES_URL.'no-image.jpg';
											if(isset($cart_items['image']) && !empty($cart_items['image']) && file_exists(UPLOAD_DIR.'product/'.$cart_items['image'])){
												$thumbnail = UPLOAD_URL.'product/'.$cart_items['image'];
											}
										?>
										<img src="<?php echo $thumbnail;?>" alt="" class="img img-responsive img-thumbnail" style="max-width: 100px;">
									</td>
									<td><?php echo $cart_items['summary'] ?></td>
									<td><?php echo "NPR. ".number_format($cart_items['unit_price']) ?></td>
									<td><?php echo $cart_items['total_quantity']; ?></td>
									<td><?php echo "NPR. ".number_format($cart_items['total_amount']); ?></td>
								</tr>
								<?php
									$total_sum = $total_sum + $cart_items['total_amount'];
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
				<a href="checkout" class="btn btn-success">
					<i class="fa fa-send"></i>
					Proceed to pay
				</a>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->
<?php require 'inc/footer.php'; ?>