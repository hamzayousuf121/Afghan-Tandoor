<? include('assets/include/header.php'); ?>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">

<main class="main">
    <div class="container-fluid">
        <div class="container-box">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-single-container product-single-default">
                        <div class="row">
                            <div class="col-lg-1 col-md-1"></div>
                            <div class="col-lg-4 col-md-4 product-single-gallery">
                                <div class=" product-item" style="margin-top: 18px;">
                                    <div class="product-single-carousel owl-carousel owl-theme">
                                        <div class="product-item" style="    border: 1px solid #6eb64c;margin-right: 1%;z-index: 999999;">
                                            <img class="product-single-image"
                                                src="<?=$baselyneproductimagepath?>/products/<?=$product["image"]?>"/>
                                                <!--  data-zoom-image="<?=$baselyneproductimagepath?>/products/<?=$product["image"]?>"  -->
                                        </div>
                                    </div>
                                    <!-- End .product-single-carousel -->
                                    <!-- <span class="prod-full-screen">
                                        <i class="icon-plus"></i>
                                    </span> -->
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="product-single-details">
                                    <h1 class="product-title"><?=$product["name"]?>   &nbsp;&nbsp;&nbsp;(<?=$product["rtlname"]?>)</h1>

                                    <div class="price-box">
                                        <span class="product-price">Rs <?=$product["price"]?>/-</span>
                                    </div>
                                    <div class="product-desc">
                                         <p class="text-right" lang="ur" style="    font-size: 1.8rem;">
                                             <? echo str_replace("\n","<br />",$product["rtldescription"]);
                                             ?>
                                        </p>

                                        <p class="text-left" lang="en" style="    font-size: 1.8rem;">
                                             <? echo str_replace("\n","<br />",$product["description"]);
                                             ?>
                                        </p>
                                    </div>
                                   <?/* <div class="product-filters-container" style="margin-bottom: 1.5rem;">
                                        <div class="product-single-filter">
                                            <? 
                                                $parameters     = array(
                                                                    ":partnerId"    =>$partnerId,
                                                                    ":productId"    =>$_GET["productId"],
                                                                    ":groupheading" =>"Make it a Meal",
                                                                );
                                                $query          = $dbhconnection->prepare(" SELECT c.productIds as productId
                                                                                            FROM `productorderinggroup` p 
                                                                                            JOIN `customizegroupdetails` c ON p.groupId = c.id 
                                                                                            WHERE c.partnerId = :partnerId AND p.`productId` = :productId AND p.groupheading=:groupheading ");
                                                $query->execute($parameters);
                                                $makeItMealId     = $query->fetchAll();
                                                
                                            ?>
                                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="width: 100%;">
                                                <?
                                                if(count($makeItMealId)==1){
                                                    $makeItMealId     = $makeItMealId[0]["productId"]; ?>
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
                                                                                p.`productId` = :productId AND c.partnerId = :partnerId";
                                                        $query          = $dbhconnection->prepare($query);
                                                        $query->execute($parameters);
                                                        $makeItMealProducts         = $query->fetchAll();
                                                        foreach ($makeItMealProducts as $makeItMealProduct) {
                                                        
                                                    ?>
                                                    <div class="panel panel-default makeItMealPanel">
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
                                                                                <input type="radio" class="<?=strtolower($makeItMealProduct["groupheading"])?> addons makeItMealItem" name="<?=strtolower($makeItMealProduct["groupheading"])?>" 
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
                                                }
                                                    $parameters     = array(
                                                                        ":partnerId"    =>7,
                                                                        ":productId"    =>$_GET["productId"]
                                                                    );
                                                    $query          = $dbhconnection->prepare(" SELECT c.productIds as 'productId',
                                                                                                    p.groupheading AS 'groupheading',
                                                                                                    p.ispaid AS 'ispaid',
                                                                                                    p.min AS 'min',
                                                                                                    p.max AS 'max'
                                                                                                    FROM `productorderinggroup` p 
                                                                                                    JOIN `customizegroupdetails` c ON p.groupId = c.id 
                                                                                                    WHERE c.partnerId = :partnerId AND p.`productId` = :productId AND p.groupheading != 'Make it a Meal' 
                                                                                                    ORDER BY p.sno ASC");
                                                    $query->execute($parameters);
                                                    $addons         = $query->fetchAll();
                                                    $i = 1;                                                   
                                                    foreach ($addons as  $addon) {
                                                        $addonIds       = $addon["productId"]; 
                                                        ?>
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" role="tab" id="heading<?=$i?>">
                                                            <h4 class="panel-title" style="margin-top: 2.5%;">
                                                                <a class="collapsed" role="button" data-toggle="collapse"
                                                                    data-parent="#accordion" href="#collapse<?=$i?>"
                                                                    aria-expanded="false" aria-controls="collapse<?=$i?>">
                                                                    <?= $addon["groupheading"] ?>
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse<?=$i?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?=$i?>">
                                                            <div class="panel-body"> 
                                                                <?
                                                                    $parameters     = array();
                                                                    $query          = $dbhconnection->prepare("SELECT * FROM `products` WHERE `id` in ($addonIds) ORDER BY `price` ASC");
                                                                    $query->execute($parameters);
                                                                    $addonsProducts         = $query->fetchAll();
                                                                    $count          = count($addonsProducts); 
                                                                    foreach ($addonsProducts as  $addonsProduct) {
                                                                        if($addon["min"]==1 && $addon["max"]==1){
                                                                            $type = "radio";
                                                                        }elseif($addon["min"]==0 && $addon["max"]==1){
                                                                            $type = "checkbox";
                                                                        }else{

                                                                        }
                                                                        if($addon["ispaid"]==0){
                                                                            $addonsProduct["price"] = 0;
                                                                        }
                                                                        ?>                                                     
                                                                        <div class="row">
                                                                            <label class="checkbox-cluckys"><?=$addonsProduct["name"]?>
                                                                                <input type="<?=$type?>" class="addons" name="addons<?=$i?>[]" 
                                                                                        data-id="<?=$addonsProduct["id"]?>" 
                                                                                        data-name="<?=$addonsProduct["name"]?>" 
                                                                                        data-price="<?=$addonsProduct["price"]?>"
                                                                                        data-limit="<?=$addon["min"].",".$addon["max"]?>"
                                                                                        data-qty="1"
                                                                                        data-required="<?=$addon["min"]>0?"true":"false"?>"
                                                                                        <?=$count==1 && $addon["min"]==1?"checked":"";?>
                                                                                        >
                                                                                <span class="checkmark"></span>
                                                                            </label>
                                                                            <span class="price-span">Rs. <?=$addonsProduct["price"]?>/-</span>
                                                                        </div>
                                                                        <?
                                                                    }
                                                                ?> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <?
                                                        $i++;
                                                    }
                                                ?>
                                            </div>
                                        </div><!-- End .product-single-filter -->
                                    </div>*/?><!-- End .product-filters-container -->

                                    <div class="product-action product-all-icons">
                                        <div class="product-single-qty">
                                            <input class="horizontal-quantity form-control" type="text"
                                                style="width: 60px;" readonly>
                                        </div><!-- End .product-single-qty -->

                                        <a class="paction add-cart btn_addtocart" title="Add to Cart"
                                            data-id="<?= $product["id"] ?>"
                                            data-qty="1"
                                            data-type="<?= $product["type"]?>"
                                            data-name="<?= $product["name"] ?>" 
                                            data-price="<?= $product["price"] ?>"
                                            data-categoryId="<?= $product["maincategoryId"] ?>"
                                            data-addonscount="<?= $i ?>"
                                            data-image="<?=$product["image"]?>" style="width: 65%;">
                                            <span>Add to Cart</span>
                                        </a>


                                    </div><!-- End .product-action -->

                                    <!-- End .product single-share -->
                                </div><!-- End .product-single-details -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<? include('assets/include/footer.php'); ?>
<script>
        var addOnsprice = 0;
        var customPrice = 0;
        var addonsArr   = {};
        var makeitmeal  = {};
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
                makeitmeal
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
            key     = "";
            if (this.checked){
                key          = _this.attr("name").replace("[]", "");
                if(_this.attr("type")=="radio" && addonsArr[key]==undefined){
                    addonsArr[key]  = parseFloat(_this.data("price"));
                }else if(_this.attr("type")=="radio"  && addonsArr[key]!=undefined){
                    addOnsprice     -= addonsArr[key];
                    addonsArr[key]  -= addonsArr[key];
                    addOnsprice     += parseFloat(_this.data("price"));
                    addonsArr[key]  = parseFloat(_this.data("price"));
                }
                if(_this.attr("type")=="checkbox"){
                    limit           = $("input[name='"+key+"[]']").data("limit").split(",")
                    checkboxLength  = $("input[name='"+key+"[]']:checked").length
                    if(checkboxLength>=limit[0] && checkboxLength<=limit[1]){
                        addOnsprice     += parseFloat(_this.data("price"));
                    }else{
                        $("input[name='"+key+"[]']:checkbox").each(function () {
                            addOnsprice -= parseFloat($(this).data("price")); 
                        })
                        $("input[name='"+key+"[]']:checkbox").removeAttr('checked');
                    }
                }
            }else{
                addOnsprice     -= parseFloat(_this.data("price"));
            }
            calculation();
        });
        $(".btn_addtocart").click(function (e) {
            e.preventDefault();
            var _this               = $(this);
            var productid           = _this.data("id");
            var productname         = _this.data("name");
            var productprice        = _this.data("price");
            var productimage        = _this.data("image");
            var productCategoryId   = _this.data("categoryid");
            var productqty          = $(".horizontal-quantity").val();
            var type                = _this.data("type");
            var addonStatus         = ""
            var addons              = [];
            var drinks              = [];
            var fries               = [];
            var data                = [];
            var makeItMealArr       = [];
            var inputNameArr        = [];
            var arr                 = [];
            var addonsCount         = _this.data("addonscount");
            for (var i = 1; i < addonsCount; i++) {
                $("input[name='addons"+i+"[]']").each(function () {
                    if($("input[name='addons"+i+"[]']").data("required")==true && $(this).prop("checked")){
                        addonStatus="yes";
                        addons.push({
                            "id":     $("input[name='addons"+i+"[]']:checked").data("id"),
                            "name":   $("input[name='addons"+i+"[]']:checked").data("name"),
                            "price":  $("input[name='addons"+i+"[]']:checked").data("price")
                        });
                        return false;
                    }else if($("input[name='addons"+i+"[]']").data("required")==true && !$(this).prop("checked")){                        
                        addonStatus="no";
                    } 
                    if($("input[name='addons"+i+"[]']").data("required")==false && $(this).prop("checked")){
                        addons.push({
                            "id":     $("input[name='addons"+i+"[]']:checked").data("id"),
                            "name":   $("input[name='addons"+i+"[]']:checked").data("name"),
                            "price":  $("input[name='addons"+i+"[]']:checked").data("price")
                        });
                        return false;
                    }
                });
            }

            console.log([addonStatus,productCategoryId]);
            console.log([addonStatus,type]);
            if(productCategoryId != "167" && type === "customize"){
                if($("#checkbox1").prop("checked") == true){
                    $(".makeItMealPanel input[type=radio]").each(function () {
                        makeItMealClassName = $(this).attr("class").replace(" addons", "").replace(" makeItMealItem", "");
                        if(!arr.includes(makeItMealClassName)){
                            arr.push(makeItMealClassName);
                            if($('input.'+makeItMealClassName).is(':checked')){
                                addonStatus = "yes";
                                makeItMealArr.push({
                                    "id"      : $('input.'+makeItMealClassName+':checked').data("id"),
                                    "name"    : $('input.'+makeItMealClassName+':checked').data("name")
                                });
                            }else{
                                addonStatus = "no";
                            }
                        }
                    });
                    if(addonStatus !== "no"){
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
                    }
                }else{
                    addonStatus = addonStatus==""?"yes":addonStatus,
                    data = {
                        "type": addonStatus=="yes"?"customize":"basic",     
                        "productid":    productid,
                        "productname":  productname,
                        "productprice": productprice,
                        "productimage": productimage,
                        "productqty": productqty,
                        "addons" : addons
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
                    "addons" : addonStatus=="yes"?addons:"",
                }
            }
            console.log("**/****/**");
            console.log([addonStatus,productCategoryId]);
            console.log([addonStatus,type]);
            if(productCategoryId == "167" && addonStatus=="no"){
                data=[];
            }else if(addonStatus=="no" && type === "customize"){
                data=[];
            }
            if (data.length != 0) { //typeof data.length != "undefined" && 
                $.ajax({
                    type: "POST",
                    url: "/addtocart.php",
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
            }else{
                alert("Select All Choices");
            }
        });
    });
</script>