<? 
 
   $pagetitle="Deals";
   include('assets/include/header.php');

   $p=[":partnerId" => $partnerId, ":maincategoryId" => 167, ":status" => 1];
   $q="select * from products where partnerId=:partnerId and maincategoryId=:maincategoryId and status=:status";
   $e=$dbhconnection->prepare($q);
   $e->execute($p);
   $dealsdatafetch=$e->fetchAll(PDO::FETCH_ASSOC);


 ?>
<div class="container-fluid">
    <div class="container-box">
        <div class="row">

            <div class="" style="background-image: url('');">
                <img src="assets/images/sl1.jpg" class="img-fluid">
            </div><!-- End .banner -->

        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="container-box">
        <div class="row">
            <div class="product-wrapper">
                <div class="row row-sm category-grid">
                    <? 
                    foreach($dealsdatafetch as $dealdata){      
                        $productId          = $dealdata["id"];
                        $productimage       = $dealdata["image"];
                        $productnameforurl  = $productname=$dealdata["name"];
                        $productnameforurl  = strtolower($productnameforurl);
                        $productnameforurl  = str_replace("'","-",$productnameforurl);
                        $productnameforurl  = str_replace(" ","-",$productnameforurl);
                        $producturl         = $productnameforurl."/".$productId;                      
                        ?>
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="grid-product">
                                <figure class="product-image-container">
                                    <a href="<?=$producturl;?>" class="product-image">
                                        <img src="https://www.baselyne.io/partnerwebsites/assets/products/<?=$productimage;?>"
                                            alt="product">
                                    </a>

                                </figure>
                                <div class="product-details">
                                    <h2 class="product-title">
                                        <a href="<?=$producturl;?>">FLying Solo</a>
                                    </h2>


                                    <div class="product-grid-action">


                                        <a href="<?=$producturl;?>" class="paction add-cart"
                                            title="Add to Cart">
                                            <span>Add to Cart</span>
                                        </a>


                                    </div><!-- End .product-grid-action -->
                                </div><!-- End .product-details -->
                            </div><!-- End .grid-product -->
                        </div><!-- End .col-md-4 -->
                        <? 
                    } ?>
                </div><!-- End .row -->
            </div>
        </div>
    </div>
</div>
<? include('assets/include/footer.php'); ?>
<script>
    // // animate
    // $('html, body').animate({
    // scrollTop: $(this.hash).offset().top - 1000
    // }, 2500, function () {
    // window.location.hash = hash - 1000
    // });

    jQuery(document).ready(function (jQuery) {
        var topMenu = jQuery("#top-menu"),
            offset = 0,
            topMenuHeight = topMenu.outerHeight() + offset,
            // All list items
            menuItems = topMenu.find('a[href*="#"]'),
            // Anchors corresponding to menu items
            scrollItems = menuItems.map(function () {
                var href = jQuery(this).attr("href"),
                    id = href.substring(href.indexOf('#')),
                    item = jQuery(id);
                //console.log(item)
                if (item.length) {
                    return item;
                }
            });

        // Bind to scroll
        jQuery(window).scroll(function () {
            // Get container scroll position
            var fromTop = jQuery(this).scrollTop() + topMenuHeight;

            // Get id of current scroll item
            var cur = scrollItems.map(function () {
                if (jQuery(this).offset().top < fromTop)
                    return this;
            });

            // Get the id of the current element
            cur = cur[cur.length - 1];
            var id = cur && cur.length ? cur[0].id : "";

            menuItems.parent().removeClass("activee");
            if (id) {
                menuItems.parent().end().filter("[href*='#" + id + "']").parent().addClass("activee");
            }

        })
    })
</script>