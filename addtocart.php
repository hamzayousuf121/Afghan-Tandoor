<? 
	$serverroot=$_SERVER['DOCUMENT_ROOT'];
	include($serverroot."/assets/include/settings.php");
	include($mainserverroot."/allthebest/models/Cart.php");
	$addToCart	= new Cart_model();
	
	if (isset($_POST["productid"])) {
		$ids 		= "";
		$addonsStr 	= "";
		$miamStr 	= "";
		$addonPrice = 0;
		if($_POST["addons"]!=""){
			$addonCount = count($_POST["addons"]);
			foreach ($_POST["addons"] as $addons) {
				$ids 		.= "-".$addons["id"];
				$addonPrice += $addons["price"];
				if(isset($addons["addons"])){
					foreach ($addons["addons"] as $add) {
						$ids .= "-".$add["id"];						
					}
					$miamStr = "Make it a Meal Of ";
					$addonCount--;
				}		
			}
		}
		$prodId 				= $_POST["productid"].$ids;//.(count($_POST["addons"])!=0?$addonIds:"");
		$name                 	= $miamStr.$_POST['productname'].$addonsStr;//.trim($_POST['productname']);
		$price                	= ($addonPrice+$_POST['productprice']);
		$image                	= trim($_POST['productimage']);
		// $proId                	= trim($_POST['productid']);
		$qty                  	= $_POST['productqty'];
		$proCount             	= trim(($_POST['productid']));
		$_SESSION['proCount'] 	= $proCount;
		$maincategoryId       	= $_POST["productcategory"];
		if(isset($_SESSION["ordereditems"][$prodId])){ 
			$productvalue     	= $_SESSION["ordereditems"][$prodId];
			$qty              	= $productvalue['qty'] + $qty;
		}
		$cart = $_SESSION["ordereditems"][$prodId] = array(
			"type"				=> $_POST["type"],
			"name"          	=> $name,
			"originalName"		=> $_POST['productname'],
			'qty'           	=> $qty, 
			"price"         	=> $price,
			"originalPrice" 	=> $_POST['productprice'],
			"image"         	=> $image, 
			"prodId"        	=> $_POST["productid"], 
			"maincategoryId"	=> $maincategoryId,
			'proCount'      	=> $proCount,
			"addons"			=> $_POST["addons"]
		); 
		$arr = array(
			'cart'          	=> $cart,
			'totalcount'    	=> count($_SESSION["ordereditems"]),
			'cartitems'     	=> $_SESSION["ordereditems"]
		);
		echo  json_encode($arr);
	}
	if(isset($_POST['minusQtyProductId'])){
		$productId	= $_POST["minusQtyProductId"];
		$remove		= $addToCart->removeQtyProduct($productId);
		echo $remove;
	}
	if(isset($_POST['plusQtyProductId'])){
		$productId	= $_POST["plusQtyProductId"];
		$qty		= $_POST["qty"];
		$status		= $addToCart->updatecart($productId,$qty);
		echo $status;
	}
	if (isset($_POST["clearCart"])) {
		$status		= $addToCart->emptyCart();
		echo $status;
	}
	if (isset($_POST["removeProductId"])) {
		$arr		= $addToCart->removeCart($_POST["removeProductId"]);
		echo $arr;
	}
	
?>