<?php 
    
    $pagetitle="Cart";
    require('assets/include/functions.php');
    include('assets/include/header.php');
    
    if(count($_SESSION["ordereditems"])==0){
        header("location: /shop");
    }    
?>

<main class="main">
    <div class="container-fluid">
        <div class="container-box">
            <?php
                $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            ?>
            <form action="<?= $protocol.$_SERVER['HTTP_HOST']; ?>/exce-checkout.php" method="POST" id="orderInfoForm">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="cart-table-container">
                            <table class="table table-cart">
                                <thead>
                                    <tr>
                                        <th class="product-col">Product</th>
                                        <th class="price-col">Price</th>
                                        <th class="qty-col">Qty</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <? 
                                        $subtotal   = 0;
                                        $tax        = 0;
                                    foreach ($_SESSION["ordereditems"] as $cartId => $cartItem) {
                                        $subtotal += $cartItem["price"]*$cartItem["qty"];
                                        ?>  
                                    <tr class="product-row" data-cartid="<?=$cartId?>">

                                        <td class="product-col">
                                            <input type="hidden" name="prodId[]" value="<?=$cartItem["prodId"]?>">
                                            <input type="hidden" name="price[]" value="<?=$cartItem["price"]?>">
                                            <figure class="product-image-container">
                                                <a href="product.html" class="product-image">
                                                    <img src="<?=$baselyneproductimagepath?>/products/<?=$cartItem["image"]?>" alt="product">
                                                </a>
                                            </figure>
                                            <h2 class="product-title" style="margin-top: 0;">
                                                <?
                                                    if($cartItem["type"]=="customize") { 
                                                    $str = "";
                                                    if(count($cartItem["addons"])!=0){
                                                        foreach ($cartItem["addons"] as $addons) {
                                                            if(isset($addons["addons"])){
                                                                foreach ($addons["addons"] as $add) {
                                                                    $str .= " *".$add["name"];					
                                                                }
                                                            }else{
                                                                $str .= " *".$addons["name"];
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    <a data-toggle="popover" title="Product Detail" data-content="With<?=$str?>" href="javascript:void(0)"><?=$cartItem["name"]?></a>
                                                <?}else{?>
                                                    <?=$cartItem["name"]?>
                                                <?}?>
                                            </h2>
                                        </td>
                                        <td class="price">Rs. <?=$cartItem["price"]?>/-</td>
                                        <td class="qty">
                                            <input readonly name="qty[]" class="vertical-quantity form-control" type="text" value="<?=$cartItem["qty"]?>">
                                        </td>
                                        <td class="total">Rs. <?=$cartItem["price"]*$cartItem["qty"]?>/-</td>
                                         <td class="clearfix caneloncart">
                                            <div class="float-right canelbtn-cart">
                                                <a href="#" title="Remove product" class="btn-remove clearCartRowBtn" data-cartid="<?=$cartId?>"><span class="sr-only">Remove</span></a>
                                            </div><!-- End .float-right -->
                                        </td>
                                    </tr>

                                        <?php 
                                    }   ?>
                                   
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="clearfix">
                                            <div class="float-left">
                                                <a href="/menu" class="btn btn-outline-secondary">Continue Shopping</a>
                                            </div><!-- End .float-left -->
                                            <div class="float-right">
                                                <a href="#" id="clearCartBtn" class="btn btn-outline-secondary btn-clear-cart">Clear Shopping Cart</a>
                                                <!-- <a href="#" class="btn btn-outline-secondary btn-update-cart">Update
                                                    Shopping Cart</a> -->
                                            </div><!-- End .float-right -->
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="cart-summary">
                            <h3>Delivery Info</h3>
                            <h4>
                                <a data-toggle="collapse" href="#total-estimate-section" class="" role="button"
                                    aria-expanded="true" aria-controls="total-estimate-section">Delivery Details</a>
                            </h4>
                            <div class="collapse show" id="total-estimate-section">
                                <div class="form-group form-group-sm">
                                    <label>Full Name</label>
                                    <input type="text" name="name" class="form-control form-control-sm" required>
                                </div>
                                <div class="form-group form-group-sm">
                                    <label>Contact No.</label>
                                    <input type="text" name="contactNo" class="form-control form-control-sm" required>
                                </div>
                                <div class="form-group form-group-sm">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control form-control-sm" required>
                                </div>
                                <?php
                                    include './assets/include/cart_city.php';
                               ?>
                                <div class="form-group form-group-sm">
                                    <label>Address</label>
                                    <textarea  name="address" class="form-control form-control-sm" required></textarea>
                                </div>
                                <div class="form-group form-group-sm">
                                    <label>Additional Requirement</label>
                                    <textarea  name="additionalRequirement" class="form-control form-control-sm"></textarea>
                                </div>
                                <div class="form-group form-group-sm">
                                    <label>Payment Method</label><br/>
                                    <input type="radio" name="paymentMethod" class="" value="Cash" required checked style="width: auto;"> Cash On Delivery<br/>
                                    <input type="radio" name="paymentMethod" class="" value="Online" style="width: auto;" required> Online
                                </div>
                            </div>
                            <? 
                                $beforeTotal=$subtotal;
                                $tax=0;
                                $deliverycharges=200;
                                //$beforeTotal    = round($subtotal/((13/100)+1),2);
                                //$tax            = $subtotal-$beforeTotal;
                            ?>
                            <table class="table table-totals">
                                <tbody>
                                    <tr>
                                        <td>Subtotal</td>
                                        <td class="">Rs <span class="subTotal"><?=$beforeTotal?></span>/- <input class="subTotal" type="hidden" name="subtotal" value="<?=$beforeTotal?>"></td>
                                    </tr>

                                    <? /*

                                    <tr>
                                        <td>Tax(13%)</td>
                                        <td class="">Rs <span class="taxAmount"><?=$tax?></span>/-  <input class="taxAmount" type="hidden" name="tax" value="<?=$tax?>"></td>
                                    </tr>

                                    */ ?>
                                    <tr>
                                        <td>Delivery Charges</td>
                                        <td class="">Rs <span class="deliveryCharges"><?=$deliverycharges;?></span>/-  <input class="deliveryChargesInput" type="hidden" name="deliveryCharges" value="<?=$deliverycharges;?>"></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Order Total</td>
                                        <td>Rs <span class="totalAmount"><?=$beforeTotal+$tax+$deliverycharges;?></span>/-  <input class="totalAmount" type="hidden" name="total" value="<?=$beforeTotal+$tax+$deliverycharges;?>"></td>
                                    </tr>
                                </tfoot>
                            </table>

                            <div class="checkout-methods">
                                <div id="loadingDiv" style="display: none">Submitting Your Order...!</div>
                                <button type="submit" class="btn btn-block btn-sm btn-primary" name="submitBtn" onClick="return empty()" >Go to Checkout</button>
                            </div><!-- End .checkout-methods -->
                        </div><!-- End .cart-summary -->
                    </div><!-- End .col-lg-4 -->
                </div><!-- End .row -->
            </form>
        </div><!-- End .container-box -->
    </div><!-- End .container -->
</main><!-- End .main -->
<script>
    function empty() {
        var x;
        x = document.getElementsByName("address").value;
        if (x == "") {
            alert("Enter Your Address");
            return false;
        };
    }
</script>
<?php include('assets/include/footer.php')?>
<script>
    $(document).ready(function () {
        $("button[name='submitBtn']").click(function () {
            if( $("input[name='name']").val() != "" && 
                $("input[name='contactNo']").val() != "" && 
                $("input[name='email']").val() != "" && 
                $("input[name='address']").val() != ""  ){
                $(this).hide();
                $("#loadingDiv").show();
            }
        });
        $("#clearCartBtn").click(function () {
            $.ajax({
                type: "POST",
                url: "/addtocart",
                data: {
                    "clearCart": 1
                },
                success: function () {
                    location.reload();
                }
            });
        });
        $(".clearCartRowBtn").click(function () {
            _this = $(this);
            _this.closest("tr").remove();
            calculation();
            $.ajax({
                type: "POST",
                url: "/addtocart",
                data: {
                    "removeProductId": _this.data("cartid")
                },
                success: function (data) {
                    data        = JSON.parse(data)
                    cartItems   = data["cartitems"];
                    if(data["totalcount"]==0){
                        location.reload();
                    }
                }
            });
        });
    });
</script>
<script src="/assets/js/jquery.validate.min.js"></script>
<script src="/assets/js/validate.js"></script>
<?php cartCityAjax(); ?>