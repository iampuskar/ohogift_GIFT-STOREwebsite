    <?php require 'inc/header.php';
    require 'config/header.php';

          require_once CLASS_PATH.'baseModel.php';
          require_once CLASS_PATH.'product.php';
          require CLASS_PATH.'review.php';
//debugger($_POST,true);
          $product = new Product();
          $product_list_limit = $product->getProductLimit();
          $product_items= $product->getProductById($_GET['id']);
          //debugger($product_items,true);

          $review= new Review();
          $review = $review->getReviewById($_GET['id']);
          //$total_review = $review->getTotalCount(); 
         //debugger($review,true);
          ?>
   
     <!-- BREADCRUMB -->
     <?php echo flash(); ?>
     <?php 

     if($product_items[0]->title != "" && isset($product_items[0]->title)){
      ?>
	
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li><a href="#">Products</a></li>
				<li><a href="#">Category</a></li>
				<li class="active"><?php echo $product_items[0]->title;  ?></li>
			</ul>
		</div>
	</div>

<?php } ?>
	<!-- /BREADCRUMB -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!--  Product Details -->
				<div class="product product-details clearfix">
					<div class="col-md-6">
						<div id="product-main-view">
							<div class="product-view">
								<?php 
									if($product_items[0]->thumbnail != NULL && file_exists(UPLOAD_DIR.'product/'.$product_items[0]->thumbnail)){
									    $thumb_url = UPLOAD_URL.'product/'.$product_items[0]->thumbnail;
									} else {
										$thumb_url = IMAGES_URL.'no-image.jpg';
												}
									?>
								<img src="<?php echo $thumb_url;?>" alt="">
							</div>
							
						</div>
						<div id="product-view">
							
							<!-- <div class="product-view">
								<img src="<?php echo IMAGES_URL;?>thumb-product01.jpg" alt="">
							</div>
							<div class="product-view">
								<img src="<?php echo IMAGES_URL;?>thumb-product02.jpg" alt="">
							</div>
							<div class="product-view">
								<img src="<?php echo IMAGES_URL;?>thumb-product03.jpg" alt="">
							</div>
							<div class="product-view">
								<img src="<?php echo IMAGES_URL;?>thumb-product04.jpg" alt="">
							</div> -->
						</div>
					</div>
					 

					<div class="col-md-6">
						<div class="product-body">
							<div class="product-label">
								<?php 
									    $today_date = strtotime(date('Y-m-d H:i:s'));
										$added_date = strtotime($product_items[0]->added_date);
										if((($today_date-$added_date)/86400) <= 50){
								?>
								        <span>New</span>
							            <?php } ?>

							<?php 
						          if($product_items[0]->discount > 0){
							?>
								<span class="sale">-<?php echo $product_items[0]->discount; ?>%</span>
							<?php } ?>
							</div>
							<h2 class="product-name"><?php echo $product_items[0]->title; ?></h2>
							<h3>
							                   <?php 
													$price = $product_items[0]->price;
													$discount = $product_items[0]->discount;
													$discounted_amount = $price;
													if($discount > 0){
														$discounted_amount = $price - (($price*$discount)/100);
													}
												?>
												NPR. <?php echo number_format($discounted_amount, 2) ?> 
												
												<?php 
													if($discount > 0){
														echo '<del class="product-old-price">'.number_format($price, 2).'</del>';
													}else{
														echo '<del class="product-price">'.number_format($discount,2).'</del>';
													}
												?>
												</h3>

												
												
							
							                        <div class="product-rating">
								                    <?php 
													if($product_items[0]->total_user == 0){
														$rate = rand(2,3);
													} else {
														$rate = ceil($product_items[0]->total_rate/$product_items[0]->total_user);
													}

													for($i =0; $i<5; $i++){
														$class = 'fa-star';
													
														if($i >= $rate){
															$class = "fa-star-o empty";
														}
												?>
												<i class="fa <?php echo $class; ?>"></i>

												<?php
													}
												?>
								<a href="#"><?php echo $product_items[0]->total_user; ?> Review(s) </a>
							</div>
							<p><strong>Availability:</strong> In Stock</p>
							<p><strong>Brand:</strong><?php echo $product_items[0]->brand; ?></p>
							<p><?php echo $product_items[0]->summary; ?></p>
							<div class="product-options">
							
							</div>
							<!-- product?id=<?php echo $product_items[0]->id;?> -->
                            <form action="product?id=<?php echo $product_items[0]->id;?>" method="post">
							<div class="product-btns">
								<!--<div class="qty-input">
									<span class="text-uppercase">QTY: </span>
									<input class="input" type="number" name="quantity" id="quantity">
									 <!-- <button type="submit" onclick="quantity();">Ok</button>  -->
								</div> 
								</form>

								<button type="button" class="primary-btn add-to-cart" onclick="addtoCart(<?php echo $product_items[0]->id;?>,<?php if(isset($_POST['quantity']) && !empty($_POST['quantity'])){
									echo $_POST['quantity'];
								}else{
								       echo 1;


								} ?>);">

											<i class="fa fa-shopping-cart"></i> Add to Cart</button>
								<div class="pull-right">
									<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
									<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
									<button class="main-btn icon-btn"><i class="fa fa-share-alt"></i></button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="product-tab">
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Product Description /वस्तुको वर्णन </a></li>
								 <!-- <li><a data-toggle="tab" href="#tab1">Details</a></li> --> 
								<li><a data-toggle="tab" href="#tab2">Reviews (<?php echo $product_items[0]->total_user; ?>)/ समीक्षा राख्नुहोस्</a></li>
							</ul>
							<div class="tab-content">
								<div id="tab1" class="tab-pane fade in active">
									<p><?php echo $product_items[0]->description; ?></p>

								</div>
								
								<div id="tab2" class="tab-pane fade in">
									

	
									<div class="row">

										<div class="col-md-6">

											<div class="product-reviews">
												
												<?php foreach ($review as $key => $review_items) {
													
												?>

												<div class="single-review">
													<div class="review-heading">
														<div><a href="#"><i class="fa fa-user-o"></i><?php echo $review_items->name ; ?></a></div>
														<div><a href="#"><i class="fa fa-clock-o"></i> <?php echo $review_items->added_date; ?></a></div>
														<div class="review-rating pull-right">
															 <?php 
													if($review_items->rate == 0){
														$rate = rand(2,3);
													} else {
														$rate = $review_items->rate;
													}

													for($i =0; $i<5; $i++){
														$class = 'fa-star';
													
														if($i >= $rate){
															$class = "fa-star-o empty";
														}
												?>
												<i class="fa <?php echo $class; ?>"></i>

												<?php
													}
												?>
											</div>
													</div>
													<div class="review-body">
														<p><?php echo $review_items->review; ?></p>
													</div>
												</div>

											<?php } ?>

												<ul class="reviews-pages">
													<li class="active">1</li>
													<li><a href="#">2</a></li>
													<li><a href="#">3</a></li>
													<li><a href="#"><i class="fa fa-caret-right"></i></a></li>
												</ul>
											</div>
										</div>
										<div class="col-md-6">
											<h4 class="text-uppercase">Write Your Review</h4>
											<p>Your email address will not be published.</p>
											<form class="review-form" action="review?id=<?php echo $_GET['id'];  ?>" method="post">
												<div class="form-group">
													<input class="input" type="text" placeholder="Your Name"  name="username" />
												</div>
												<div class="form-group">
													<input class="input" type="email" placeholder="Email Address" name="email" />
												</div>
												<div class="form-group">
													<textarea class="input" placeholder="Your review" name="review"></textarea>
												</div>
												<div class="form-group">
													<div class="input-rating">
														<strong class="text-uppercase">Your Rating: </strong>
														<div class="stars">
															<input type="radio" id="star5" name="rating" value="5" /><label for="star5"></label>
															<input type="radio" id="star4" name="rating" value="4" /><label for="star4"></label>
															<input type="radio" id="star3" name="rating" value="3" /><label for="star3"></label>
															<input type="radio" id="star2" name="rating" value="2" /><label for="star2"></label>
															<input type="radio" id="star1" name="rating" value="1" /><label for="star1"></label>
														</div>
													</div>
												</div>
												<button class="primary-btn" >Submit</button>
											</form>
										</div>
									</div>



								</div>
							</div>
						</div>
					</div>

				</div>
				<!-- /Product Details -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">Latest products / नयाँ सामानहरू</h2>
					</div>
				</div>
				<!-- section title -->

				

				<!-- Product Single -->
				<?php foreach ($product_list_limit as $key => $products) {
					
				 ?>
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="product product-single">
						<div class="product-thumb">
							<a class="main-btn quick-view" href="product?id=<?php echo $products->id;?>&amp;title=<?php echo cleanUrl($products->title); ?>">
												<i class="fa fa-search-plus"></i> Detail view
											</a>
							<?php 
									if($products->thumbnail != NULL && file_exists(UPLOAD_DIR.'product/'.$products->thumbnail)){
									    $thumb_url = UPLOAD_URL.'product/'.$products->thumbnail;
									} else {
										$thumb_url = IMAGES_URL.'no-image.jpg';
												}
									?>
								<img src="<?php echo $thumb_url;?>" alt="">
						</div>
						<div class="product-body">
							<h3 class="product-price">$32.50</h3>
							 <div class="product-rating">
								                    <?php 
													if($products->total_user == 0){
														$rate = rand(2,3);
													} else {
														$rate = ceil($products->total_rate/$products->total_user);
													}

													for($i =0; $i<5; $i++){
														$class = 'fa-star';
													
														if($i >= $rate){
															$class = "fa-star-o empty";
														}
												?>
												<i class="fa <?php echo $class; ?>"></i>

												<?php
													}
												?>
									</div>
							<h2 class="product-name"><a href="#"><?php echo $products->title; ?></a></h2>
							<div class="product-btns">
								<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
								<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
								<button class="primary-btn add-to-cart" onclick="addtoCart(<?php echo $products->id;?>, 1);">
											<i class="fa fa-shopping-cart"></i> Add to Cart</button>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
				<!-- /Product Single -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	<script type="text/javascript">
		function quantity(){ 
        var name=document.getElementById('quantity').value;
    }
	</script>
<?php require 'inc/footer.php'; ?>