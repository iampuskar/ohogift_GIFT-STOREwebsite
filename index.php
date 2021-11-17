<?php require 'inc/header.php';
require_once CLASS_PATH.'baseModel.php';
require_once CLASS_PATH.'banner.php';
require_once CLASS_PATH.'product.php';
require_once CLASS_PATH.'category.php';
require_once CLASS_PATH.'advertisement.php';



$banner = new Banner();
$product = new Product();
$category = new Category();
$advertisement = new Advertisement();

$category_list = $category->getAllCategory();
$banner_list = $banner->getHomeBanner();
$advertisement_list = $advertisement->getAllAdvertisement();
$product_list = $product->getAllProduct();
$product_list2 = $product->getAllProduct2();
$product_list3 = $product->getAllProduct3();
$product_list4 = $product->getAllProduct4();
$product_list5 = $product->getAllProduct5();
$product_list6 = $product->getAllProduct6();
$product_list7 = $product->getAllProduct7();
$product_list8 = $product->getAllProduct8();
$product_list9 = $product->getAllProduct9();
$product_list10 = $product->getAllProduct10();
$product_list11 = $product->getAllProduct11();
$product_list_limit = $product->getProductLimit();
$advertisement_list_limit = $advertisement->getAdvertisementlimit();

 ?>

	<!-- HOME -->
	<div id="home">
		
		<!-- container -->
		<div class="container">
			<!-- home wrap -->
			<div class="home-wrap">
				<!-- home slick -->
				<div id="home-slick">
					<?php 
					if($banner_list){
						foreach ($banner_list as $key=>$home_banner) {
							?>
							<!-- banner -->
					<div class="banner banner-1">
						<?php 
							//debugger($products);
							if($home_banner->image!= NULL && file_exists(UPLOAD_DIR.'banner/'.$home_banner->image)){

								$thumb_url = UPLOAD_URL.'banner/'.$home_banner->image;

							}
							else{

								$thumb_url= IMAGES_URL.'no-image.jpg';
							}

							  ?>
							
						<img src="<?php echo $thumb_url; ?>" alt="">
						<div class="banner-caption text-center">
							<!--<h1><?php echo ($key+1)." ".$home_banner->title;?></h1>
							<h3 class="white-color font-weak">Up to 50% Discount</h3>-->
							<!-- <button class="primary-btn slide down">Shop Now</button> -->
						</div>
					</div>
					<!-- /banner -->

					 <?php 	
					}
					}
					 ?>
					

				</div>
				<!-- /home slick -->
			</div>
			<!-- /home wrap -->
		</div>
		<!-- /container -->
	</div>
	<!-- /HOME -->
	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- banner -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">Advertisement</h2>
						<div class="pull-right">
							<div class="product-slick-dots-0 custom-dots"></div>
						</div>

					</div>

				</div>
				<?php foreach ($advertisement_list_limit as $key => $advertisements) {
					
				              ?>
				
				<div class="col-md-4 col-sm-6">					
					<a class="banner banner-1" href="#">
						<?php 
									if($advertisements->image != NULL && file_exists(UPLOAD_DIR.'advertisement/'.$advertisements->image)){
									    $thumb_url = UPLOAD_URL.'advertisement/'.$advertisements->image;
									} else {
										$thumb_url = IMAGES_URL.'no-image.jpg';
												}
									?>
						<img src="<?php echo $thumb_url; ?>" alt="">
						<div class="banner-caption text-center">
							<h2 class="white-color"><?php echo $advertisements->title; ?></h2>
							<button class="primary-btn slide down">Detail</button>
						</div>
					</a>
				</div>
				<?php } ?>
				<!-- /banner -->

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
			
			<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">Flowers / फूलहरू </h2>
						<div class="pull-right">
							<div class="product-slick-dots-1 custom-dots">
							</div>
						</div>
					</div>
				</div>
				<!-- section title -->

				<!-- Product Single -->
				<?php foreach ($product_list6 as $key => $products) {
								
							 ?>
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="product product-single product-hot">
						<div class="product-thumb">
							<div class="product-label">
								<?php 
													$today_date = strtotime(date('Y-m-d H:i:s'));
													$added_date = strtotime($products->added_date);

													if((($today_date-$added_date)/86400) <= 50){
												?>
												<span>New</span>
												
												<?php } ?>
								<span class="sale"><?php echo $products->discount; ?>%</span>
							</div>
							<ul class="product-countdown">
								<li><span>Featured Product</span></li>
								<!--<li><span>00 M</span></li>
								<li><span>00 S</span></li>-->
							</ul>
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
							<h3> <?php 
													$price = $products->price;
													$discount = $products->discount;
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
												?></h3>
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
				<!-- /Product Single -->
			<?php } ?>

				<!-- Product Slick -->
				<div class="col-md-9 col-sm-6 col-xs-6">
					<div class="row">
						<div id="product-slick-1" class="product-slick">
							


							<!-- Product Single -->
							<?php foreach ($product_list as $key => $products) {
								
							 ?>
							<div class="product product-single">
								

											
								<div class="product-thumb">
									<div class="product-label">
									<?php 
													$today_date = strtotime(date('Y-m-d H:i:s'));
													$added_date = strtotime($products->added_date);

													if((($today_date-$added_date)/86400) <= 50){
												?>
												<span>New</span>
												
												<?php } ?>
											</div>
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
									<h3>
									<?php 
													$price = $products->price;
													$discount = $products->discount;
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
						<?php } ?>
							<!-- /Product Single -->


						</div>
					</div>
				</div>
				<!-- /Product Slick -->
			</div>
			<!-- /row -->

			<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">Personal Printed Gifts / व्यक्तिगत प्रिन्ट उपहार</h2>
						<div class="pull-right">
							<div class="product-slick-dots-2 custom-dots">
							</div>
						</div>
					</div>
				</div>
				<!-- section title -->

				<!-- Product Single -->
				<?php foreach ($product_list7 as $key => $products) {
								
							 ?>
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="product product-single product-hot">
						<div class="product-thumb">
							<div class="product-label">
								<?php 
													$today_date = strtotime(date('Y-m-d H:i:s'));
													$added_date = strtotime($products->added_date);

													if((($today_date-$added_date)/86400) <= 50){
												?>
												<span>New</span>
												
												<?php } ?>
								<span class="sale"><?php echo $products->discount; ?>%</span>
							</div>
							<ul class="product-countdown">
								<li><span>Get an Exclusive Discount</span></li>
								<!--<li><span>00 M</span></li>
								<li><span>00 S</span></li>-->
							</ul>
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
							<h3> <?php 
													$price = $products->price;
													$discount = $products->discount;
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
												?></h3>
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
				<!-- /Product Single -->
			<?php } ?>

				<!-- Product Slick -->
				<div class="col-md-9 col-sm-6 col-xs-6">
					<div class="row">
						<div id="product-slick-2" class="product-slick">
							


							<!-- Product Single -->
							<?php foreach ($product_list2 as $key => $products) {
								
							 ?>
							<div class="product product-single">
								

											
								<div class="product-thumb">
									<div class="product-label">
									<?php 
													$today_date = strtotime(date('Y-m-d H:i:s'));
													$added_date = strtotime($products->added_date);

													if((($today_date-$added_date)/86400) <= 50){
												?>
												<span>New</span>
												
												<?php } ?>
											</div>
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
									<h3>
									<?php 
													$price = $products->price;
													$discount = $products->discount;
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
						<?php } ?>
							<!-- /Product Single -->


						</div>
					</div>
				</div>
				<!-- /Product Slick -->
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
				<!-- section-title -->

				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">Cakes / स्वादिष्ट केक </h2>
						<div class="pull-right">
							<div class="product-slick-dots-3 custom-dots"></div>
						</div>

					</div>

				</div>
				<!-- /section-title -->

				<!-- banner -->
				<?php foreach ($product_list8 as $key => $products) {
					
				              ?>
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="banner banner-2">
						<?php 
									if($products->thumbnail != NULL && file_exists(UPLOAD_DIR.'product/'.$products->thumbnail)){
									    $thumb_url = UPLOAD_URL.'product/'.$products->thumbnail;
									} else {
										$thumb_url = IMAGES_URL.'no-image.jpg';
												}
									?>
						<img src="<?php echo $thumb_url; ?>" alt="">
						<div class="banner-caption">

							<h2 class="white-color"><br><?php echo $products->title; ?></h2>
							<a class="main-btn quick-view" href="product?id=<?php echo $products->id;?>&amp;title=<?php echo cleanUrl($products->title); ?>">
												<i class="fa fa-search-plus"></i> Detail view
											</a>
							
						</div>
					</div>
				</div>
				<!-- /banner -->
			<?php } ?>

				<!-- Product Slick -->

				<div class="col-md-9 col-sm-6 col-xs-6">
					<div class="row">
						<div id="product-slick-3" class="product-slick">
							<!-- Product Single -->
							<?php foreach ($product_list3 as $key => $products) {
					
				              ?>
							<div class="product product-single">
								<div class="product-thumb">
									<div class="product-label">
										<?php 
													$today_date = strtotime(date('Y-m-d H:i:s'));
													$added_date = strtotime($products->added_date);

													if((($today_date-$added_date)/86400) <= 50){
												?>
												<span>New</span>
												
												<?php } ?>

											<?php 
													if($products->discount > 0){
												?>

												<span class="sale">-<?php echo $products->discount; ?>%</span>

											<?php } ?>
									</div>
									<ul class="product-countdown">
										<li><span>00 H</span></li>
										<li><span>00 M</span></li>
										<li><span>00 S</span></li>
									</ul>
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
									<img src="<?php echo $thumb_url; ?>" alt="">
								</div>
								<div class="product-body">
									<h3>
									<?php 
													$price = $products->price;
													$discount = $products->discount;
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
									<h2 class="product-name"><?php echo $products->title; ?></h2>
									<div class="product-btns">
										<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
										<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
										<button class="primary-btn add-to-cart" onclick="addtoCart(<?php echo $products->id;?>, 1);">
											<i class="fa fa-shopping-cart"></i> Add to Cart</button>
									</div>
								</div>
							</div>
						<?php } ?>
							<!-- /Product Single -->

							
						</div>
					</div>
				</div>
				<!-- /Product Slick -->
			</div>
			<!-- /row -->

			<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			
			<div class="row">
				<!-- section-title -->

				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">Gifts for her / उनको लागि उपहार</h2>
						<div class="pull-right">
							<div class="product-slick-dots-4 custom-dots"></div>
						</div>

					</div>

				</div>
				<!-- /section-title -->

				<!-- banner -->
				<?php foreach ($product_list9 as $key => $products) {
					
				              ?>
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="banner banner-2">
						<?php 
									if($products->thumbnail != NULL && file_exists(UPLOAD_DIR.'product/'.$products->thumbnail)){
									    $thumb_url = UPLOAD_URL.'product/'.$products->thumbnail;
									} else {
										$thumb_url = IMAGES_URL.'no-image.jpg';
												}
									?>
						<img src="<?php echo $thumb_url; ?>" alt="">
						<div class="banner-caption">

							<h2 class="white-color"><br><?php echo $products->title; ?></h2>
							<a class="main-btn quick-view" href="product?id=<?php echo $products->id;?>&amp;title=<?php echo cleanUrl($products->title); ?>">
												<i class="fa fa-search-plus"></i> Detail view
											</a>
							
						</div>
					</div>
				</div>
				<!-- /banner -->
			<?php } ?>

				<!-- Product Slick -->

				<div class="col-md-9 col-sm-6 col-xs-6">
					<div class="row">
						<div id="product-slick-4" class="product-slick">
							<!-- Product Single -->
							<?php foreach ($product_list4 as $key => $products) {
					
				              ?>
							<div class="product product-single">
								<div class="product-thumb">
									<div class="product-label">
										<?php 
													$today_date = strtotime(date('Y-m-d H:i:s'));
													$added_date = strtotime($products->added_date);

													if((($today_date-$added_date)/86400) <= 50){
												?>
												<span>New</span>
												
												<?php } ?>

											<?php 
													if($products->discount > 0){
												?>

												<span class="sale">-<?php echo $products->discount; ?>%</span>

											<?php } ?>
									</div>
									<ul class="product-countdown">
										<li><span>00 H</span></li>
										<li><span>00 M</span></li>
										<li><span>00 S</span></li>
									</ul>
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
									<img src="<?php echo $thumb_url; ?>" alt="">
								</div>
								<div class="product-body">
									<h3>
									<?php 
													$price = $products->price;
													$discount = $products->discount;
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
									<h2 class="product-name"><?php echo $products->title; ?></h2>
									<div class="product-btns">
										<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
										<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
										<button class="primary-btn add-to-cart" onclick="addtoCart(<?php echo $products->id;?>, 1);">
											<i class="fa fa-shopping-cart"></i> Add to Cart</button>
									</div>
								</div>
							</div>
						<?php } ?>
							<!-- /Product Single -->

							
						</div>
					</div>
				</div>
				<!-- /Product Slick -->
			</div>
			<!-- /row -->

			<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			
			<div class="row">
				<!-- section-title -->

				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">Gifts for Him / उसको लागि उपहार</h2>
						<div class="pull-right">
							<div class="product-slick-dots-5 custom-dots"></div>
						</div>

					</div>

				</div>
				<!-- /section-title -->

				<!-- banner -->
				<?php foreach ($product_list10 as $key => $products) {
					
				              ?>
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="banner banner-2">
						<?php 
									if($products->thumbnail != NULL && file_exists(UPLOAD_DIR.'product/'.$products->thumbnail)){
									    $thumb_url = UPLOAD_URL.'product/'.$products->thumbnail;
									} else {
										$thumb_url = IMAGES_URL.'no-image.jpg';
												}
									?>
						<img src="<?php echo $thumb_url; ?>" alt="">
						<div class="banner-caption">

							<h2 class="white-color"><br><?php echo $products->title; ?></h2>
							<a class="main-btn quick-view" href="product?id=<?php echo $products->id;?>&amp;title=<?php echo cleanUrl($products->title); ?>">
												<i class="fa fa-search-plus"></i> Detail view
											</a>
							
						</div>
					</div>
				</div>
				<!-- /banner -->
			<?php } ?>
				<!-- Product Slick -->

				<div class="col-md-9 col-sm-6 col-xs-6">
					<div class="row">
						<div id="product-slick-5" class="product-slick">
							<!-- Product Single -->
							<?php foreach ($product_list5 as $key => $products) {
					
				              ?>
							<div class="product product-single">
								<div class="product-thumb">
									<div class="product-label">
										<?php 
													$today_date = strtotime(date('Y-m-d H:i:s'));
													$added_date = strtotime($products->added_date);

													if((($today_date-$added_date)/86400) <= 50){
												?>
												<span>New</span>
												
												<?php } ?>

											<?php 
													if($products->discount > 0){
												?>

												<span class="sale">-<?php echo $products->discount; ?>%</span>

											<?php } ?>
									</div>
									<ul class="product-countdown">
										<li><span>00 H</span></li>
										<li><span>00 M</span></li>
										<li><span>00 S</span></li>
									</ul>
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
									<img src="<?php echo $thumb_url; ?>" alt="">
								</div>
								<div class="product-body">
									<h3>
									<?php 
													$price = $products->price;
													$discount = $products->discount;
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
									<h2 class="product-name"><?php echo $products->title; ?></h2>
									<div class="product-btns">
										<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
										<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
										<button class="primary-btn add-to-cart" onclick="addtoCart(<?php echo $products->id;?>, 1);">
											<i class="fa fa-shopping-cart"></i> Add to Cart</button>
									</div>
								</div>
							</div>
						<?php } ?>
							<!-- /Product Single -->

							
						</div>
					</div>
				</div>
				<!-- /Product Slick -->
			</div>
			<!-- /row -->
	<!-- section -->
	<div class="section section-grey">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- banner -->
				<div class="col-md-8">
					<div class="banner banner-1">
						<img src="http://pasale.com/assets/img/banner13.jpg" alt="">
						<div class="banner-caption text-center">
							<h1 class="primary-color">HOT DEAL<br><span class="white-color font-weak">Up to 50% OFF</span></h1>
							<button class="primary-btn">Shop Now</button>
						</div>
					</div>
				</div>
				<!-- /banner -->

				<!-- banner -->
				<div class="col-md-4 col-sm-6">
					<a class="banner banner-1" href="#">
						<img src="http://pasale.com/assets/img/banner11.jpg" alt="">
						<div class="banner-caption text-center">
							<h2 class="white-color">NEW COLLECTION</h2>
						</div>
					</a>
				</div>
				<!-- /banner -->

				<!-- banner -->
				<div class="col-md-4 col-sm-6">
					<a class="banner banner-1" href="#">
						<img src="http://pasale.com/assets/img/banner12.jpg" alt="">
						<div class="banner-caption text-center">
							<h2 class="white-color">NEW COLLECTION</h2>
						</div>
					</a>
				</div>
				<!-- /banner -->
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
						<h2 class="title">Teddy Bear / पुतली र टेडी भालु</h2>
					</div>
				</div>
				<!-- section title -->

				<!-- Product Single -->
				<?php foreach ($product_list11 as $key => $products) {
					
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

	<?php require 'inc/footer.php'; ?>