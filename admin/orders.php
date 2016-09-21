<?php
ob_start();
require '../dbconnect.php';
require '../item.php';
@session_start();

if (isset($_POST['action'])) {
	if ($_POST['action']=='add') {
		if(isset($_SESSION['cart'])){
			$cart = unserialize(serialize($_SESSION['cart']));
		}else{
			$cart = [];
		}
		$name = $_POST['name'];
		$address = $_POST['address'];
		$phone = $_POST['contact'];
		$email = $_POST['email'];
		$payment = $_POST['cost'];
		$status = "Pending";

		$idquery = mysqli_query($con,'select orderid from orders order by orderid desc limit 1;');
		$iddata = mysqli_fetch_object($idquery);
		if($iddata->orderid=='')
			$newid = 1000;
		else
			$newid = intval($iddata->orderid)+1;

		mysqli_query($con,'insert into orders values('.$newid.',"'.$name.'","'.$address.'","'.$phone.'","'.$email.'",'.$payment.',"'.$status.'")');

		for($i=0; $i<count($cart); $i++){
			mysqli_query($con,'insert into orderdetails values('.$newid.','.$cart[$i]->id.','.$cart[$i]->quantity.');');

			$product = mysqli_query($con,'select * from products where id='.$cart[$i]->id);
			$res = mysqli_fetch_object($product);
			$stock = intval($res->stock)-intval($cart[$i]->quantity);
			mysqli_query($con,'update products set stock='.$stock.' where id='.$cart[$i]->id);

		}
		unset($_SESSION['cart']);
		header('location: ../index.php');
	}


}
?>
<div class="content">
<center>
	<h2>Orders</h2>
	<table width="80%" id="ordertype">
		<tr>
			<th width="50%"><a href="adminpanel.php?page=orders&amp;status=Pending">Pending</a></th>
			<th width="50%"><a href="adminpanel.php?page=orders&amp;status=Finished">Finished</a></th>
		</tr>
	</table>
	<br>
	<?php
	if(isset($_GET['status'])){
	$orders = mysqli_query($con,'select * from orders where status="'.$_GET['status'].'"');
	?>
	<h3><?php echo $_GET['status'].' orders';?></h3>
	<table id="ordertable">
	<tr id="tableheader">
		<th>Order ID</th>
		<th>Name</th>
		<th>Address</th>
		<th>Phone No.</th>
		<th>Email</th>
		<th>Payment</th>
		<th>Status</th>
	</tr>
	<?php while ($order = mysqli_fetch_object($orders)) { ?>
		<tr class="item" onclick="window.location='adminpanel.php?page=orders&amp;id=<?php echo $order->orderid; ?>'">
		<td><?php echo $order->orderid; ?></td>
		<td><?php echo $order->name; ?></td>
		<td><?php echo $order->address; ?></td>
		<td><?php echo $order->phone; ?></td>
		<td><?php echo $order->email; ?></td>
		<td><?php echo "Rs. ".number_format($order->payment,2); ?></td>
		<td><?php echo $order->status; ?></td></td>
	</tr>
	<?php	}	?>
	

	</table>
	<?php } ?>

</center>
</div>