<?php

require 'cart.php';
require 'sqlconnect.php';
require 'nav.inc.php';

$errors = '';

if (isset($_GET['store_name'])) {
    $store = $_GET['store_name'];
}

?>


<div class="uk-align-center sticky">
    <div class="uk-container uk-container-small">
        <form class="example" action="store-stores.php" method="GET">
            <input type="text" placeholder="store.." name="store_name" value="<?php echo  $store ?>">
            <button type="submit" name="store"><i class="fa fa-store"></i></button>
        </form>
    </div>
</div>
<?php

if (empty($store)) {
    $errors .= '<div class="alert alert-warning" role="alert">
                            Type into the field
                        </div>';
}

echo $errors;

if (!empty($store)) {
    $sql = "SELECT * FROM stores WHERE store_name LIKE '%$store%' OR store_category LIKE '%$store%' OR store_owner LIKE '%$store%' OR store_description LIKE '%$store%'";
    $results = mysqli_query($connection, $sql);
    $queryresults = mysqli_num_rows($results);

    echo '<p class="uk-text-left text-primary uk-text-center">There are ' . $queryresults . ' results found</p>';
    if ($queryresults > 0) {
        while ($row = mysqli_fetch_assoc($results)) {
            echo '
                    <div class="banner_bottom_agile_info">
                    <div class="container">
                    <div class="banner_bottom_agile_info_inner_w3ls">
                    <a href="elite-stores.php?store_name=' . $row['store_name'] . '"> <div class="col-md-6 wthree_banner_bottom_grid_three_left1 grid">
						<figure class="effect-roxy">
							<img src="dashboard/' . $row['store_logo'] . '" alt="' . $row['store_name'] . '" class="img-responsive uk-height-medium" />
							<figcaption>
								<h3><span>' . $row['store_name'] . '</span></h3>
								<p><span>By</span> ' . $row['store_owner'] . '</p>
							</figcaption>			
						</figure>
                    </div>
                    </div> 
    </div>
    </div>
                   ';
        }
    }
}
?>



<?php require 'footer.inc.php' ?>