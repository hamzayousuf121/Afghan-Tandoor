<? 
    include('assets/include/settings.php');
    if(!isset($_SESSION["ordereditems"])){
        header("location:/");
    }

    //Change PartnerID and Store ID Dynamically, and set if it doesnt exists.
    if(!isset($partnerId))
    {
        $partnerId = 13;
    }

    if(!isset($partnerstoreId))
    {
        $partnerstoreId = 14;
    }

    $parameters = array(
        ':partnerId'    => $partnerId,
        ':storeId'      => $partnerstoreId,
        ':date'         => date('Y-m-d')
    );

    

   //Check if customer exists, and return tis ID
   $customerId = $customers->customerExists($parameters[':partnerId'],$parameters[':storeId'], $_POST["email"]);
   if(!$customerId)
   {
               $customerId = $customers->logCustomerInfo($parameters[':partnerId'], $parameters[':storeId'], array(
               "name" => $_POST["name"],
               "contact" => $_POST["contactNo"],
               "email" => $_POST["email"], 
               "address" => $_POST["address"],
               "area" => $_POST["area"], 
               "city" => $_POST["city"], 
               "state" => $_POST["state"], 
               "country" => $_POST["country"], 
               ));
   }

   $query      = "SELECT * FROM `orders` WHERE `partnerId`=:partnerId AND `storeId`=:storeId AND `date`=:date ORDER BY `id` DESC LIMIT 0,1";
   $query      = $dbhconnection->prepare($query);
   $query->execute($parameters);
   $data       = $query->fetchAll();
   $sNo        = $data[0]["sno"]==NULL||count($data)==0?1:($data[0]["sno"]+1);


   if(isset($_POST["submitBtn"])){
       $prodDetail = "";
       $count = count($_POST["prodId"]);
       $parameters = array(
           ":storecode"        => "A", 
           ":sno"              => $sNo, 
           ":type"             => "delivery",
           ":partnerId"        => $partnerId,
           ":storeId"          => $partnerstoreId,
           ":sourcename"       => "website" ,
           ":customername"     => base64_encode($_POST["name"]),
           ":customerId"     => $customerId,
           ":contactno"        => base64_encode($_POST["contactNo"]),
           ":email"            => base64_encode($_POST["email"]), 
           ":address"          => base64_encode($_POST["address"]), 
           ":subtotal"         => $_POST["subtotal"]+$_POST["tax"], 
           ":totalamount"      => $_POST["total"], 
           ":totalnoofitems"   => $count,
           ":paymentmethod"    => $_POST["paymentMethod"],
           ":date"             => date('Y-m-d'), 
           ":time"             => date('H:i:s'), 
           ":deliverycharges"  => $_POST["deliveryCharges"],
           ":extrarequirements"  => $_POST["additionalRequirement"],
           ":country"  => $_POST["country"],
           ":state"  => $_POST["state"],
           ":city"  => $_POST["city"],
           ":area"  => $_POST["area"]
       );

       $query      = "INSERT INTO `orders`(`storecode`,`sno`,`type`,`partnerId`,`storeId`,`customername`, `customerId`,`contactno`,`email`,`address`,`sourcename`,`subtotal`,`totalamount`,`totalnoofitems`,`paymentmethod`,`date`,`time`,`deliverycharges`,`extrarequirements`, `countryId`, `stateId`, `cityId`, `areaId`)
                           VALUES (:storecode,:sno,:type,:partnerId,:storeId,:customername,:customerId,:contactno,:email,:address,:sourcename,:subtotal,:totalamount,:totalnoofitems,:paymentmethod,:date,:time,:deliverycharges,:extrarequirements, :country, :state, :city, :area)";
       $query      = $dbhconnection->prepare($query);
       $query->execute($parameters);
       $orderId    = $dbhconnection->lastInsertId();
       $prodId     = $_POST["prodId"];
       $qty        = $_POST["qty"];

       $parameters = array(
           ":partnerId"=> $partnerId,
           ":orderId"  =>$orderId
       );
       $query      = "INSERT INTO `relationpartnerorder`(`partnerId`, `orderId`) VALUES (:partnerId,:orderId)";
       $query      = $dbhconnection->prepare($query);
       $query->execute($parameters);
      
       
       foreach ($_SESSION["ordereditems"] as $orderedItem) { 
           $parentId   = "";
           $price      = 0;
           $parameters = array(
               ":orderId"       => $orderId,
               ":productId"     => $orderedItem["prodId"],
               ":productname"   => $orderedItem["originalName"],
               ":productimage"  => $orderedItem["image"],
               ":partnerId"     => $partnerId,
               ":storeId"       => $partnerstoreId,
               ":sourcename"    => "website" ,
               ":quantity"      => $orderedItem["qty"],
               ":date"          => date('Y-m-d'),
               ":time"          => date('H:i:s'),
               ":addonsjson"    => $orderedItem["type"]=="customize"?json_encode($orderedItem["addons"]):""
           );
           $query      = "INSERT INTO `orderdetails`(`orderId`,`storeId`,`sourcename`,`productId`,`productname`,`productimage`,`partnerId`,`quantity`,`date`,`time`,`addonsjson`)
                           VALUES (:orderId,:storeId,:sourcename,:productId,:productname,:productimage,:partnerId,:quantity,:date,:time,:addonsjson)";
           $query      = $dbhconnection->prepare($query);
           $query->execute($parameters);
           $parentId    = $dbhconnection->lastInsertId();
           $prodDetail .= "<tr style=''>
                               <td style='padding: 10px 0px;border-top: 1px solid #716658;'>".$orderedItem["originalName"]."</td>
                               <td style='padding: 10px 0px;border-top: 1px solid #716658;'>".$orderedItem["qty"]."</td>
                               <td style='padding: 10px;border-top: 1px solid #716658;'>".$orderedItem["originalPrice"]."</td>
                           </tr>";
           if($orderedItem["type"]=="customize"){
               foreach ($orderedItem["addons"] as $addons) {
                   $parameters = array(
                       ":orderId"       => $orderId,
                       ":productId"     => $addons["id"],
                       ":productname"   => $addons["name"],
                       ":parentId"      => $parentId,
                       ":productimage"  => "",
                       ":partnerId"     => $partnerId,
                       ":storeId"       => $partnerstoreId,
                       ":customerId"    => $customerId,
                       ":sourcename"    => "website" ,
                       ":price"         => $addons["price"],
                       ":quantity"      => $orderedItem["qty"],
                       ":total"         => $addons["price"]*$orderedItem["qty"],
                       ":date"          => date('Y-m-d'),
                       ":time"          => date('H:i:s')
                   ); 
                   $query      = "INSERT INTO `orderdetails`(`orderId`,`storeId`,`sourcename`,`productId`,`productname`,`parentId`,`productimage`,`partnerId`,`customerId`,`price`,`quantity`,`total`,`date`,`time`)
                                   VALUES (:orderId,:storeId,:sourcename,:productId,:productname,:parentId,:productimage,:partnerId,:customerId,:price,:quantity,:total,:date,:time)";
                   $query      = $dbhconnection->prepare($query);
                   $query->execute($parameters);
                   $price  += $addons["price"];
                   $prodDetail .= "<tr style=''>
                                       <td style='padding-left: 25px;'>".$addons["name"]."</td>
                                       <td>".$addons["price"]."</td>
                                       <td>".$orderedItem["qty"]."</td>
                                   </tr>";
                   if(isset($addons["addons"])){
                       foreach ($addons["addons"] as $addon) {
                           $parameters = array(
                               ":orderId"       => $orderId,
                               ":productId"     => $addon["id"],
                               ":productname"   => $addon["name"],
                               ":parentId"      => $parentId,
                               ":productimage"  => "",
                               ":partnerId"     => $partnerId,
                               ":customerId"    => $customerId,
                               ":price"         => 0,
                               ":quantity"      => $orderedItem["qty"],
                               ":total"         => 0,
                               ":date"          => date('Y-m-d'),
                               ":time"          => date('H:i:s')
                           ); 
                           $query      = "INSERT INTO `orderdetails`(`orderId`,`productId`,`productname`,`parentId`,`productimage`,`partnerId`,`customerId`,`price`,`quantity`,`total`,`date`,`time`)
                                           VALUES (:orderId,:productId,:productname,:parentId,:productimage,:partnerId,:customerId,:price,:quantity,:total,:date,:time)";
                           $query      = $dbhconnection->prepare($query);
                           $query->execute($parameters);
                           $prodDetail .= "<tr style=''>
                                               <td style='padding-left: 25px;'>".$addon["name"]."</td>
                                               <td>".$addon["price"]."</td>
                                               <td>".$orderedItem["qty"]."</td>
                                           </tr>";
                       }
                   }
               }
           }
           $parameters = array(
               ":id"    => $parentId,
               ":price" => $orderedItem["originalPrice"],
               ":total" => $orderedItem["originalPrice"]*$orderedItem["qty"],
           );
           $query      = "UPDATE `orderdetails` SET `price`=:price, `total`=:total WHERE `id`=:id";
           $query      = $dbhconnection->prepare($query);
           $query->execute($parameters);
           
       }

    

        $email              = (strtolower($_POST['email']));
        $firstname          = (strtolower($_POST['firstname']));
        $lastname           = (strtolower($_POST['lastname']));
        $name               = ($_POST['firstname']." ".$_POST['lastname']);
        $contactno          = ($_POST['contactno']);
        $address            = $_POST['address'];
        $deliverycharges    = 200;// $_POST['deliveryCharges'];
        
        $subtotal           = $_POST['subtotal'];
        $totalamount        = (float)$_POST['total'];
        $paymentmethod      = $_POST['paymentmethod'];
        $saveAmount         = 0;
        $discount           = 0;
        $extraRequirements  = "-";
        
        $message .= '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head><body>'."
                <table cellspacing='0' style='width: 100%;background:#F3F3F3;'>
                    <thead>
                        <tr>
                            <td style='width: 20%;'></td>
                            <td style='width: 60%;'>
                                <img src='assets/images/logo.png' style='height: 100px;float: right;'></td>
                            <td style='width: 20%;'></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style='background:#716658'>
                            <td></td>
                            <td style='padding: 10px;font-size: 20px;text-transform: capitalize;color: #ffffff'>Afghan Tandoor</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style='padding: 10px;'>
                                <h4>Hi</h4>
                                <p style='text-align: justify'>
                                    Thank You For Choosing <span style='text-transform: capitalize;'>Afghan Tandoor</span>. Your order has been
                                    confirmed and it is now under processing.
                                </p>
                               
                                    
                                <p>Here's a look at the complete order information.</p>
                                <table style='width: 100%'>
                                    <tr>
                                        <th style='width: 25%;padding: 5px;'>Order Id </th>
                                        <td style='width: 75%;padding: 5px;'>".$orderId ."</td>
                                    </tr>
                                    <tr>
                                        <th style='width: 25%;padding: 5px;'>Order Date </th>
                                        <td style='width: 75%;padding: 5px;'>".date("d-m-Y")."</td>
                                    </tr>
                                    <tr>
                                        <th style='width: 25%;padding: 5px;'>Order Time </th>
                                        <td style='width: 75%;padding: 5px;'>".date("h:i:sa")."</td>
                                    </tr>
                                    <tr>
                                        <th style='width: 25%;padding: 5px;'>Payment Method </th>
                                        <td style='width: 75%;padding: 5px;'>".$_POST["paymentMethod"]."</td>
                                    </tr>
                                    <tr>
                                        <th style='width: 25%;padding: 5px;'>Delivery Address </th>
                                        <td style='width: 75%;padding: 5px;'>$address</td>
                                    </tr>
                                </table>
                                <table cellspacing='0'  style='width: 100%;text-align:center'>
                                    <thead> 
                                        <tr>
                                            <th>Product</th>
                                            <th>Qauntity</th>
                                            <th>Rate per Quantity</th>
                                        </tr>
                                    </thead>   
                                    <tbody>
                                        $prodDetail
                                    </tbody>
                                    <tfoot>
                                        <tr style=''>
                                            <td style='padding: 10px;border-bottom: 1px solid #716658;'></td>
                                            <td colspan='2' style='padding: 10px 0px;border-bottom: 1px solid #716658;'>
                                                <table style='float: left;text-align: right;width:100%'>
                                                    <tr>
                                                        <td>Subtotal</td>
                                                        <td>$subtotal</td>
                                                    </tr>
                                                    <tr>
                                                        <td>You Save</td>
                                                        <td>$saveAmount</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shipping & Handling</td>
                                                        <td>$deliverycharges</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Discount</td>
                                                        <td>$discount</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Grand Total</td>
                                                        <td>$totalamount</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </tfoot>
                
                                </table>
                                <p>Once again, thank you for choosing Afghan Tandoor. We hope to serve you again soon.</p>
                                <p>Regards,</p>
                                <p style='text-transform:capitalize'>Team Afghan Tandoor</p>
                            </td>
                            <td></td>
                        </tr>

                    </tbody>
                </table></body></html>";
        $subject     = "Thank you for Your Order with ".$partnername."";
        $replyto     = 'info@'.$partnerdomain.'';
        $headers     = "From: ".$partnername." <orders@".$partnerdomain."> \r\n";
        $headers    .= "Reply-To: ". $replyto . "\r\n";
        $headers    .= "MIME-Version: 1.0\r\n";
        $headers    .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $to          = $email;
        $adminMail   =    "<html><head></head>
                        <body>
                            <table cellspacing='0' style='width: 100%;background:#F3F3F3;'>
                                <thead>
                                    <tr>
                                        <td style='width: 20%;'></td>
                                        <td style='width: 60%;'>
                                            <img src='assets/images/logo.png' style='height: 50px;float: right;'></td>
                                        <td style='width: 20%;'></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style='background:#716658'>
                                        <td></td>
                                        <td style='padding: 10px;font-size: 20px;text-transform: capitalize;color: #ffffff'>AfghanTandoor</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td style='padding: 10px;'>
                                            
                                            <table style='width: 100%;text-align: left'>
                                                <tr>
                                                    <th style='width: 25%;padding: 5px;'>Order ID </th>
                                                    <td style='width: 75%;padding: 5px;'>$orderId</td>
                                                </tr>
                                                <tr>
                                                    <th style='width: 25%;padding: 5px;'>Name </th>
                                                    <td style='width: 75%;padding: 5px;'>".$_POST["name"]."</td>
                                                </tr>
                                                <tr>
                                                    <th style='width: 25%;padding: 5px;'>Phone No. </th>
                                                    <td style='width: 75%;padding: 5px;'>".$_POST["contactNo"]."</td>
                                                </tr>
                                                <tr>
                                                    <th style='width: 25%;padding: 5px;'>Email </th>
                                                    <td style='width: 75%;padding: 5px;'>$email</td>
                                                </tr>
                                                <tr>
                                                    <th style='width: 25%;padding: 5px;'>Address </th>
                                                    <td style='width: 75%;padding: 5px;'>$address</td>
                                                </tr>
                                                <tr>
                                                    <th style='width: 25%;padding: 5px;'>Payment Method </th>
                                                    <td style='width: 75%;padding: 5px;'>".$_POST["paymentMethod"]."</td>
                                                </tr>
                                                <tr>
                                                    <th style='width: 25%;padding: 5px;'>Order Date </th>
                                                    <td style='width: 75%;padding: 5px;'>".date("d-m-Y")."</td>
                                                </tr>
                                                <tr>
                                                    <th style='width: 25%;padding: 5px;'>Order Time </th>
                                                    <td style='width: 75%;padding: 5px;'>".date("h:i:sa")."</td>
                                                </tr>
                                            </table>
                                            <table cellspacing='0' style='width: 100%;text-align:center;margin-top:30px'>
                                                <thead> 
                                                    <tr>
                                                        <th style='border-bottom: 1px solid #716658;border-top: 1px solid #716658;'>Product</th>
                                                        <th style='border-bottom: 1px solid #716658;border-top: 1px solid #716658;'>Quantity</th>
                                                        <th style='border-bottom: 1px solid #716658;border-top: 1px solid #716658;'>Rate per Quantity</th>
                                                    </tr>
                                                </thead>   
                                                <tbody>
                                                    $prodDetail
                                                </tbody>
                                                <tfoot>
                                                    <tr style=''>
                                                        <td style='padding: 10px;border-bottom: 1px solid #716658;'></td>
                                                        <td colspan='2' style='padding: 10px 0px;border-bottom: 1px solid #716658;'>
                                                            <table style='float: left;text-align: right;width:100%'>
                                                                <tr>
                                                                    <td>Subtotal</td>
                                                                    <td>$subtotal</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>You Save</td>
                                                                    <td>$saveAmount</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Delivery Charges</td>
                                                                    <td>$deliverycharges</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Discount</td>
                                                                    <td>$discount</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Grand Total</td>
                                                                    <td>$totalamount</td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr style='background:#716658'>
                                       
                                    </tr>
                                </tbody>
                            </table>
                        <body></html>";
        mail($email,$subject,$message,$headers);
        // mail('salman@cybeinc.com',$subject,$adminMail,$headers);
        // mail('hamza@cybeinc.com',$subject,$adminMail,$headers);
        mail('ali@cybeinc.com',$subject,$adminMail,$headers);
        mail('hamzayousuf@cybeinc.com',$subject,$adminMail,$headers);
        // mail('amin@cybeinc.com',$subject,$adminMail,$headers);
        // mail('tanveer@cybeinc.com',$subject,$adminMail,$headers);
        mail('',$subject,$message,$headers);
        
        $_SESSION["paymentMethod"] = $_POST["paymentMethod"];
        if($_POST["paymentMethod"] == "Online"){
            header("location:paymentgateway.php?orderId=$orderId");
            exit();
            
        }else{
            unset($_SESSION["ordereditems"]);
            header("location:thankyou.php");
            exit();
        }

    }
    
    
?>