<?php

require 'cart.php';
require 'sqlconnect.php';
require 'nav.inc.php';


if (isset($_GET['category'])) {
	$category = $_GET['category'];
}


?>
<div class="page-head_agile_info_w3l">
    <div class="container">
        <h3>Our <span>Stores </span></h3>
        <!--/w3_short-->
        <div class="services-breadcrumb">
            <div class="agile_inner_breadcrumb">

                <ul class="w3_short">
                    <li><a href="index.php">Home</a><i>|</i></li>
                    <li>All Our Stores</li>
                </ul>
            </div>
        </div>
        <!--//w3_short-->
    </div>
</div>
<br>
<div class="uk-align-center sticky">
    <div class="uk-container uk-container-small">
		<h3 class="text-dark uk-text-center display-4">Search Stores</h3>
        <form class="example" action="search-stores.php" method="GET">
            <input type="text" placeholder="Search Stores.." name="store_name">
            <button type="submit" name="search"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>
<?php


if ($category = 'all') {

	$sql = mysqli_query($connection, "SELECT * FROM stores WHERE store_active = 'active' AND store_logo != '' ORDER BY date_opened DESC  ");

	if (mysqli_num_rows($sql) > 0) {
		echo '    <div class="banner_bottom_agile_info">
	    <div class="container">
         <div class="banner_bottom_agile_info_inner_w3ls">';
		//    loop through the stores in the database 
		while ($store_results = mysqli_fetch_assoc($sql)) {
			$id = $store_results['id'];
			$store_id = $store_results['store_id'];
			$store_name = $store_results['store_name'];
			$store_category = $store_results['store_category'];
			$is_store_active = $store_results['store_active'];
			$store_logo = $store_results['store_logo'];
			$store_owner = $store_results['store_owner'];
			$store_verify = $store_results['store_verify'];
			$store_desc = $store_results['store_description'];


			$body = substr($store_desc, 0, 10);
			echo '<a href="elite-stores.php?store_name=' . $store_name . '"> <div class="col-md-6 wthree_banner_bottom_grid_three_left1 grid">
						<figure class="effect-roxy">
							<img src="dashboard/' . $store_logo . '" alt="' . $store_name . '" class="img-responsive uk-height-medium" />
							<figcaption>
								<h3><span>' . $store_name . '</span></h3>
								<p><span>By</span> ' . $store_owner . '</p>
							</figcaption>			
						</figure>
					</div>';
		}
		echo '</div> 
    </div>
    </div>';
	}
}




?>



<!--<div class="banner_bottom_agile_info">
	    <div class="container">
            <div class="banner_bottom_agile_info_inner_w3ls">
    	           <div class="col-md-6 wthree_banner_bottom_grid_three_left1 grid">
						<figure class="effect-roxy">
							<img src="assets/images/bottom1.jpg" alt=" " class="img-responsive" />
							<figcaption>
								<h3><span>F</span>all Ahead</h3>
								<p>New Arrivals</p>
							</figcaption>			
						</figure>
					</div>
					 <div class="col-md-6 wthree_banner_bottom_grid_three_left1 grid">
						<figure class="effect-roxy">
							<img src="assets/images/bottom2.jpg" alt=" " class="img-responsive" />
							<figcaption>
								<h3><span>F</span>all Ahead</h3>
								<p>New Arrivals</p>
							</figcaption>			
						</figure>
					</div>
					<div class="clearfix"></div>
		    </div> 
		 </div> 
    </div>-->

<?php require 'footer.inc.php' ?>