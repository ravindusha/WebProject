<!DOCTYPE html>
<html>
<head>
	<title>Lovender Cosmetics</title>
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/general.css">
	<link rel="stylesheet" type="text/css" href="css/sss.css">
	<link rel="icon" type="image/png" href="images/logo.png" />
	
	<?php
	if(basename($_SERVER['PHP_SELF'])=='viewitems.php')
		echo '<link rel="stylesheet" type="text/css" href="css/shop.css">';
	if(basename($_SERVER['PHP_SELF'])=='cart.php')
		echo '<link rel="stylesheet" type="text/css" href="css/cart.css">';
	if(basename($_SERVER['PHP_SELF'])=='admin.php')
		echo '<link rel="stylesheet" type="text/css" href="css/admin.css">';
	if(basename($_SERVER['PHP_SELF'])=='orderform.php')
		echo '<link rel="stylesheet" type="text/css" href="css/orderform.css">';
	?>
</head>
<body>
<?php 
@session_start();
if(isset($_SESSION['cart'])){
	$cart = unserialize(serialize($_SESSION['cart']));
}else{
	$cart = [];
}
?>
<div class="header-container" <?php if(basename($_SERVER['PHP_SELF'])=='index.php')echo ' style="position:fixed;"'; ?>>
    <div class="header">
    			<img src="images/logo.png" width="40" height="50"/>
    			<a href="index.php" id="storename">Lovender Cosmetics</a>
				
    			<nav>
					<ul>
						<li class="dropdown">
					    <a href="viewitems.php?type=all" class="dropbtn" id="<?php if(basename($_SERVER['PHP_SELF'])=='viewitems.php')echo 'selected'; ?>"><i class="fa fa-shopping-bag" aria-hidden="true"></i>&nbsp;Shop</a>
					    <div class="dropdown-content">
					      <a href="viewitems.php?type=skin">Skin Makeup</a>
					      <a href="viewitems.php?type=lip">Lip Makeup</a>
					      <a href="viewitems.php?type=eye">Eye Makeup</a>
					      <a href="viewitems.php?type=accessories">Accessories</a>
					    </div>
					  	</li>
					  
					  <li><a href="cart.php?action=view" id="<?php if(basename($_SERVER['PHP_SELF'])=='cart.php')echo 'selected'; ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Cart&nbsp;(<?php echo count($cart); ?>)</a></li>
					  
					</ul>
				</nav>
	</div>
</div>
<div width="100%" height="20px" style="display:block;"></div>

