<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard</title>
	<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/general.css">
	<link rel="icon" type="image/png" href="../images/logo.png" />
	<?php
		if (isset($_GET['page'])) {
			if ($_GET['page']=='add') {
				echo '<link rel="stylesheet" type="text/css" href="../css/addnewproduct.css">';
			}
			if ($_GET['page']=='edit') {
				echo '<link rel="stylesheet" type="text/css" href="../css/editproduct.css">';
				echo '<link rel="stylesheet" type="text/css" href="../css/edititem.css">';
			}
			if ($_GET['page']=='orders') {
				echo '<link rel="stylesheet" type="text/css" href="../css/orders.css">';
			}
			if ($_GET['page']=='account') {
				echo '<link rel="stylesheet" type="text/css" href="../css/admin.css">';
			}
		}
	?>
</head>
<body>
<div class="header-container">
    <div class="header">
    			<img src="../images/logo.png" width="40" height="50"/>
    			<a href="../index.php" id="storename">Lovender Cosmetics</a>
				
    			<nav>
					<ul>
						<li class="dropdown">
					    <a href="#" class="dropbtn" id="<?php if(isset($_GET['page']))if($_GET['page']=='add'||$_GET['page']=='edit') echo 'selected'; ?>"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Products</a>
					    <div class="dropdown-content">
					      <a href="adminpanel.php?page=add"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add New Product</a>
					      <a href="adminpanel.php?page=edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Edit Products</a>
					    </div>
					  </li>
					  <li><a href="adminpanel.php?page=orders" id="<?php if(isset($_GET['page'])){if($_GET['page']=='orders') echo 'selected';}else echo 'selected'; ?>"><i class="fa fa-list-alt" aria-hidden="true"></i>&nbsp;Orders</a></li>
					  <li><a href="adminpanel.php?page=account" id="<?php if(isset($_GET['page']))if($_GET['page']=='account') echo 'selected'; ?>"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Edit Account</a></li>
					  <li><a href="adminpanel.php?action=logout" id=""><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Logout</a></li>
					  
					</ul>
				</nav>
	</div>
</div>
<div width="100%" height="20px" style="display:block;"></div>