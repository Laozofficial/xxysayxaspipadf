<!--
Author: QuickPen Technologies
Author URL: http://elite.com.ng
License: Creative Commons Attribution 3.0 Unported
--><?php


    // session_start();

    // $token = $_SESSION['token'];


    ?>
<!DOCTYPE html>
<html>

<head>
    <title>Elite Shoppy an Ecommerce Online Shopping Mall and High Class Delivery Service rendered</title>
    <!--/tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Elite Shoppy Responsive ecommerce store, " />
    <script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
    <!--//tags -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/uikit.css" rel="stylesheet">
    <link href="assets/css/uikit.min.css" rel="stylesheet">
    <link href="assets/css/animate.css" rel="stylesheet">
    <!-- <link href="assets/css/font-awesome.css" rel="stylesheet">  -->
    <link href="assets/css/easy-responsive-tabs.css" rel='stylesheet' type='text/css' />
    <!-- //for bootstrap working -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">
    <link
        href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,900,900italic,700italic'
        rel='stylesheet' type='text/css'>
    <style>
    #myBtn {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Fixed/sticky position */
        bottom: 20px;
        /* Place the button at the bottom of the page */
        left: 30px;
        /* Place the button 30px from the right */
        z-index: 99;
        /* Make sure it does not overlap */
        border: none;
        /* Remove borders */
        outline: none;
        /* Remove outline */
        background-color: #2fdab8;
        /* Set a background color */
        color: white;
        /* Text color */
        cursor: pointer;
        /* Add a mouse pointer on hover */
        padding: 15px;
        /* Some padding */
        border-radius: 10px;
        /* Rounded corners */
        font-size: 18px;
        /* Increase font size */
    }

    #myBtn:hover {
        background-color: #555;
        /* Add a dark-grey background on hover */
    }

    * {
        box-sizing: border-box;
    }

    /* Style the search field */
    form.example input[type=text] {
        padding: 10px;
        font-size: 17px;
        border: 1px solid grey;
        float: left;
        width: 80%;
        background: #f1f1f1;
    }

    /* Style the submit button */
    form.example button {
        float: left;
        width: 20%;
        padding: 10px;
        background: #2196F3;
        color: white;
        font-size: 17px;
        border: 1px solid grey;
        border-left: none;
        /* Prevent double borders */
        cursor: pointer;
    }

    form.example button:hover {
        background: #0b7dda;
    }

    /* Clear floats */
    form.example::after {
        content: "";
        clear: both;
        display: table;
    }
    </style>
</head>

<body>
    <!-- header -->
    <div class="header" id="home">
        <div class="container">
            <ul>
                <!-- <li> <a href="#" ><i class="fa fa-map-marker" aria-hidden="true"></i> Lagos Ikeja, Nigeria </a></li> -->
                <!-- <li> <a href="#" data-toggle="modal" data-target="#myModal2"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sign Up </a></li> -->
                <?php
                if (isset($_SESSION['token'])) {
                    echo '<li> <a href="dashboard/index.php" ><i class="fa fa-unlock-alt" aria-hidden="true"></i> Dashboard </a></li>
                    <li> <a href="logout.php" ><i class="fa fa-sign-out" aria-hidden="true"></i> Logout </a></li>';
                } else {
                    echo '<li> <a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-unlock-alt"
                            aria-hidden="true"></i> Sign In </a></li>
                <li> <a href="#" data-toggle="modal" data-target="#myModal2"><i class="fa fa-pencil-square-o"
                            aria-hidden="true"></i> Sign Up </a></li>';
                }
                ?>


                <li class="uk-visible@m"><i class="fa fa-phone" aria-hidden="true"></i> Call : +2349098311785</li>
                <li class="uk-visible@m"><i class="fa fa-envelope-o" aria-hidden="true"></i> <a
                        href="mailto:support@elitestores.com">support@elitestores.com</a></li>
            </ul>
        </div>
    </div>
    <!-- //header -->
    <!-- header-bot -->
    <div class="header-bot">
        <div class="header-bot_inner_wthreeinfo_header_mid">
            <div class="col-md-4 header-middle">
                <form action="#" method="post">
                    <input type="search" name="search" placeholder="Search here..." required="">
                    <input type="submit" value=" ">
                    <div class="clearfix"></div>
                </form>
            </div>
            <!-- header-bot -->
            <div class="col-md-4 logo_agile">
                <h1><a href="index.php"><span>E</span>lite Stores <i class="fa fa-shopping-bag top_logo_agile_bag"
                            aria-hidden="true"></i></a></h1>
            </div>
            <!-- header-bot -->
            <div class="col-md-4 agileits-social top_content">
                <ul class="social-nav model-3d-0 footer-social w3_agile_social">
                    <li class="share">Share On : </li>
                    <li><a href="#" class="facebook">
                            <div class="front"><i class="fa fa-facebook" aria-hidden="true"></i></div>
                            <div class="back"><i class="fa fa-facebook" aria-hidden="true"></i></div>
                        </a></li>
                    <li><a href="#" class="twitter">
                            <div class="front"><i class="fa fa-twitter" aria-hidden="true"></i></div>
                            <div class="back"><i class="fa fa-twitter" aria-hidden="true"></i></div>
                        </a></li>
                    <li><a href="#" class="instagram">
                            <div class="front"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                            <div class="back"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                        </a></li>
                    <li><a href="#" class="pinterest">
                            <div class="front"><i class="fa fa-linkedin" aria-hidden="true"></i></div>
                            <div class="back"><i class="fa fa-linkedin" aria-hidden="true"></i></div>
                        </a></li>
                </ul>



            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- //header-bot -->
    <!-- banner -->
    <div class="ban-top">
        <div class="container">
            <div class="top_nav_left">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav menu__list">
                                <li class="active menu__item"><a class="menu__link" href="index.php">Home <span
                                            class="sr-only">(current)</span></a></li>
                                <li class=" menu__item"><a class="menu__link" href="about.php">About</a></li>
                                <li class="dropdown menu__item">
                                    <a href="stores.php" class="dropdown-toggle menu__link"> Stores </a>
                                </li>
                                <li class="dropdown menu__item">
                                    <a href="all-products.php" class="dropdown-toggle menu__link">Products </a>

                                </li>
                                <!-- <li class="menu__item dropdown">
					   <a class="menu__link" href="#" class="dropdown-toggle" data-toggle="dropdown">Short Codes <b class="caret"></b></a>
								<ul class="dropdown-menu agile_short_dropdown">
									<li><a href="icons.php">Web Icons</a></li>
									<li><a href="typography.php">Typography</a></li>
								</ul>
					</li> -->
                                <li class=" menu__item"><a class="menu__link" href="contact.php">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="top_nav_right">

                <!--<form action="#" method="post" class="last"> -->
                <!--<input type="hidden" name="cmd" value="_cart">-->
                <!--<input type="hidden" name="display" value="1">-->
                <?php
                if (isset($_SESSION['shopping_cart'])) :
                    if (count($_SESSION['shopping_cart']) > 0) :
                        ?>
                <div class="wthreecartaits wthreecartaits2 cart cart box_1">
                    <a href="view-cart.php"><button class="w3view-cart" type="submit" name="submit" value=""><i
                                class="fa fa-cart-arrow-down" aria-hidden="true"></i></button></a>
                    <?php
                    endif;
                endif;
                ?>

                    <!--</form>  -->

                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- //banner-top -->