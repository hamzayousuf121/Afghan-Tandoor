<? 
    $serverroot      = $_SERVER['DOCUMENT_ROOT'];
    $themefoldername = "afghantandoor"; // this needs to be change partner to partner and has to defined here 
    $replacepart     = "/themes/".$themefoldername;
    $newserverroot   = str_replace($replacepart,'',$serverroot);
    include($newserverroot."/settings.php");
    $partnerstoreId = $partnerstoreIdfrommain; // this variable is defined in /partnerwebsites/settings.php and is dynamically fetch from database as per partner
?> 