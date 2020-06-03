<?
$pagetitle="Menu";
include('assets/include/header.php');
$p=[":partnerId" => $partnerId, ":hide" => 0];
$q="select * from maincategories where partnerId= :partnerId and hide=:hide";
$e=$dbhconnection->prepare($q);
$e->execute($p);
$categories = $e->fetchAll(PDO::FETCH_ASSOC);

$p=[":partnerId" => $partnerId, ":hide" => 0, ":status" => 1];
$q="select record.*, m.name from maincategories m, (select * from products where partnerId=:partnerId and hide=:hide and status=:status order by maincategoryId asc) as record where record.maincategoryId=m.id order by m.sortby asc";
//$e=$dbhconnection->prepare($q);
// $e->execute($p);
// $productsdatafetch=$e->fetchAll(PDO::FETCH_ASSOC);
$query      = $dbhconnection->prepare($query);
$query->execute($parameters);
$products   = $query->fetchAll();
?>
<style>
html {
scroll-behavior: smooth;
}
.sticky {
position: sticky;
position: -webkit-sticky;
top: 60px;
}
#navbar-example2 nav a {
background-color: #e2e2e2;
color: #000;
font-weight: 600;
border-bottom: 2px solid #e2e2e2;
transition: .3s ease-in-out;
}
#navbar-example2 nav a:hover {
background-color: #df1f26;
color: black;
font-weight: 600;
border-bottom: 2px solid #469e48;
transition: .3s ease-in-out;
}
.active {
/*background-color: #ffd101;*/
color: black;
font-weight: 600;
/*border-bottom: 2px solid #5d1029;*/
transition: .3s ease-in-out;
}
.sec {
margin-top: 40px;
margin-bottom: 40px;
height: 100px;
padding: 40px;
}
.cat-head {

padding: 15px;
font-size: 2.2rem;
border-radius: 4px;
border-left: 5px solid #df1f26;
}
</style>
<!-- <div class="container-fluid">
    <div class="container-box">
        <div class="row">
            <div class="" style="background-image: url('');">
                <img src="assets/images/sl1.jpg" class="img-fluid">
                </div> --><!-- End .banner -->
          <!--   </div>
        </div>
</div> -->
    <div class="container-fluid">
        <div class="container-box">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <nav id="navbar-example2" class="navbar-light sticky">
                        <nav class="nav nav-pills flex-column navigation" id="menu">
                            
                            <?php
                            foreach($categories as $category){
                            ?>
                            
                            <a class="nav-link cliked" href="#category-<?=$category["id"]?>"><?= $category["name"] ?></a>
                            <?php
                            }
                            ?>
                            <!-- <a class="nav-link" href="#cluckychicken">Clucky Chicken</a>
                            <a class="nav-link" href="#cluckysandwiches">Clucky Sandwiches</a>
                            <a class="nav-link" href="#pecks&sides">Pecks & Sides</a> -->
                            
                        </nav>
                    </nav>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <div data-target="#navbar-example2" data-offset="0">
                        <?php
                        $i=0;
                        foreach ($categories as $category) {
                        ?>
                        <span id="category-<?=$category["id"]?>" class="sec page-section"></span>
                        <div <?= $i!=0?'data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500"':"";?>>
                            <h4 class="cat-head col-12 col-lg-4 col-md-4 col-sm-4"><?= $category["name"] ?></h4>
                            <div class="row row-sm">
                                <?php
                                $parameters = array(":partnerId" =>$partnerId, ":maincategoryId"=>$category["id"], ":status" => 1);
                                $query      = "SELECT * FROM `products` WHERE `partnerId`= :partnerId AND `maincategoryId`=:maincategoryId and status=:status";
                                $query      = $dbhconnection->prepare($query);
                                $query->execute($parameters);
                                    $products   = $query->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($products as $product) {


                                    $productnameforurl=$productname=$product["name"];
                                    $producttype=$product["type"];
                                    $productId=$product["id"];

                                    $productnameforurl=strtolower($productnameforurl);
                                    
                                    $productnameforurl=str_replace("'","-",$productnameforurl);

                                    $productnameforurl=str_replace(" ","-",$productnameforurl);


                                    
                                    $producturl=$productnameforurl."/".$productId;

                                ?>

                                <div class="col-6 col-md-3 col-xl-4col">
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
                                            <a href="<?=$producturl;?>"><?= $product["rtlname"] ?></a>
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
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                            $i++;
                            }
                            ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
        
        // animate
        $('html, body').animate({
        scrollTop: $(this.hash).offset().top - 1000
        }, 2500, function () {
        window.location.hash = hash - 1000
        });
        function onScroll(event){
        var scrollPos = $(document).scrollTop();
        $('#menu a').each(function () {
        var currLink = $(this);
        var refElement = $(currLink.attr("href"));
        if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
        $('#menu a').removeClass("liactive");
        currLink.addClass("liactive");
        }
        else{
        currLink.removeClass("liactive");
        }
        })
        }
        
        </script>
        <? include('assets/include/footer.php'); ?>