<?php

require 'cart.php';
require 'sqlconnect.php';
require 'nav.inc.php';

//if(!empty($_SESSION['token'])){
//    echo $token = $_SESSION['token'];
//}

?>
<br><br>

<div class="table-responsive">
    <div class="container">

        <div class="uk-card uk-card-body uk-card-default">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <!--<th scope="col">#</th>-->
                        <th scope="col">Product Name</th>
                        <th scope="col">Product Quantity</th>
                        <th scope="col">Product Price</th>
                        <th scope="col">Product Total</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
          if (!empty($_SESSION['shopping_cart'])) :
            $total = 0;
            foreach ($_SESSION['shopping_cart'] as $key => $product) :

              ?>
                    <!--<th scope="row">1</th>-->
                    <tr>
                        <!--<td></td>-->
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['quantity'];  ?></td>
                        <td><?php echo $product['price']; ?></td>
                        <td><?php echo $naira ?>
                            <?php echo  number_format($product['quantity'] * $product['price'], 2) ?></td>
                        <td><a class="btn btn-danger"
                                href="remove-items.php?action=delete&id=<?php echo $product['id']; ?>"><i
                                    class=" fa fa-2x fa-trash"></i></a></td>
                    </tr>
                    <?php
              $total = $total + ($product['quantity'] * $product['price']);
            endforeach;
            ?>
                    <tr>
                        <td colspan='3' align="center"><b>Total</b></td>
                        <td><?php echo $naira ?> <?php echo number_format($total, 2)   ?>

                        </td>
                    </tr>


                    <tr>
                        <?php
              if (isset($_SESSION['shopping_cart'])) :
                if (count($_SESSION['shopping_cart']) > 0) :
                  ?>
                        <td align="left"><a href="dashboard/checkout.php" class='btn btn-success btn-lg '>Check Out <i
                                    class="fa fa-money"></i></a></td>
                        <?php
              endif;
            endif;
            ?>
                    </tr>
                    <?php
        endif;
        ?>
                    <tr>
                        <br>
                        <td><a href="all-products.php" class="btn btn-info btn-lg">Continue Shopping <i
                                    class="fa fa-cart-arrow-down"></i></a> </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Your Cart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
    </div>
</div>
<?php require 'footer.inc.php'; ?>