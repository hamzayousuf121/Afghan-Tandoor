<? 
    $pagetitle = "thankYou";
    include('assets/include/header.php');
    if($_POST["response_code"] == 400)
    {
        echo '  <div class="alert alert-danger" role="alert">
                    '.$_POST["message"].' of Order = '.$_POST["order_reference"].'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    }
    else if($_POST["response_code"] == 306)
    {
        echo '  <div class="alert alert-warning" role="alert">
                    '.$_POST["message"].' Order No. '.$_POST["order_reference"].'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    }
    else if($_POST["response_code"] == 100)
    {
        $sql = "Insert into onlinepayments (partnerId, customerId, orderReference, paidAmount, totalAmount, date, time) values (?,?,?,?,?, CURDATE(), CURRENT_TIME())";
        $stmt = $dbhconnection->prepare($sql);
        extract($_POST);
        $stmt->execute([$partnerId, $_SESSION['customerId'], $orderReference, $amountpaid, $amounttobepaid]);
        echo '  <div class="alert alert-success" role="alert">
                    '.$_POST["message"].' of Order No. '.$_POST["order_reference"].'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    }


?>

<section>
    <div class="container-fluid">
        <div class="container-box">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                
             <div class="col-lg-6 col-md-6 col-xs-12 offset-lg-3 offset-md-3">   
            <div class="thank-you">      
            <h1 class="">THANK YOU!</h1>
            <p class="">Thanks a bunch for filling that out. It means a lot to us, just like you do! We really appreciate you giving us a moment of your time today. Thanks for being you.</p>
            </div>
            </div>
           
     </div>    
  </div>
</div>
</div>
</section>
<?php include('assets/include/footer.php')?>
