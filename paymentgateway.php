<?php

include("assets/include/settings.php");
$conn = $dbhconnection->prepare("Select clientId, emailKey from opay where partnerId = ?");
$conn->execute([$partnerId]);
$conn = $conn->fetchAll();
$conn = $conn[0];
$clientId = base64_decode($conn['clientId']);
$emailKey = base64_decode($conn['emailKey']);
include(dirname(__FILE__)."/../../paymentgateway.php");
?>