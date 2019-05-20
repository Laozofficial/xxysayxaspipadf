<?php

session_start();
require 'sqlconnect.php';
require 'nav.inc.php';


if(isset($_GET['p_id'])){
	$p_id = $_GET['p_id'];
	
}

//echo $p_id;
$sql_pid = mysqli_query($connection , "SELECT * FROM PRODUCTS WHERE product_id = '$p_id'");

if(mysqli_num_rows($sql_pid)){

    $results = mysqli_fetch_assoc($sql_pid);
	$id = $results['id'];
	$product_name = $results['product_name'];
	$product_id = $results['product_id'];
	$product_image = $results['product_image'];
	$product_price = $results['price'];
	$product_rating = $results['rating'];
	$product_quantity = $results['quantity'];
	$product_color = $results['color'];
	$store_id = $results['store_id'];
	$store_name = $results['store_name'];
	$product_info = $results['product_info'];
	$product_desc = $results['product_desc'];
	
}

$sql_store = mysqli_query($connection , "SELECT * FROM stores WHERE store_id = '$store_id'");

if(mysqli_num_rows($sql_store)){

    $store_results = mysqli_fetch_assoc($sql_store);
	$store_logo = $store_results['store_logo'];
	$store_desc = $store_results['store_description'];
	$store_owner = $store_results['store_owner'];
}
?>



<!--/single_page-->
       <!-- /banner_bottom_agile_info -->
<div class="page-head_agile_info_w3l">
		<div class="container">
			<h3><?php echo $store_name.' '   ?><span> Products</span></h3>
			<!--/w3_short-->
				 <div class="services-breadcrumb">
						<div class="agile_inner_breadcrumb">

						   <ul class="w3_short">
								<li><a href="index.html">Home</a><i>|</i></li>
								<li><?php echo $store_name ?></li>
							</ul>
						 </div>
				</div>
	   <!--//w3_short-->
	</div>
</div>

  <!-- banner-bootom-w3-agileits -->
<div class="banner-bootom-w3-agileits">
	<div class="container">
	     <div class="col-md-4 single-right-left ">
			<div class="grid assets/images_3_of_2">
				<div class="flexslider">
					
					<ul class="slides">
						<li data-thumb="<?php echo 'dashboard/'.$product_image ?>">
							<div class="thumb-image"> <img src="<?php echo 'dashboard/'.$product_image ?>" data-imagezoom="true" class="img-responsive"> </div>
						</li>
					
					</ul>
					<div class="clearfix"></div>
				</div>	
			</div>
		</div>
		<div class="col-md-8 single-right-left simpleCart_shelfItem">
					<h3><?php echo $product_name ?></h3>
					<p><span class="item_price"><?php echo $naira.' ' .number_format($product_price,2)  ?></span></p>
					<?php
						$is_rating = '';
						
						$rating = mysqli_query($connection, "SELECT rating FROM products WHERE product_id = '$p_id'");
						
						if(mysqli_num_rows($rating)){

						$rating_results = mysqli_fetch_assoc($rating);
						$ratings = $rating_results['rating'];
						
							if($ratings == 0){
								$is_rating .= '0';
							}elseif($ratings == 1){
								$is_ratings .= '1';
							}elseif($rating == 2){
								$is_ratings .= '2';
							}elseif($rating == 3){
								$is_ratings .= '3';
							}elseif($rating == 4){
								$is_rating .= '4';
							}elseif($rating == 5){
								$is_rating .= '6';
							}
						}
					?>
					<div class="rating1">
						<span class="starRating">
							<input id="rating5" type="radio" name="rating-5" value="<?php echo $is_rating. ' ' .'checked=""'  ?>" >
							<label for="rating5">5</label>
							<input id="rating4" type="radio" name="rating-4" value="<?php echo $is_rating. ' ' .'checked=""'  ?>">
							<label for="rating4">4</label>
							<input id="rating3" type="radio" name="rating-3" value="<?php echo $is_rating. ' ' .'checked=""'  ?>" >
							<label for="rating3">3</label>
							<input id="rating2" type="radio" name="rating-2" value="<?php echo $is_rating. ' ' .'checked=""'  ?>">
							<label for="rating2">2</label>
							<input id="rating1" type="radio" name="rating-1" value="<?php echo $is_rating. ' ' .'checked=""'  ?>" >
							<label for="rating1">1</label>
						</span>
					</div>
					<!--<div class="description">-->
					<!--	<h5>Check delivery, payment options and charges at your location</h5>-->
					<!--	 <form action="#" method="post">-->
					<!--	<input type="text" value="Enter pincode" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter pincode';}" required="">-->
					<!--	<input type="submit" value="Check">-->
					<!--	</form>-->
					<!--</div>-->
					<!--<div class="color-quality">-->
					<!--	<div class="color-quality-right">-->
					<!--		<h5>Quality :</h5>-->
					<!--		<select name="" class="frm-field required sect">-->
					<!--			<option value="1">1 Qty</option>-->
					<!--			<option value="2">2 Qty</option>-->
					<!--			<option value="3">3 Qty</option>-->
					<!--			<option value="4">4 Qty</option>-->
					<!--			<option value="5">5 Qty</option>-->
					<!--			<option value="6">6 Qty</option> -->
					<!--			<option value="7">7 Qty</option>-->
					<!--			<option value="8">8 Qty</option>-->
					<!--			<option value="9">9 Qty</option>					-->
					<!--			<option value="10">10 Qty</option>								-->
					<!--		</select>-->
					<!--	</div>-->
					<!--</div>-->
					<div class="occasional">
						<!--<h5>Store Details :</h5>-->
						<div class="colr ert">
							<h5><span class="text-danger">Store Name:</span> <?php echo $store_name ?></h5>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="occasion-cart">
						<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2">
															<form action="cart.php?action=add&id=<?php echo $product_id ?>" method="post">
																<fieldset>
																	<input type="hidden" name="cmd" value="_cart" />
																	<input type="hidden" name="quantity" value="1" />
																	<input type="hidden" name="business" value=" " />
																	<input type="hidden" name="name" value="<?php echo $product_name ?>" />
																	<input type="hidden" name="price" value="<?php echo $product_price  ?>" />
																	<input type="hidden" name="currency_code" value="Naira" />
																	<input type="hidden" name="return" value=" " />
																	<input type="hidden" name="cancel_return" value=" " />
																	<input type="submit" name="submit" value="Add to cart" class="button" />
																</fieldset>
															</form>
																			
					</div>
					</div>
					<ul class="social-nav model-3d-0 footer-social w3_agile_social single_page_w3ls">
						                                   <li class="share">Share On : </li>
															<li><a href="#" class="facebook">
																  <div class="front"><i class="fa fa-facebook" aria-hidden="true"></i></div>
																  <div class="back"><i class="fa fa-facebook" aria-hidden="true"></i></div></a></li>
															<li><a href="#" class="twitter"> 
																  <div class="front"><i class="fa fa-twitter" aria-hidden="true"></i></div>
																  <div class="back"><i class="fa fa-twitter" aria-hidden="true"></i></div></a></li>
															<li><a href="#" class="instagram">
																  <div class="front"><i class="fa fa-instagram" aria-hidden="true"></i></div>
																  <div class="back"><i class="fa fa-instagram" aria-hidden="true"></i></div></a></li>
															<li><a href="#" class="pinterest">
																  <div class="front"><i class="fa fa-linkedin" aria-hidden="true"></i></div>
																  <div class="back"><i class="fa fa-linkedin" aria-hidden="true"></i></div></a></li>
														</ul>
					
		      </div>
	 			<div class="clearfix"> </div>
				<!-- /new_arrivals -->
				<?php
										$errors = '';
										$success = '';
										
											if(isset($_GET['send-review'])){
												$name = mysqli_real_escape_string($connection, $_GET['name']);
												$email = mysqli_real_escape_string($connection, $_GET['email']);
												$message = mysqli_real_escape_string($connection, $_GET['message']);
												$review = mysqli_real_escape_string($connection, $_GET['review']);
												$p_id = mysqli_real_escape_string($connection, $_GET['p_id']);
												
												if(empty($name)){
													$errors .= '<div class="alert alert-danger" role="alert">
																	Name field is empty
																  </div>';
												}
												if(empty($email)){
													$errors .= '<div class="alert alert-danger" role="alert">
																	Email field is empty!
																  </div>';
												}if(empty($message)){
													$errors .= '<div class="alert alert-danger" role="alert">
																	Messsage field is empty
																  </div>';
												}
												if(empty($review)){
													$errors .= '<div class="alert alert-danger" role="alert">
																	Pick a review point
																  </div>';
												}
												if(!empty($name) and !empty($email)  and !empty($message) and !empty($review)){
													$sql_insert = mysqli_query($connection , "
																			  INSERT INTO product_reviews SET
																			  id= '',
																			  product_name = '$product_name',
																			  product_id = '$p_id',
																			  store_id = '$store_id',
																			  name = '$name',
																			  email = '$email',
																			  message = '$message',
																			  review = '$review',
																			  date_sent = NOW()
																			  ");
													if($sql_insert){
														$success .= '<div class="alert alert-success" role="alert">
																	Review Sent Successfully
																  </div>';
													}
													else{
														$errors .= '<div class="alert alert-danger" role="alert">
																	something went wrong '. mysqli_error($connection).'
																  </div>';
													}
												}
											}
										
										?>
				
				
				<?php
					echo $errors;
					echo $success;
				?>
	<div class="responsive_tabs_agileits"> 
				<div id="horizontalTab">
						<ul class="resp-tabs-list">
							<li>Description</li>
							<li>Reviews</li>
							<li>Information</li>
						</ul>
					<div class="resp-tabs-container">
					<!--/tab_one-->
					   <div class="tab1">

							<div class="single_page_agile_its_w3ls">
							  <h6><?php  echo $product_name ?> Description</h6>
							   <p><?php echo $product_desc  ?></p>
							</div>
						</div>
						<!--//tab_one-->
						<div class="tab2">
							
							<div class="single_page_agile_its_w3ls">
								<div class="bootstrap-tab-text-grids">
									<div class="bootstrap-tab-text-grid">
										<div class="bootstrap-tab-text-grid-left">
											<img src="dashboard/<?php echo $store_logo ?>" alt="<?php echo $store_name ?>" class="img-responsive">
										</div>
										<div class="bootstrap-tab-text-grid-right">
											<ul>
												<li><a href="#"><?php  echo $store_name ?></a></li>
												<!--<li><a href="#"><i class="fa fa-reply-all" aria-hidden="true"></i> Reply</a></li>-->
											</ul>
											<p><?php echo $store_desc ?></p>
										</div>
										<div class="clearfix"> </div>
						             </div>
									 <div class="add-review">
										
										<h4>add a review to the <?php  echo $store_name ?></h4>
										<form action="single.php" method="GET">
										
											<div class="form-group form-check">
												<input type="checkbox" name="review" value="very good" class="form-check-input" id="exampleCheck1">
												<label class="form-check-label" for="exampleCheck1">Very Good</label>
											  </div>
											<div class="form-group form-check">
												<input type="checkbox" name="review" value="not good" class="form-check-input" id="exampleCheck2">
												<label class="form-check-label" for="exampleCheck2">Not Good</label>
											  </div>
											<!--<form>-->
											<div class="row">
											  <div class="col">
												<input type="text" class="form-control" name="name" placeholder="Name">
											  </div>
											  <div class="col">
												<input type="hidden" class="form-control" name="p_id" value="<?php echo $p_id ?>" placeholder="Name">
											  </div>
											  <div class="col">
												<input type="text" class="form-control" name="email" placeholder="Email">
											  </div>
											</div>
											<div class="form-group">
												<textarea class="form-control" id="exampleFormControlTextarea1" name="message" required="" rows="3">message</textarea>
											  </div>
											<input type="submit" name="send-review" value="SEND">
										</form>
									</div>
								 </div>
								 
							 </div>
						 </div>
						   <div class="tab3">

							<div class="single_page_agile_its_w3ls">
							  <h6><?php  echo $product_name  ?></h6>
							   <p><?php echo $product_info  ?></p>
							</div>
						</div>
					</div>
				</div>	
			</div>
	<!-- //new_arrivals --> 
	  	<!--/slider_owl-->
	
			<div class="w3_agile_latest_arrivals">
			<h3 class="wthree_text_info">More From <span><?php  echo $store_name ?></span></h3>	
					  <?php
									$sql = mysqli_query($connection, "SELECT * FROM products WHERE store_name = '$store_name' ORDER BY price ASC LIMIT 4");
									
									if (mysqli_num_rows($sql) > 0){
										
										while( $results = mysqli_fetch_assoc($sql)	){
											$id = $results['id'];
											$product_name = $results['product_name'];
											$product_category = $results['product_category'];
											$product_id = $results['product_id'];
											$product_image = $results['product_image'];
											$product_price = $results['price'];
											
											//$price = money_format('%i', $product_price);
											echo '<div class="col-md-3 product-men">
											<div class="men-pro-item simpleCart_shelfItem ">
									<div class="men-thumb-item">
										<img src="dashboard/'.$product_image.'" alt="'.$product_name.'" class="pro-image-front uk-height-medium">
										<img src="dashboard/'.$product_image.'" alt="'.$product_name.'" class="pro-image-back uk-height-medium">
											<div class="men-cart-pro">
												<div class="inner-men-cart-pro">
													<a href="single.php?p_id='.$product_id.'" class="link-product-add-cart">Quick View</a>
												</div>
											</div>
											<span class="product-new-top">New</span>
											
									</div>
									<div class="item-info-product ">
										<h4><a href="single.php?'.$product_id.'">'.$product_name.'</a></h4>
										<div class="info-product-price">
											<span class="item_price"> '.$naira.' '.$product_price.'</span>
										</div>
										<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2">
															<form action="cart_update.php" method="post">
																<fieldset>
																	<input type="hidden" name="cmd" value="_cart" />
																	<input type="hidden" name="add" value="1" />
																	<input type="hidden" name="business" value=" " />
																	<input type="hidden" name="item_name" value="'.$product_name.'" />
																	<input type="hidden" name="amount" value="'.$product_price.'" />
																	<input type="hidden" name="currency_code" value="Naira" />
																	<input type="hidden" name="return" value=" " />
																	<input type="hidden" name="cancel_return" value=" " />
																	<input type="submit" name="submit" value="Add to cart" class="button" />
																</fieldset>
															</form>
														</div>
																			
									</div>
								</div>
							</div>';
										}
									}
									
									
								
								?>
							<div class="clearfix"> </div>
					<!--//slider_owl-->
		         </div>
	        </div>
 </div>
<!--//single_page-->
<!--/grids-->

<!--grids-->

<?php require 'footer.inc.php '?>