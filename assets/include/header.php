<?  
    include('settings.php'); 

    if(isset($_POST["response_code"]) && $_POST["response_code"] == 100)
        unset($_SESSION['ordereditems']);


    if(isset($_GET["productId"]) && $page=="product.php")
      {    


        $productId=$_GET["productId"];
        $p=[":partnerId" => $partnerId, ":productId"=> $productId, ":status" => 1];
        $q="select * from products where id=:productId and partnerId=:partnerId and status=:status";
        $e=$dbhconnection->prepare($q);
        $e->execute($p);
        $product=$e->fetchAll(PDO::FETCH_ASSOC);
        $productfound=$e->rowCount();

        if($productfound!=1)
         header("location: /shop");
        else 
        {    
           $product=$product[0];
           $productname=$product["name"];
           $pagetitle=$productname;
        }   

    } 
?>
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <? /* <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> */ ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />


    <title> <?=$pagetitle?> | Afghan Tandoor</title>

    <meta name="keywords" content="afghantandoor" />
    <meta name="description"
        content="We procure VIP quality chicken and Mutton available in the market to prepare 
        our products with traditional recipe and we bake our tandoori chicken/mutton in brick ovens.">
    <meta name="author" content="afghantandoor">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/images/icons/favicon.ico">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="/assets/css/style.min.css?v3">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Barlow+Semi+Condensed&display=swap" rel="stylesheet">
    
    <!-- Facebook Pixel Tracking -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window,document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '120692232549753'); 
    fbq('track', 'PageView');
    </script>
    <noscript>
    <img height="1" width="1" 
    src="https://www.facebook.com/tr?id=120692232549753&ev=PageView
    &noscript=1"/>
    </noscript>

<!-- Global site tag (gtag.js) - Google Ads: 667124547 --> 
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-667124547"></script> 
<script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-667124547'); 
</script>

<?php if($_SERVER["SCRIPT_NAME"] == "/thankyou.php"): ?>
<!-- Event snippet for Website traffic (1) conversion page --> 
<script> gtag('event', 'conversion', {'send_to': 'AW-667124547/3aDBCJf2oMMBEMOGjr4C'}); </script>
<?php endif; ?>
</head>

<body data-spy="scroll" data-target="navbar-example2" data-offset="20">
    
    <!-- Facebook Pixel Code -->
        <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '2602041953249082');
        fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=2602041953249082&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Facebook Pixel Code -->
    <div class="page-wrapper">
        <header class="header">
            <div class="header-top">
                <div class="container-fluid">

                </div><!-- End .container -->
            </div><!-- End .header-top -->

            <div class="header-middle">
                <div class="container-fluid">
                    <div class="header-left">
                        <button class="mobile-menu-toggler" type="button">
                            <i class="icon-menu"></i>
                        </button>
                        <a href="/" class="logo">
                            <img src="/assets/images/logo.png" alt="afghan Tandoor's">
                        </a>
                    </div><!-- End .header-left -->

                        <!-- <div class="header-center d-none d-lg-block">
                           <h3 class="binnasir">AFGHAN TANDOOR<br><p class="since"><span class="red">Dawakhana Regd: 02107</span><span class="line"> | </span><span class="green"> Since 1990 </span></p></h3> 
                         
                        </div>     -->

                    <div class="header-right">

                        <div class="header-contact">
                            <i class="icon-phone"><!-- <img src="/assets/images/phone.png"> --></i>
                            <span>CALL US</span>
                            <a href="tel:03008273030"><strong> 0300 8273030</strong></a>

                        </div><!-- End .header-contact -->

                        <div class="dropdown cart-dropdown cart-icon">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" data-display="static"
                                style="padding-right: 0rem;">
                                <img src="/assets/images/cart.png" class="img-fluid" style="height: 30px;">
                                <span class="cart-count"><?= count($_SESSION["ordereditems"]) ?></span>
                            </a>

                            <div class="dropdown-menu">
                                <div class="dropdownmenu-wrapper">
                                    <div class="dropdown-cart-products">
                                        <?php 
                                    $totalCartPrice = 0; 
									
									if(isset($_SESSION['ordereditems']))
									 {
                                    // print_r($_SESSION["ordereditems"]);
                                    foreach ($_SESSION["ordereditems"] as $cartId => $cartItem) { 
                                        $totalCartPrice += $cartItem["qty"]*$cartItem["price"]; ?>
                                        <div class="product" id="product-<?= $cartId ?>">
                                            <div class="product-details">
                                                <h4 class="product-title">
                                                    <a href="productdetail"><?= $cartItem["name"] ?></a>
                                                </h4>
                                                <span class="cart-product-info">
                                                    <span class="cart-product-qty"><?= $cartItem["qty"] ?></span>
                                                    x Rs. <?= $cartItem["price"] ?>
                                                </span>
                                            </div>
                                            <figure class="product-image-container">
                                                <a href="productdetail" class="product-image">
                                                    <img src="<?=$baselyneproductimagepath?>/products/<?=$cartItem["image"]?>"
                                                        alt="product">
                                                </a>
                                                <a href="Javascript:void(0);" class="btn-remove deleteCart"
                                                    data-id="<?= $cartId ?>" title="Remove Product"><i
                                                        class="icon-cancel"></i></a>
                                            </figure>
                                        </div>
                                        <?php 
                                    }   
									
									
									}
									?>
                                    </div>
                                    <div class="dropdown-cart-total">
                                        <span>Total</span>

                                        <span class="cart-total-price">Rs. <?=$totalCartPrice?></span>
                                    </div><!-- End .dropdown-cart-total -->

                                    <div class="dropdown-cart-action">
                                        <a href="/cart" class="btn btn-block">View Cart</a>
                                        
                                    </div><!-- End .dropdown-cart-total -->
                                </div><!-- End .dropdownmenu-wrapper -->
                            </div><!-- End .dropdown-menu -->
                        </div><!-- End .dropdown -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-middle -->

            <div class="header-bottom sticky-header">
                <div class="container-fluid p-0">
                    <a href="/" class="logo">
                        <img src="/assets/images/logo.png" alt="Porto Logo">
                    </a>
                    <nav class="main-nav">
                        <ul class="menu sf-arrows">
                            <li <? if($page=="index.php" ) { ?> class="active"
                                <? } ?>><a href="/">Home</a></li>
                            <li <? if($page=="menu.php" ) { ?> class="active"
                                <? } ?>><a href="shop">Shop</a></li>
                            <li <? if($page=="aboutus.php" ) { ?> class="active"
                                <? } ?>><a href="aboutus">About Us</a></li>
                            <li <? if($page=="contactus.php" ) { ?> class="active"
                                <? } ?>><a href="contactus">Contact Us</a></li>

                            <!--  <li><a href="#" >FRANCHISING</a></li>
                            <li><a href="#" >CONTACT US</a></li> -->


                            <!--  <li class="float-right"><a href="#">Buy Porto!</a></li>
                            <li class="float-right"><a href="#">Special Offer!</a></li> -->
                        </ul>
                    </nav>
                    <div class="header-right cart-dnone" id="cartnone">

                        <div class="header-contact">
                            <i class="icon-phone"><!-- <img src="/assets/images/phone.png"> --></i>
                            <span>CALL US</span>
                            <a href="tel:03008273030"><strong> 0300 8273030</strong></a>

                        </div><!-- End .header-contact -->

                        <div class="dropdown cart-dropdown cart-icon">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" data-display="static"
                                style="padding-right: 0rem;">
                                <img src="/assets/images/cart.png" class="img-fluid" style="height: 30px;">
                                <span class="cart-count"><?= count($_SESSION["ordereditems"]) ?></span>
                            </a>

                            <div class="dropdown-menu">
                                <div class="dropdownmenu-wrapper">
                                    <div class="dropdown-cart-products">
                                        <?php 
                                    $totalCartPrice = 0; 
                                    // print_r($_SESSION["ordereditems"]);
									if(isset($_SESSION['ordereditems']))
									 {
                                    foreach ($_SESSION["ordereditems"] as $cartId => $cartItem) { 
                                        $totalCartPrice += $cartItem["qty"]*$cartItem["price"]; ?>
                                        <div class="product" id="product-<?= $cartId ?>">
                                            <div class="product-details">
                                                <h4 class="product-title">
                                                    <a href="productdetail"><?= $cartItem["name"] ?></a>
                                                </h4>
                                                <span class="cart-product-info">
                                                    <span class="cart-product-qty"><?= $cartItem["qty"] ?></span>
                                                    x Rs. <?= $cartItem["price"] ?>
                                                </span>
                                            </div>
                                            <figure class="product-image-container">
                                                <a href="productdetail" class="product-image">
                                                    <img src="<?=$baselyneproductimagepath?>/products/<?=$cartItem["image"]?>"
                                                        alt="product">
                                                </a>
                                                <a href="Javascript:void(0);" class="btn-remove deleteCart"
                                                    data-id="<?= $cartId ?>" title="Remove Product"><i
                                                        class="icon-cancel"></i></a>
                                            </figure>
                                        </div>
                                        <?php 
                                    }  
									
									 } ?>
                                    </div>
                                    <div class="dropdown-cart-total">
                                        <span>Total</span>

                                        <span class="cart-total-price">Rs. <?=$totalCartPrice?></span>
                                    </div><!-- End .dropdown-cart-total -->

                                    <div class="dropdown-cart-action">
                                        <a href="/cart" class="btn btn-block">View Cart</a>
                                        
                                    </div><!-- End .dropdown-cart-total -->
                                </div><!-- End .dropdownmenu-wrapper -->
                            </div><!-- End .dropdown-menu -->
                        </div><!-- End .dropdown -->
                    </div><!-- End .header-right -->
                </div><!-- End .header-bottom -->
            </div><!-- End .header-bottom -->
        </header><!-- End .header -->