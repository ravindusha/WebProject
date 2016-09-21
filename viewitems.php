<?php
	require 'header.php';
	require 'dbconnect.php';

	if(isset($_GET['type'])){
		if($_GET['type']=="all"){
			$result = mysqli_query($con,'select * from products');
			$_SESSION['message']="";
		}
		elseif ($_GET['type']=="skin") {
			$result = mysqli_query($con,'select * from products where category="face"');
		}elseif ($_GET['type']=="lip") {
			$result = mysqli_query($con,'select * from products where category="lip"');
		}elseif ($_GET['type']=="eye") {
			$result = mysqli_query($con,'select * from products where category="eye"');
		}elseif ($_GET['type']=="accessories") {
			$result = mysqli_query($con,'select * from products where category="accessories"');
		}
	}

	require 'shop.php';
	require 'footer.php';
?>