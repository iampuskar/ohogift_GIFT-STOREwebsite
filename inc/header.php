<?php require 'config/header.php'; ?>
<?php 
	require_once CLASS_PATH.'baseModel.php';
	require_once CLASS_PATH.'category.php';
	$category = new Category();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title><?php echo SITE_TITLE." || ".((isset($_title) && !empty($_title)) ? $_title : 'Home Page'); ?></title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="<?php echo CSS_URL;?>bootstrap.min.css" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="<?php echo CSS_URL;?>slick.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo CSS_URL;?>slick-theme.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="<?php echo CSS_URL;?>nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="<?php echo CSS_URL;?>font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="<?php echo CSS_URL;?>style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
	<!-- HEADER -->
	<header>
		<!-- top Header -->
		<div id="top-header">
			<div class="container">
				<div class="pull-left">
					<!--<span>Welcome to <?php echo SITE_TITLE; ?>!</span>-->
				</div>
				<div class="pull-right">
					<ul class="header-top-links">
					<!-- <li>
							<?php echo date('jS M, Y h:i A'); ?>
						</li> -->
					</ul>
				</div>
			</div>
		</div>
		<!-- /top Header -->

		<!-- header -->
		<div id="header">
			<div class="container">
				<div class="pull-left">
					<!-- Logo -->
					<div class="header-logo">
						<a class="logo" href="./">
							<img src="<?php echo IMAGES_URL;?>logo.png" alt="">
						</a>
					</div>
					<!-- /Logo -->

					<!-- Search -->
					<div class="header-search">
						<form action="search">
							<input class="input search-input" type="text" placeholder="Enter your keyword" name="keyword">
							<select class="input search-categories" name="cat_id">
								<option value="0">All Categories</option>
								<?php $all_parent_cat = $category->getAllParentCategory(1); 
									if($all_parent_cat){
										foreach($all_parent_cat as $parent_cat_info){
										?>
										<option value="<?php echo $parent_cat_info->id;?>"><?php echo $parent_cat_info->name; ?></option>
										<?php
										}
									}
								 ?>
							</select>
							<button class="search-btn"><i class="fa fa-search"></i></button>
						</form>
					</div>
					<!-- /Search -->
				</div>
				<div class="pull-right">
					<ul class="header-btns">

                        <!-- Account -->
						<li class="header-account dropdown default-dropdown">
							<div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
								<div class="header-btns-icon">
									<i class="fa fa-home"></i>
								</div>
								<strong href="index" class="text-uppercase">HOMEPAGE<i class="fa fa-caret"></i></strong>
							</div>
							<a href="index" class="text-uppercase hidden-xs">Click Here</a> 
							
						</li>
						<!-- /Account -->

						<!-- Account -->
						<li class="header-account dropdown default-dropdown">
							<div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
								<div class="header-btns-icon">
									<i class="fa fa-user-o"></i>
								</div>
								<strong class="text-uppercase">My Account <i class="fa fa-caret-down"></i></strong>
							</div>
							<a href="pasalesghar" class="text-uppercase">Admin</a> | <a href="logout" class="text-uppercase">Reset</a>
							<ul class="custom-menu">
								<li><a href="login"><i class="fa fa-user-o"></i> My Account</a></li>
								<!-- <li><a href="#"><i class="fa fa-heart-o"></i> My Wishlist</a></li> -->
								<!-- <li><a href="#"><i class="fa fa-exchange"></i> Compare</a></li> -->
								<li><a href="checkout"><i class="fa fa-check"></i> Checkout</a></li>
								<li><a href="login"><i class="fa fa-unlock-alt"></i> Login</a></li>
								<li><a href="login"><i class="fa fa-user-plus"></i> Create An Account</a></li>
							</ul>
						</li>
						<!-- /Account -->

						

						<!-- Cart -->
						<li class="header-cart dropdown default-dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">

								<?php 
								//debugger($_SESSION);
									$total_amount = 0;
									$total_quantity = 0;
									if(isset($_SESSION['_cart']) && !empty($_SESSION['_cart'])){
										foreach($_SESSION['_cart'] as $key=>$cart_item_info){
											$total_amount += $cart_item_info['total_amount'];
											$total_quantity += $cart_item_info['total_quantity'];
										}
									}
								?>
								<div class="header-btns-icon">
									<i class="fa fa-shopping-cart"></i>
									<span class="qty"><?php echo $total_quantity; ?></span>
								</div>
								<strong class="text-uppercase">My Cart:</strong><br>
								<span>NPR. <?php echo number_format($total_amount, 2); ?></span>
							</a>
							<div class="custom-menu">
								<div id="shopping-cart">
									<div class="shopping-cart-list">
									<?php 
									if(isset($_SESSION['_cart']) && !empty($_SESSION['_cart'])){
										foreach($_SESSION['_cart'] as $key=>$cart_item_info){
											//debugger($cart_item_info);
									 ?>	
										<div class="product product-widget">
											<div class="product-thumb">
												<?php 
													if($cart_item_info['image'] != "" && file_exists(UPLOAD_DIR.'product/'.$cart_item_info['image'])){
														$thumb = UPLOAD_URL.'product/'.$cart_item_info['image'];
													} else {
														$thumb = IMAGES_URL.'no-image.jpg';
													}
												?>
												<img src="<?php echo $thumb;?>" >
											</div>
											<div class="product-body">
												<h3 class="product-price">
													NPR. <?php echo number_format($cart_item_info['unit_price'], 2); ?> <span class="qty">x <?php echo $cart_item_info['total_quantity']; ?></span>
												</h3>
												<h2 class="product-name"><a href="product?id=<?php echo $cart_item_info['id']; ?>&amp;title=<?php echo cleanUrl($cart_item_info['title']) ?>"><?php echo $cart_item_info['title']; ?></a></h2>
											</div>
											<button class="cancel-btn" onclick="deleteCartItem(<?php echo $key;?>)">
												<i class="fa fa-trash"></i></button>
										</div>
									<?php 
										}
									} else {
										echo "<p>No items in the cart.</p>";
									} ?>
									</div>
									<?php 
									if(isset($_SESSION['_cart']) && !empty($_SESSION['_cart'])){
									?><div class="shopping-cart-btns">
										<a class="main-btn" href="cart">View Cart</a>
										<a class="primary-btn" href="checkout">Checkout <i class="fa fa-arrow-circle-right"></i></a>
									</div>
								<?php } ?>
								</div>
							</div>
						</li>
						<!-- /Cart -->

						<!-- Mobile nav toggle-->
						<li class="nav-toggle">
							<button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
						</li>
						<!-- / Mobile nav toggle -->
					</ul>
				</div>
			</div>		
			<!-- header -->
		</div>
		<!-- container -->
	</header>
	<!-- /HEADER -->

	<!-- NAVIGATION -->
	<div id="navigation">
		<!-- container -->
		<div class="container">
			<div id="responsive-nav">

				<!-- category nav -->
				<div class="category-nav <?php echo (getCurrentPage() == 'index') ? '' : 'show-on-click' ?>">
					<span class="category-header">Categories<i class="fa fa-list"></i></span>
					<ul class="category-list">
                    
						<?php 

						if(isset($all_parent_cat) && !empty($all_parent_cat)){
							foreach ($all_parent_cat as $parent_category) {
								$child_cats =$category->getAllSubCatsForApi($parent_category->id);

								if(count($child_cats)<= 0){
									?>
									<li><a href="search?cat_id=<?php echo $parent_category->id;?>"><?php echo $parent_category->name; ?></a></li>
									<?php
								} else{


								?>
								<li class="dropdown side-dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><?php echo $parent_category->name;  ?> <i class="fa fa-angle-right"></i></a>
							<div class="custom-menu">
								<div class="row">
									
									
									<div class="col-md-4">
										<ul class="list-links">
											
											<?php foreach ($child_cats as  $child_cats) {
												# code...
											?>
											<li><a href="category?sub_cats=<?php echo $child_cats->id; ?>"><?php echo $child_cats->name; ?></a></li>
										<?php } ?>
										</ul>
									</div>
								</div>
								<div class="row hidden-sm hidden-xs">
									<div class="col-md-12">
										<hr>
										<?php if($parent_category->image != ""  && file_exists(UPLOAD_DIR.'category/'.$parent_category->image)){
											?>
										<a class="banner banner-1" href="search?cat_id=<?php echo $parent_category->id; ?>">
											<img src="<?php echo UPLOAD_URL.'category/'.$parent_category->image;?>" alt="" class="img img-responsive">
											<div class="banner-caption text-center">
												<h2 class="white-color">NEW COLLECTION</h2>
												<h3 class="white-color font-weak">HOT DEAL</h3>
											</div>
										</a>
									<?php } ?>
									</div>
								</div>
							</div>

						</li>
								<?php
							    }
							}
						}



						 ?>
										</ul>
									</div>
								</div>
							</div>
						</li>
						
					</ul>
				</div>
				<!-- /category nav -->

				
			</div>
		</div>
		<!-- /container -->
	</div>
	<!-- /NAVIGATION -->