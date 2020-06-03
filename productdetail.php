<? include('assets/include/header.php'); ?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
<?php 
    $product = "";
    if(isset($_GET["id"])){
        $parameters = array(":partnerId" =>$partnerId, ":id"=>$_GET["id"]);
        $query      = "SELECT * FROM `products` WHERE `id`=:id AND `partnerId`=:partnerId";
        $query      = $dbhconnection->prepare($query);
        $query->execute($parameters);
        $products	= $query->fetchAll();
        $product    = $products[0];

        echo "<pre>".print_r($product,true)."</pre>";
    }else{
        header("location:menu.php");
    }
?>
<main class="main">
    <div class="container-fluid">
        <div class="container-box">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-single-container product-single-default">
                        <div class="row">
                            <div class="col-lg-1 col-md-1"></div>
                            <div class="col-lg-4 col-md-4 product-single-gallery">
                                <div class="product-item" style="margin-top: 18px;">
                                    <div class="product-single-carousel owl-carousel owl-theme">
                                        <div class="product-item" style="border: 1px solid #6eb64c;margin-right: 1%;z-index: 999999;">
                                            <img class="product-single-image" id="primaryImage"
                                                src="<?=$baselyneproductimagepath?>/products/<?=$product["image"]?>"
                                                  />
                                        </div>
                                    </div>
                                    <!-- End .product-single-carousel -->
                                    <span class="prod-full-screen">
                                        <i class="icon-plus"></i>
                                    </span>
                                </div>
                            </div><!-- End .col-lg-7 -->

                            <div class="col-lg-6 col-md-6">
                                <div class="product-single-details">
                                    <h1 class="product-title"><?=$product["name"]?></h1>
                                    <div class="price-box">
                                        <span class="product-price">Rs <?=$product["price"]?>/-</span>
                                    </div>
                                    <div class="product-desc">
                                        <p><?=$product["description"]?></p>
                                    </div>
                                    <div class="product-filters-container" style="margin-bottom: 1.5rem;">
                                        <div class="product-single-filter">
                                            <? 
                                                $parameters     = array(
                                                                    ":partnerId"    =>$partnerId,
                                                                    ":productId"    =>$_GET["id"],
                                                                    ":groupheading" =>"Make it a Meal",
                                                                );
                                                $query          = $dbhconnection->prepare(" SELECT c.productIds as productId
                                                                                                FROM `productorderinggroup` p 
                                                                                                JOIN `customizegroupdetails` c ON p.groupId = c.id 
                                                                                                WHERE c.partnerId = :partnerId AND p.`productId` = :productId AND p.groupheading=:groupheading ");
                                                $query->execute($parameters);
                                                $makeItMealId     = $query->fetchAll();
                                                $makeItMealId     = $makeItMealId[0]["productId"];
                                            ?>
                                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="width: 100%;">
                                                <div class="makeitmealdiv">
                                                    <?
                                                        $parameters     = array(":id"=>$makeItMealId);
                                                        $query          = $dbhconnection->prepare("SELECT * FROM `products` WHERE `id`=:id");
                                                        $query->execute($parameters);
                                                        $custom         = $query->fetchAll();
                                                        $custom         = $custom[0];
                                                    ?>
                                                    <label class="makeitmeal-cluckys"><?=$custom["name"]?>
                                                        <input type="checkbox" id="checkbox1" 
                                                            data-id="<?=$custom["id"]?>" 
                                                            data-name="<?=$custom["name"]?>" 
                                                            data-price="<?=$custom["price"]?>"
                                                            data-qty="1">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <span class="makeitmeal-price">Price Include Rs.<?=$custom["price"]?>/-</span>
                                                </div>
                                                
                                                <div id="makeItMealPanel" style="display:none">
                                                    <?
                                                        $parameters     = array(":productId"=>$makeItMealId, ":partnerId"=>$partnerId);
                                                        $query          = "SELECT
                                                                                c.id as 'groupId',
                                                                                p.grouptype,
                                                                                p.groupheading,
                                                                                c.productIds
                                                                            FROM
                                                                                `productorderinggroup` p
                                                                            JOIN `customizegroupdetails` c ON p.groupId = c.id
                                                                            WHERE
                                                                                c.partnerId = :partnerId AND p.`productId` = :productId";
                                                        $query          = $dbhconnection->prepare($query);
                                                        $query->execute($parameters);
                                                        $makeItMealProducts         = $query->fetchAll();
                                                        foreach ($makeItMealProducts as $makeItMealProduct) {
                                                        
                                                    ?>
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" role="tab" id="heading<?= $makeItMealProduct["groupId"]  ?>">
                                                            <h4 class="panel-title">
                                                                <a role="button" data-toggle="collapse"
                                                                    data-parent="#accordion" href="#collapse<?= $makeItMealProduct["groupId"]  ?>"
                                                                    aria-expanded="true" aria-controls="collapse<?= $makeItMealProduct["groupId"]  ?>">
                                                                    Select <?=$makeItMealProduct["groupheading"]?>
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse<?= $makeItMealProduct["groupId"]  ?>" class="panel-collapse collapse in"
                                                            role="tabpanel" aria-labelledby="heading<?= $makeItMealProduct["groupId"]  ?>">
                                                            <div class="panel-body">
                                                                <?
                                                                    $parameters     = array();
                                                                    $query          = $dbhconnection->prepare("SELECT * FROM `products` WHERE `id` in (".$makeItMealProduct["productIds"].")  ORDER BY `price` ASC");
                                                                    $query->execute($parameters);
                                                                    $products        = $query->fetchAll();
                                                                    foreach ($products as  $prod) {
                                                                        ?>
                                                                        <div class="row">
                                                                            <label class="checkbox-cluckys"><?=$prod["name"]?>
                                                                                <input type="radio" class="<?=strtolower($makeItMealProduct["groupheading"])?>" name="<?=strtolower($makeItMealProduct["groupheading"])?>" 
                                                                                        data-id="<?=$prod["id"]?>" 
                                                                                        data-name="<?=$prod["name"]?>" 
                                                                                        data-price=""
                                                                                        data-qty="1"
                                                                                        <?=count($products)==1?"checked":""?>
                                                                                        ><!-- <?=$prod["price"]?> -->
                                                                                <span class="checkmark"></span>
                                                                            </label>
                                                                        </div>
                                                                        <?
                                                                    }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?  }?>
                                                </div>
                                                <? 
                                                    $parameters     = array(
                                                                        ":partnerId"    =>$partnerId,
                                                                        ":productId"    =>$_GET["id"],
                                                                        ":groupheading" =>"Addons",
                                                                    );
                                                    $query          = $dbhconnection->prepare(" SELECT c.productIds as productId
                                                                                                    FROM `productorderinggroup` p 
                                                                                                    JOIN `customizegroupdetails` c ON p.groupId = c.id 
                                                                                                    WHERE c.partnerId = :partnerId AND p.`productId` = :productId AND p.groupheading=:groupheading ");
                                                    $query->execute($parameters);
                                                    $addons     = $query->fetchAll();
                                                    $addonIds     = $addons[0]["productId"];
                                                ?>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" role="tab" id="headingThree">
                                                        <h4 class="panel-title" style="margin-top: 2.5%;">
                                                            <a class="collapsed" role="button" data-toggle="collapse"
                                                                data-parent="#accordion" href="#collapseThree"
                                                                aria-expanded="false" aria-controls="collapseThree">
                                                                Add Ons
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseThree" class="panel-collapse collapse"
                                                        role="tabpanel" aria-labelledby="headingThree">
                                                        <div class="panel-body"> 
                                                            <?
                                                                $parameters     = array();
                                                                $query          = $dbhconnection->prepare("SELECT * FROM `products` WHERE `id` in ($addonIds) ORDER BY `price` ASC");
                                                                $query->execute($parameters);
                                                                $addons         = $query->fetchAll();
                                                                foreach ($addons as  $addon) {
                                                                    ?>                                                     
                                                                    <div class="row">
                                                                        <label class="checkbox-cluckys"><?=$addon["name"]?>
                                                                            <input type="checkbox" class="addons" name="addons[]" 
                                                                                    data-id="<?=$addon["id"]?>" 
                                                                                    data-name="<?=$addon["name"]?>" 
                                                                                    data-price="<?=$addon["price"]?>"
                                                                                    data-qty="1"
                                                                                    >
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                        <!-- <div class="addOnsQtySection qty" style="display:none">
                                                                            <span class="minus bg-dark">
                                                                                <i class="fa fa-minus"></i>
                                                                            </span>
                                                                            <input type="number" class="count" name="qty" value="1" data-price="<?=$addon["price"]?>">
                                                                            <span class="plus bg-dark">
                                                                                <i class="fa fa-plus"></i>
                                                                            </span>
                                                                        </div> -->
                                                                        <span class="price-span">Rs.<?=$addon["price"]?>/-</span>
                                                                    </div>
                                                                    <?
                                                                }      
                                                            ?> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- End .product-single-filter -->
                                    </div><!-- End .product-filters-container -->

                                    <div class="product-action product-all-icons">
                                        <div class="product-single-qty">
                                            <input class="horizontal-quantity form-control" type="text"
                                                style="width: 60px;" readonly>
                                        </div><!-- End .product-single-qty -->

                                        <a class="paction add-cart btn_addtocart" title="Add to Cart"
                                            data-id="<?= $product["id"] ?>"
                                            data-qty="1"
                                            data-type="basic"
                                            data-name="<?= $product["name"] ?>" 
                                            data-price="<?= $product["price"] ?>"
                                            data-image="<?=$product["image"]?>" style="width: 65%;">
                                            <span>Add to Cart</span>
                                        </a>


                                    </div><!-- End .product-action -->

                                    <!-- End .product single-share -->
                                </div><!-- End .product-single-details -->
                            </div><!-- End .col-lg-5 -->
                        </div><!-- End .row -->
                    </div><!-- End .product-single-container -->


                </div><!-- End .col-lg-9 -->


            </div><!-- End .row -->


        </div><!-- End .container-box -->
    </div><!-- End .container -->

</main><!-- End .main -->

<? include('assets/include/footer.php'); ?>
<script>
        var addOnsprice = 0; 
        var customPrice = 0
    function calculation() {
        qty     = parseInt($(".horizontal-quantity").val());
        price   = parseFloat($(".btn_addtocart").data("price"));
        final   = (addOnsprice+customPrice+price)*qty;

        $(".btn_addtocart").data("customPrice", final);
        $(".product-price").empty().text("Rs. "+final+"/-");
    }
    $(document).ready(function () {
        $('.count').prop('disabled', true);
        $(document).on('click', '.btn-up-icon', function () {
            $('.count').val(parseInt($('.count').val()) + 1);
            $(".btn_addtocart").data("qty", $('.count').val());
            calculation()
        });
        $(document).on('click', '.btn-down-icon', function () {
            $('.count').val(parseInt($('.count').val()) - 1);
            if ($('.count').val() == 0) {
                $('.count').val(1);
            }
            $(".btn_addtocart").data("qty", $('.count').val());
            calculation()
        });
        $('#checkbox1').change(function () {
            var includePrice = parseFloat($(this).data("price"));
            if (this.checked){
                customPrice = includePrice;
                $(".btn_addtocart").data("type","customize");
                $('#makeItMealPanel').fadeIn('slow');
            }else{
                customPrice = 0;
                $(".btn_addtocart").data("type","basic");
                $('#makeItMealPanel').fadeOut('slow');
                $('#drinksPanel').fadeOut('slow');
                $("#makeItMealPanel input[type='radio'], #drinksPanel input[type='radio']").prop('checked', false);
            }
            calculation();
        });
        $(".makeItMeal").change(function () {
            var _this   = $(this);
            var include = _this.data("include"); 
            if(include==="withDrink&Fries" || include==="withDrink"){
                $("#drinksPanel").fadeIn();
            }else{
                $("#drinksPanel").fadeOut();
            }
        });
        $(".addons").change(function () {
            _this   = $(this);
            if (this.checked){
                addOnsprice += parseFloat(_this.data("price"));
            }else{
                addOnsprice -= parseFloat(_this.data("price"));
            }
            calculation();
        });
        $(".btn_addtocart").click(function (e) {
            e.preventDefault();
            var _this           = $(this);
            var productid       = _this.data("id");
            var productname     = _this.data("name");
            var productprice    = _this.data("price");
            var productimage    = _this.data("image");
            var productqty      = $(".horizontal-quantity").val();
            var type            = _this.data("type");
            var addonStatus     = "no"
            var addons          = [];
            var drinks          = [];
            var fries           = [];
            var data            = [];
            var makeItMealArr   = [];
            $(".addons").each(function () {
                if($(this).prop("checked") == true){
                    addonStatus = "yes"
                    addons.push({
                        "id":     $(this).data("id"),
                        "name":   $(this).data("name"),
                        "price":  $(this).data("price")
                    });
                }
            });
            if(type === "customize"){
                if($("#checkbox1").prop("checked") == true){
                    if($('.panel input[type=radio]').is(':checked')) { //&& $('.drink').is(':checked') 
                        $(".panel input[type=radio]").each(function () {
                            if($(this).is(':checked')){
                                makeItMealArr.push({
                                    "id"      : $(this).data("id"),
                                    "name"    : $(this).data("name")
                                });
                            }
                        });
                        addons.push({
                            "id":    $("#checkbox1").data("id"),
                            "name":  $("#checkbox1").data("name"),
                            "price": $("#checkbox1").data("price"),
                            "img":  "",
                            "addons": makeItMealArr
                        });
                        data = {
                            "type": type,     
                            "productid":    productid,
                            "productname":  productname,
                            "productprice": productprice,
                            "productimage": productimage,
                            "productqty": productqty,
                            "addons" : addons
                                              
                        }
                    }else{
                        alert("Select Fries & Cold Drinks");
                    }
                }
            }else{
                data = {
                    "type": addonStatus=="yes"?"customize":"basic",     
                    "productid": productid,
                    "productname": productname,
                    "productprice": productprice,
                    "productimage": productimage,
                    "productqty": productqty,
                    "addons" : addons,
                }
            }
            
            if (data!=[]) {
                $.ajax({
                    type: "POST",
                    url: "ajax/addtocart.php",
                    data: data,
                    beforeSend: function () {},
                    success: function (data) {
                        data = JSON.parse(data);
                        console.log(data);
                        $.notify("Product SuccessFully added", 'success');
                        $(".cart-count").empty().append(data["totalcount"]);
                        cartItems = data["cartitems"];
                    }
                });
            }
        });
    });
</script>