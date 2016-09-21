<?php
	ob_start();
	session_start();

	require '../dbconnect.php';

	if(isset($_POST['username'])){
		$result = mysqli_query($con,'select * from admin where username="'.$_POST['username'].'"');
		$logindata = mysqli_fetch_object($result);
		login($logindata);
	}else{
		if(isset($_SESSION['access'])==false || $_SESSION['access']==false){
			$_SESSION['access'] = false;
			header('location: ../admin.php');
		}else{
			viewDashboard();
		}
	}

	function login($logindata){
		$pass = hash('sha256', $_POST['password']);
		if(($_POST['username']!=$logindata->username) || ($pass!=$logindata->password)){
			$_SESSION['access'] = false;
			header('location: ../admin.php');
		}else{
			echo 'login successful';
			$_SESSION['access'] = true;
			viewDashboard();
		}
	}

	function viewDashboard(){
		require 'adminheader.php';

		if(isset($_GET['action'])){
			if($_GET['action']=='login'){
				require 'orders.php';
			}elseif ($_GET['action']=='logout') {
				$_SESSION['access'] = false;
				header('location: ../admin.php');
			}
		}else{
			if (isset($_GET['page'])) {
				if ($_GET['page']=='add') {
					require 'addproduct.php';
				}elseif ($_GET['page']=='edit') {
					if (isset($_GET['id'])) {
						require 'edititem.php';
					}else{
						require 'editproducts.php';
					}
				}elseif($_GET['page']=='orders'){
					if (isset($_GET['id'])) {
						require 'orderdetails.php';
					}else{
						require 'orders.php';
					}
				}elseif ($_GET['page']=='account') {
					require 'account.php';
				}
			}else
			require 'orders.php'; 
		}
		require 'adminfooter.php';
	}
?>
