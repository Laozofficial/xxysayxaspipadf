	<?php

        require 'cart.php';
        require 'sqlconnect.php';
        require 'nav.inc.php';
        
		$category = 'all';
		
		if(isset($_GET['filter'])){
			 $category = $_GET['category'];
				
		}
        
?>
<div class="page-head_agile_info_w3l">
		<div class="container">
			<h3>All <span> Products</span></h3>
			<!--/w3_short-->
				 <div class="services-breadcrumb">
						<div class="agile_inner_breadcrumb">

						   <ul class="w3_short">
								<li><a href="index.php">Home</a><i>|</i></li>
								<li>All Products</li>
							</ul>
						 </div>
				</div>
	   <!--//w3_short-->
	</div>
</div><br><br>
<div class="uk-container uk-container-small uk-align-centers">
	<div class="uk-inline">
		<form action="all-products.php" method="GET">
			<h3 class="uk-text-center"><span class="uk-text-bold">Filter Products Search results by category</span>
				
					  <?php  
                        $sql = "SELECT store_category_name FROM store_categories ";
                        $results_query = mysqli_query($connection, $sql);

                            if (mysqli_num_rows($results_query) > 0) {
                                    echo ' <div class="form-group">
                                    <select class="uk-select uk-form-large" name="category">
                                    <option selected value="">choose...</option>';
                                while($results = mysqli_fetch_array($results_query)) {
                                        $data = $results['store_category_name'];
                                echo '<option value="'.$data.'">'.$data.'</option>   ';
                                }
                                echo ' </select>
                                </div>';
                            }
                        ?> 
				</h3>
			<button name="filter" class="btn btn-block" style="background-color: #2fdab8; color: white">Filter</button>
		</form>
	</div>
</div>

<?php
        
        $sql = mysqli_query($connection, "SELECT * FROM products  WHERE product_category = '$category' ORDER BY date_posted DESC ");
									
									if (mysqli_num_rows($sql) > 0){
                                            echo '<div class="uk-container">';
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
                                        echo '</div>';
									}
									
									
								
    
    
    
    
if($category == 'all'){
	  $sql = mysqli_query($connection, "SELECT * FROM products ORDER BY date_posted DESC ");
									
									if (mysqli_num_rows($sql) > 0){
                                            echo '<div class="uk-container">';
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
                                        echo '</div>';
									}
									
									
}

?>

<?php require 'footer.inc.php' ?>