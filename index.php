	

<?php

//session_start();
require 'cart.php';
	require 'sqlconnect.php';
require 'nav.inc.php';




?>

<!-- Modal1 -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
						<div class="modal-body modal-body-sub_agile">
						<div class="col-md-8 modal_body_left modal_body_left1">
						<h3 class="agileinfo_sign">Sign In <span>Now</span></h3>
									<form action="login.php" method="post">
							<div class="styled-input agile-styled-input-top">
								<input type="email" name="email" required="">
								<label>Email</label>
								<span></span>
							</div>
							<div class="styled-input">
								<input type="password" name="password" required=""> 
								<label>Password</label>
								<span></span>
							</div> 
							<input type="submit" name="login" value="Sign In">
						</form>
														<div class="clearfix"></div>
														<p><a href="#" data-toggle="modal" data-target="#myModal2" > Don't have an account?</a></p>

						</div>
						<div class="col-md-4 modal_body_right modal_body_right1">
							<img src="assets/images/log_pic.jpg" alt=" "/>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<!-- //Modal content-->
			</div>
		</div>
<!-- //Modal1 -->
<!-- Modal2 -->
		<div class="modal fade" id="myModal2" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
						<div class="modal-body modal-body-sub_agile">
						<div class="col-md-8 modal_body_left modal_body_left1">
						<h3 class="agileinfo_sign">Sign Up <span>Now</span></h3>
						 <form action="signup.php" method="post">
							<div class="styled-input agile-styled-input-top">
								<input type="text" name="first_name" required="">
								<label>First Name</label>
								<span></span>
							</div>
							<div class="styled-input agile-styled-input-top">
								<input type="text" name="last_name" required="">
								<label>Last Name</label>
								<span></span>
							</div>
							<div class="styled-input">
								<input type="email" name="email" required=""> 
								<label>Email</label>
								<span></span>
							</div> 
							<div class="styled-input">
								<input type="password" name="password" required=""> 
								<label>Password</label>
								<span></span>
							</div> 
							<div class="styled-input">
								<input type="password" name="cpassword" required=""> 
								<label>Confirm Password</label>
								<span></span>
							</div> 
							<input type="submit" name="signup" value="Sign Up">
						</form>
						  <ul class="social-nav model-3d-0 footer-social w3_agile_social top_agile_third">
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
														<div class="clearfix"></div>
														<p><a href="terms.php">By clicking register, I agree to your terms</a></p>

						</div>
						<div class="col-md-4 modal_body_right modal_body_right1">
							<img src="assets/images/log_pic.jpg" alt=" "/>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<!-- //Modal content-->
			</div>
		</div>
<!-- //Modal2 -->

<!-- banner -->
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1" class=""></li>
			<li data-target="#myCarousel" data-slide-to="2" class=""></li>
			<li data-target="#myCarousel" data-slide-to="3" class=""></li>
			<li data-target="#myCarousel" data-slide-to="4" class=""></li> 
		</ol>
		<div class="carousel-inner" role="listbox">
			<div class="item active"> 
				<div class="container">
					<div class="carousel-caption">
						<h3><span>The Biggest Sale From All Stores</span></h3>
						<p>Special for today</p>
						<a class="hvr-outline-out button2" href="stores.php?category=all">Browse Stores Now </a>
					</div>
				</div>
			</div>
			<div class="item item2"> 
				<div class="container">
					<div class="carousel-caption">
						<h3><span>Summer Collection For Men</span></h3>
						<p>New Arrivals On Sale</p>
						<a class="hvr-outline-out button2" href="stores.php?category=men">Browse Men Stores </a>
					</div>
				</div>
			</div>
			<div class="item item3"> 
				<div class="container">
					<div class="carousel-caption">
						<h3><span>The Biggest Sale</span></h3>
						<p>Special for today</p>
						<!--<a class="hvr-outline-out button2" href="mens.php">Shop Now </a>-->
					</div>
				</div>
			</div>
			<div class="item item4"> 
				<div class="container">
					<div class="carousel-caption">
						<h3><span>Summer Collection For The Ladies</span></h3>
						<p>New Arrivals On Sale</p>
						<a class="hvr-outline-out button2" href="stores.php?category=women">Browse Women Stores </a>
					</div>
				</div>
			</div>
			<div class="item item5"> 
				<div class="container">
					<div class="carousel-caption">
						<h3>The Biggest <span>Sale</span></h3>
						<p>Special for today</p>
						<!--<a class="hvr-outline-out button2" href="mens.php">Shop Now </a>-->
					</div>
				</div>
			</div> 
		</div>
		<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
		<!-- The Modal -->
    </div> 
	<!-- //banner -->
    <div class="banner_bottom_agile_info">
	    <div class="container">
            <div class="banner_bottom_agile_info_inner_w3ls">
    	           <div class="col-md-6 wthree_banner_bottom_grid_three_left1 grid">
						<figure class="effect-roxy">
							<img src="assets/images/bottom1.jpg" alt=" " class="img-responsive" />
							<figcaption>
								<h3><span>Create </span>Your Store</h3>
								<p><a class="hvr-outline-out button2 btn-lg text-light" href="signup.php">Join Us </a></p>
							</figcaption>			
						</figure>
					</div>
					 <div class="col-md-6 wthree_banner_bottom_grid_three_left1 grid">
						<figure class="effect-roxy">
							<img src="assets/images/bottom2.jpg" alt=" " class="img-responsive" />
							<figcaption>
								<h3><span>Shop </span>With Us</h3>
								<p><a class="hvr-outline-out button2 btn-lg text-light" href="stores.php?category=all">Browse Stores </a></p>
							</figcaption>			
						</figure>
					</div>
					<div class="clearfix"></div>
		    </div> 
		 </div> 
    </div>
	<!-- schedule-bottom -->
	<div class="schedule-bottom">
		<div class="col-md-6 agileinfo_schedule_bottom_left">
			<img src="assets/images/mid.jpg" alt=" " class="img-responsive" />
		</div>
		<div class="col-md-6 agileits_schedule_bottom_right">
			<div class="w3ls_schedule_bottom_right_grid">
				<h3>Save up to <span>50%</span> by Shopping in our Hosted stores</h3>
				<p>Come in and take a look at out stores and check what you like and buy it , we have a very customer favoured "Money Back" Policy.</p>
				<div class="col-md-4 w3l_schedule_bottom_right_grid1">
					<i class="fa fa-user-o" aria-hidden="true"></i>
					<h4>Customers</h4>
					<?php
					 $result = mysqli_query($connection, "SELECT COUNT(*) AS `count` FROM `users`");
                       $row = mysqli_fetch_assoc($result);
                       $count = $row['count'];
					?>
					<h5 class="counter"><?php echo $count ?></h5>
				</div>
				<div class="col-md-4 w3l_schedule_bottom_right_grid1">
					<i class="fa fa-calendar-o" aria-hidden="true"></i>
					<h4>Stores</h4>
					<?php
					 $result = mysqli_query($connection, "SELECT COUNT(*) AS `count` FROM `stores`");
                       $row = mysqli_fetch_assoc($result);
                       $count = $row['count'];
					?>
					<h5 class="counter"><?php echo $count  ?></h5>
				</div>
				<div class="col-md-4 w3l_schedule_bottom_right_grid1">
					<i class="fa fa-shield" aria-hidden="true"></i>
					<h4>Porducts Listed</h4>
					<?php
					 $result = mysqli_query($connection, "SELECT COUNT(*) AS `count` FROM `products`");
                       $row = mysqli_fetch_assoc($result);
                       $count = $row['count'];
					?>
					<h5 class="counter"><?php echo $count  ?></h5>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
<!-- //schedule-bottom -->
	<br><br>
	<div class="container">
		  
     
	</div>
<!--/grids-->
<!-- /new_arrivals --> 
	<div class="new_arrivals_agile_w3ls_info"> 
		<div class="container">
		    <h3 class="wthree_text_info">New <span>Arrivals</span></h3>		
				<div id="horizontalTab">
						<ul class="resp-tabs-list">
							<li> shoe's</li>
							<li> Women's</li>
							<li> Bags</li>
							<li> Footwear</li>
						</ul>
					<div class="resp-tabs-container">
					<!--/tab_one-->
						<div class="tab1">
							
								<?php
									$sql = mysqli_query($connection, "SELECT * FROM products WHERE product_category = 'shoes' ORDER BY price ASC LIMIT 12");
									
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
											<span class="item_price"> '.$naira.' '.number_format($product_price,2).'</span>
										</div>
										<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2">
															<form action="cart.php?action=add&id='.$product_id.'" method="post">
																<fieldset>
																	<input type="hidden" name="cmd" value="_cart" />
																	<input type="hidden" name="quantity" value="1" />
																	<input type="hidden" name="business" value=" " />
																	<input type="hidden" name="name" value="'.$product_name.'" />
																	<input type="hidden" name="price" value="'.$product_price.'" />
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
							
								
							<div class="clearfix"></div>
						</div>
						
						<!--//tab_one-->
						<!--/tab_two-->
						<div class="tab2">
							 <?php
									$sql = mysqli_query($connection, "SELECT * FROM products WHERE product_category = 'shoes' ORDER BY price ASC LIMIT 12");
									
									if (mysqli_num_rows($sql) > 0){
										
										while( $results = mysqli_fetch_assoc($sql)	){
											$id = $results['id'];
											$product_name = $results['product_name'];
											$product_category = $results['product_category'];
											$product_id = $results['product_id'];
											$product_image = $results['product_image'];
											$product_price = $results['price'];
											
											
											echo '<div class="col-md-3 product-men"><div class="men-pro-item simpleCart_shelfItem">
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
											<span class="item_price"> '.$naira.' '.number_format($product_price,2).'</span>
										</div>
										<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2">
															<form action="cart.php?action=add&id='.$product_id.'" method="post">
																<fieldset>
																	<input type="hidden" name="cmd" value="_cart" />
																	<input type="hidden" name="quantity" value="1" />
																	<input type="hidden" name="business" value=" " />
																	<input type="hidden" name="name" value="'.$product_name.'" />
																	<input type="hidden" name="price" value="'.$product_price.'" />
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
							<div class="clearfix"></div>
						</div>
					 <!--//tab_two-->
						<div class="tab3">
								<?php
									$sql = mysqli_query($connection, "SELECT * FROM products WHERE product_category = 'shoes' ORDER BY price ASC LIMIT 12");
									
									if (mysqli_num_rows($sql) > 0){
										
										while( $results = mysqli_fetch_assoc($sql)	){
											$id = $results['id'];
											$product_name = $results['product_name'];
											$product_category = $results['product_category'];
											$product_id = $results['product_id'];
											$product_image = $results['product_image'];
											$product_price = $results['price'];
											
											
											echo '<div class="col-md-3 product-men"><div class="men-pro-item simpleCart_shelfItem">
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
											<span class="item_price"> '.$naira.' '.number_format($product_price,2).'</span>
										</div>
										<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2">
															<form action="cart.php?action=add&id='.$product_id.'" method="post">
																<fieldset>
																	<input type="hidden" name="cmd" value="_cart" />
																	<input type="hidden" name="quantity" value="1" />
																	<input type="hidden" name="business" value=" " />
																	<input type="hidden" name="name" value="'.$product_name.'" />
																	<input type="hidden" name="price" value="'.$product_price.'" />
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
							<div class="clearfix"></div>
						</div>
						<div class="tab4">
							
							    <?php
									$sql = mysqli_query($connection, "SELECT * FROM products WHERE product_category = 'shoes' ORDER BY price ASC LIMIT 12");
									
									if (mysqli_num_rows($sql) > 0){
										
										while( $results = mysqli_fetch_assoc($sql)	){
											$id = $results['id'];
											$product_name = $results['product_name'];
											$product_category = $results['product_category'];
											$product_id = $results['product_id'];
											$product_image = $results['product_image'];
											$product_price = $results['price'];
											
											
											echo '<div class="col-md-3 product-men"><div class="men-pro-item simpleCart_shelfItem">
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
											<span class="item_price"> '.$naira.' '.number_format($product_price,2).'</span>
										</div>
										<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2">
															<form action="cart.php?action=add&id='.$product_id.'" method="post">
																<fieldset>
																	<input type="hidden" name="cmd" value="_cart" />
																	<input type="hidden" name="quantity" value="1" />
																	<input type="hidden" name="business" value=" " />
																	<input type="hidden" name="name" value="'.$product_name.'" />
																	<input type="hidden" name="price" value="'.$product_price.'" />
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
							<div class="clearfix"></div>
						</div>
					</div>
				</div>	
			</div>
		</div>
	<!-- //new_arrivals --> 
	<!-- /we-offer -->
		<div class="sale-w3ls">
			<div class="container">
				<h6>We Offer Flat <span>40%</span> Discount On All Products</h6>
 
				<a class="hvr-outline-out button2" href="stores.php">Shop Now </a>
			</div>
		</div>
	<!-- //we-offer -->
<?php  require 'footer.inc.php' ?>