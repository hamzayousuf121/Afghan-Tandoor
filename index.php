<? 
  
  $pagetitle="Home";
  include('assets/include/header.php'); 
	
?>
	<main class="main">
		<div class="container-fluid p-0">
			<div class="home-slider-container">
				<div class="home-slider owl-carousel owl-theme owl-theme-light">
					<a href="https://hakeemnasir.com/ameerana/786"><div class="home-slide">
						<div class="slide-bg owl-lazy"
							data-src="assets/images/Banner-1.jpg">

						</div>
						</div><!-- End .container -->
					</a>
					<a href="https://hakeemnasir.com/muqavi/697">
					<div class="home-slide">
						<div class="slide-bg owl-lazy"
							data-src="assets/images/Ban-2.jpg">
						</div><!-- End .slide-bg -->
					</div><!-- End .home-slide -->
					</a>
	
				</div><!-- End .home-slider -->
			</div><!-- End .home-slider-container -->
		</div>

		<!-- slider -->
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
				<h2 class="carousel-title">Featured Products</h2>
				</div>
				<!-- product -->
				<? 
				$parameters = array(":partnerId" =>$partnerId);
				$query      = "SELECT * FROM `products` WHERE `partnerId` = :partnerId ORDER BY id DESC LIMIT 4";
				$query      = $dbhconnection->prepare($query);
				$query->execute($parameters);
				$products	= $query->fetchAll();

				$webmainpath = str_replace("/themes/cluckys","",$serverroot);
				foreach ($products as $product ) {
						$productId=$product["id"];
						$productnameforurl=$productname=$product["name"];
						$productnameforurl=strtolower($productnameforurl);
					  $productnameforurl=str_replace(" ","-",$productnameforurl);
					  $producturl=$productnameforurl."/".$productId;

				?>
				<div class="col-6 col-md-4 col-lg-3 col-xl-3col">
							  <div class="product">
                                <figure class="product-image-container">
                                    <a href="<?=$producturl;?>" class="product-image">
                                        <img src="<?=$baselyneproductimagepath?>/products/<?=$product["image"]?>" alt="product">
                                        </a>
                                    </figure>
                                    <div class="product-details">
                                        <h2 class="product-title" style="height: 20px;">
                                          <a href="<?=$producturl;?>"><?= $product["name"] ?></a>
                                        </h2>
                                         <h2 class="product-title" lang="ur" dir="rtl" style="height: 20px;">
                                            <a href="<?=$producturl;?>"><?= $product["rtlname"] ?></a>
                                            </h2>
                                        <div class="price-box">
                                            <span class="old-price"></span>
                                            <span class="product-price">Rs. <?= number_format($product["price"]) ?>/-</span>
                                        </div><!-- End .price-box -->
                                        <div class="product-action">
                                            <a href="<?=$producturl;?>" class="paction add-cart" title="Add to Cart">
                                                <span>Add to Cart</span>
                                            </a>
                                        </div><!-- End .product-action -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .product -->
                   	</div>   
                   	<?}?>         
				<!-- product -->
				<!-- product -->
			           
				<!-- product -->
				<!-- product -->
				           
				<!-- product -->
				<!-- product -->
			           
				<!-- product -->

			
		</div>	
	</div>
		<!-- slider -->

		<?/*<div class="banners-group">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-12">
						<div class="banner banner-image">
							<a href="/flying-solo/428">
								<img src="assets/images/deals-1.png" alt="banner">
							</a>
						</div><!-- End .banner -->
					</div><!-- End .col-md-4 -->

					<div class="col-lg-4 col-md-4 col-12">
						<div class="banner banner-image">
							<a href="/peck-for-two/429">
								<img src="assets/images/deals-2.png" alt="banner">
							</a>
						</div><!-- End .banner -->
					</div><!-- End .col-md-4 -->

					<div class="col-lg-4 col-md-4 col-12">
						<div class="banner banner-image">
							<a href="/threes-a-party/430">
								<img src="assets/images/deals-3.png" alt="banner">
							</a>
						</div><!-- End .banner -->
					</div><!-- End .col-md-4 -->
				</div><!-- End .row -->
			</div><!-- End .container -->
		</div> */?><!-- End .banners-group -->
		

<div class="container">
    <div class="row">
        <div class="col-sm-3 txt-webkit">
           <a href="https://hakeemnasir.com/muqavi/697"><img src="assets/images/side-banner-1.jpg" alt="" class="img-fluid center-block"></a>
        </div>
        <div class="row col-sm-9 mr-left d-box-none">
            <div class="col-6 p-1">
              <a href="https://hakeemnasir.com/jawahrat/787"> <img src="assets/images/majoon.jpg" alt="" class="img-fluid"></a>
            </div>
            <div class="col-6 p-1">
              <a href="https://hakeemnasir.com/safof-bamurad/784"> <img src="assets/images/safoof.jpg" alt="" class="img-fluid"></a>
            </div>
            <div class="col-4 mt-0 p-1">
              <a href="https://hakeemnasir.com/zafrani-capsule/783"> <img src="assets/images/zafrani.jpg" alt="" class="img-fluid"></a>
            </div>
            <div class="col-4 mt-0 p-1">
               <a href="https://hakeemnasir.com/new-jawani/782"><img src="assets/images/newjawani.jpg" alt="" class="img-responsive"></a>
            </div>
            <div class="col-4 mt-0 p-1">
              <a href="https://hakeemnasir.com/laqahah-nakhal/785"> <img src="assets/images/nakhal.jpg" alt="" class="img-responsive"></a>
            </div>
        </div>
    </div>
</div>		
		
				 <div class="container">
			<div class="container-box">
				<div class="row row-sm justify-content-center list1">
			
				<? 
				$parameters = array(":partnerId" =>$partnerId);
				$query      = "SELECT * FROM `products` WHERE `partnerId` = :partnerId";
				$query      = $dbhconnection->prepare($query);
				$query->execute($parameters);
				$products	= $query->fetchAll();
				// print_r($serverroot);
					$webmainpath = str_replace("/themes/cluckys","",$serverroot);
					foreach ($products as $product ) {
								$productId=$product["id"];
								$productnameforurl=$productname=$product["name"];
								$productnameforurl=strtolower($productnameforurl);
								  $productnameforurl=str_replace(" ","-",$productnameforurl);
								  $producturl=$productnameforurl."/".$productId;
						?>
						<div class="col-6 col-md-4 col-lg-3 col-xl-5col loadMore">
							<div class="product">
                                        <figure class="product-image-container">
                                            <a href="<?=$producturl;?>" class="product-image">
                                                <img src="<?=$baselyneproductimagepath?>/products/<?=$product["image"]?>" alt="product"/>
                                            </a>
                                        </figure>

                                        <div class="product-details">
                                            <!-- End .product-container -->
                                            <h2 class="product-title" style="height: 20px;">
                                            <a href="<?=$producturl;?>"><?= $product["name"] ?></a>
                                            </h2>
                                             <h2 class="product-title" lang="ur" dir="rtl" style="height: 20px;">
                                            <a href="<?=$producturl;?>" ><?= $product["rtlname"] ?></a>
                                            </h2>
                                            <div class="price-box">
                                                <span class="product-price">Rs. <?= number_format($product["price"]) ?>/-</span>
                                                </div><!-- End .price-box -->
                                                <div class="product-action">

         								 <? if($producttype=="customize") { ?>
                                                 
  <a href="<?=$producturl;?>" class="paction add-cart mini-paction addToCartBtn"><span>Add to Cart</span></a>


                                                 <? } else { ?>  



                                                    <a href="#" class="paction add-cart mini-paction addToCartBtn"
                                                        title="Add to Cart"
                                                        data-id="<?= $product["id"] ?>"
                                                        data-name="<?= $product["name"] ?>"
                                                        data-price="<?= $product["price"] ?>"
                                                        data-image="<?=$product["image"]?>">
                                                        <span>Add to Cart</span>
                                                    </a>

                                                <? } ?>
                                                </div>
                                            </div>
                                        </div><!-- End .product -->
						</div><!-- End .col-lg-3 -->

						<?
					}
				?>
				
				
				</div><!-- End .row -->

			</div><!-- End .container-box -->
		</div><!-- End .container -->


		<!-- <div class="mb-3"></div> --><!-- margin -->
		<!-- <div class="container-fluid">
			<div class="">
				
				<img src="assets/images/page-bottombanner.png" class="img-fluid imgchange">
				<img src="assets/images/mobile-banner-2.jpg" class="img-fluid imgchange-mobile">
				
			</div>	
		</div>	 -->
		<div class="container-fluid">
			<div class="container-box container-box-lg info-boxes" style="padding: 20px;">
				<iframe
					src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d924244.0619641689!2d66.59499551729773!3d25.192146526892635!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33e06651d4bbf%3A0x9cf92f44555a0c23!2sKarachi%2C%20Karachi%20City%2C%20Sindh!5e0!3m2!1sen!2s!4v1591014299863!5m2!1sen!2s"
					width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
			</div><!-- End .container-box -->
		</div><!-- End .container -->
	</main><!-- End .main -->
<script>
    function myFunction() {
		location.replace("https://cluckys.baselyne.io/menu#cluckysandwiches")
	}
</script>
 <?php include('assets/include/footer.php')?>