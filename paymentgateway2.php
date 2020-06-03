<?php

include("assets/include/settings.php");
$conn = $dbhconnection->prepare("Select clientId, emailKey from opay where partnerId = ?");
$conn->execute([$partnerId]);
$conn = $conn->fetchAll();
$conn = $conn[0];
$clientId = base64_decode($conn['clientId']);
$emailKey = base64_decode($conn['emailKey']);
$_GET['orderId'] = '03431144446';
    include('settings.php');
    if (isset($_GET["orderId"])) {
        $id         = $_GET["orderId"];
        $post_data['paymentMethod']     = 'online';
        $post_data['orderReference']    = '090078601123';
        $post_data['responseUrl']       = 'https://'.$_SERVER['HTTP_HOST'].'/thankyou.php';
        // $post_data['clientId']          = OPAY_CLIENTID;
        // $post_data['emailKey']          = OPAY_CLIENT_EMAIL_ID;
        $post_data['clientId']          =  $clientId;
        $post_data['emailKey']          =  $emailKey;
?>
    <form action="https://customers.opay.pk/api/order" method="POST" id="opayForm">
        <input type="hidden" name="paymentMethod" value="<?= $post_data["paymentMethod"] ?>" />
        <input type="hidden" name="amount" value="<?= '1' ?>" />
        <input type="hidden" name="orderReference" value="<?= $post_data["orderReference"] ?>" />
        <input type="hidden" name="responseUrl" value="<?= $post_data["responseUrl"] ?>" />
        <input type="hidden" name="clientId" value="<?= $post_data["clientId"] ?>" />
        <input type="hidden" name="emailKey" value="<?= $post_data["emailKey"] ?>" />
    </form>


    <script>
        document.getElementById("opayForm").submit();
    </script>
<?php
    }
?>