<?php 
require_once 'inc/header.php'; 
require_once 'class/baseModel.php';
require_once 'class/product.php';

$product = new Product();

$keyword = null;
$cat_id = null;

$min_price = null;
$max_price = null;

$total_product = $product->getTotalCount();
$limit= 3;
  
  $total_pages = ceil($total_product[0]->total_product/$limit);

  $current_page = 1;
  $offset = 0;
  if(isset($_GET['page']) && $_GET['page'] != ""){
  	$page = (int)$_GET['page'];
  	if($page>= $total_pages){
  		$current_page = $total_pages;

  	}

  	$offset = ($current_page-1)*$limit;
  }

if(isset($_GET['keyword']) && !empty($_GET['keyword'])){
	$keyword = sanitize($_GET['keyword']);
}

if(isset($_GET['cat_id']) && !empty($_GET['cat_id'])){
	$cat_id = (int)$_GET['cat_id'];
}

if(isset($_GET['min_price']) && !empty($_GET['min_price'])){
	$min_price = (float)$_GET['min_price'];
}


if(isset($_GET['max_price']) && !empty($_GET['max_price'])){
	$max_price = (float)$_GET['max_price'];
}

$attr = array(
		'keyword' => $keyword,
		'cat_id' => $cat_id,
		'min_price' => $min_price,
		'max_price' => $max_price,
		'orderby' =>' products.id DESC ',
		'limit' => array($offset, $limit)
);

$product_items = $product->getSearchResult($attr);
//debugger($product_items,true);
if($keyword != "" || $cat_id != 0){

	$total_pages = ceil(count($product_items)/$limit);


	$current_page = 1;
	$offset = 0;

	if(isset($_GET['page']) && $_GET['page'] != ""){
		$page = (int)$_GET['page'];
		if($page>= $total_pages){
			$current_page = $total_pages;
		}

		$offset = ($current_page-1)*$limit;
	}
}


?>

	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="./">Home</a></li>
				<li class="active">Search Result</li>
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
				<?php
					if($product_items){
						?>

							<!-- section title -->
							<div class="col-md-12">
								<div class="section-title">
									<h2 class="title">Search Result</h2>
								</div>
							</div>
							<!-- section title -->
							
							<?php 
								$counter = 1;
								foreach($product_items as $key=> $products){
							?>

								<!-- Product Single -->
								<div class="col-md-3 col-sm-6 col-xs-6">
									<div class="product product-single">
										<div class="product-thumb">
											<div class="product-label">
												<?php 
													$today_date = strtotime(date('Y-m-d H:i:s'));
													$added_date = strtotime($products->added_date);

													if((($today_date-$added_date)/86400) <= 15){
												?>
												<span>New</span>
												
												<?php } ?>

												<?php 
													if($products->discount > 0){
												?>

												<span class="sale">-<?php echo $products->discount; ?>%</span>

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
											<img src="<?php echo $thumb_url; ?>" alt="<?php echo cleanUrl($products->title); ?>">
										
										</div>
										<div class="product-body">
											
											<h3 class="product-price">
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

											<h2 class="product-name">
												<a href="product?id=<?php echo $products->id;?>&amp;title=<?php echo cleanUrl($products->title); ?>"><?php echo $products->title; ?></a>
											</h2>
											<div class="product-btns">
												<button class="primary-btn add-to-cart" onclick="addtoCart(<?php echo $products->id;?>, 1);">
													<i class="fa fa-shopping-cart"></i> Add to Cart
												</button>
											</div>
										</div>
									</div>
								</div>
								<!-- /Product Single -->
								
							<?php
								if($counter%4 == 0){
									echo "<div class='clearfix'></div>";
								}
								$counter++;
							}
					}  else {
						echo "<p class='alert alert-danger'>No items found.</p>";
					}
				?>
			</div>
			<div class="row">
										<ul class="pagination">
						<nav aria-label="Page navigation example">
						  <ul class="pagination">
						    <li class="page-item"><a class="page-link" href="#">Previous</a></li>

					<?php 
						$request_url = $_SERVER['REQUEST_URI'];
						for($i=1; $i<=$total_pages; $i++){
							$url = trim($request_url, "/");
							parse_str($url, $data);

							if(isset($data['page'])){
								$data['page'] = $i;
							} else {
								$data['page'] = $i;
							}
							$temp = array();
							foreach($data as $key=>$str){
								$temp[] = $key.'='.$str;
							}
							$url = implode("&",$temp);
						?>


						    <li class="page-item"><a class="page-link" href="<?php echo $url; ?>"><?php echo $i; ?></a></li>
						<?php
						}
					?>
						     <li class="page-item"><a class="page-link" href="#">Next</a></li>
						  </ul>
						</nav>
					</ul>
				</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->
<?php require 'inc/footer.php'; ?>