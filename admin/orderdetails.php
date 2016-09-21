<?php
ob_start();
 require '../dbconnect.php';
if (isset($_GET['id'])) {
	$editquery = mysqli_query($con,'select * from orders where orderid="'.$_GET['id'].'"');
	$item =  mysqli_fetch_object($editquery);

	$detailsquery =  mysqli_query($con,'select * from orderdetails where orderid="'.$_GET['id'].'"');
}
if (isset($_GET['action'])) {
	if ($_GET['action']=='Update') {
		mysqli_query($con,'update orders set status="'.$_GET['status'].'" where orderid='.$_GET['actionid']);
		header('location: adminpanel.php?page=orders');
	}
	if ($_GET['action']=='Delete') {
		mysqli_query($con,'delete from orders where orderid='.$_GET['actionid']);
		header('location: adminpanel.php?page=orders');
	}
}
?>
<div class="content">
<center>
	<h2>Order Details</h2>
	<form action="orderdetails.php" method="GET" >
		<p align="center"><b>Order ID: <?php echo $_GET['id']; ?></b></p>
		<table id="ordertable">
			<tr>
				<td class="label">Name</td>
				<td><?php echo $item->name; ?></td>
			</tr>
			<tr>
				<td class="label">Address</td>
				<td><?php echo $item->address; ?></td>
			</tr>
			<tr>
				<td class="label">Phone No.</td>
				<td><?php echo $item->phone; ?></td>
			</tr>
			<tr>
				<td class="label">E-mail address</td>
				<td><?php echo $item->email; ?></td>
			</tr>
			<tr>
				<td class="label">Payment Amount</td>
				<td><?php echo $item->payment; ?></td>
			</tr>
		</table>
		<br>
		<table id="ordertable">
			<tr id="tableheader">
				<th>Item ID</th>
				<th>Item Name</th>
				<th>Quantity</th>
			</tr>
			<?php while($orderdetail = mysqli_fetch_object($detailsquery)){ ?>
				<tr>
					<td><?php echo $orderdetail->productid; ?></td>
					<?php
						$productquery = mysqli_query($con,'select * from products where id="'.$orderdetail->productid.'"');
						$itemdetails =  mysqli_fetch_object($productquery);
					?>
					<td><?php echo $itemdetails->name; ?></td>
					<td><?php echo $orderdetail->quantity; ?></td>
				</tr>
			<?php } ?>
			
		</table>
		<br>
		<table>
			<tr>
				<td class="label">Update Status:</td>
				<td>
					<select name="status">
						<option value="Pending" <?php if($item->status=='Pending')echo ' selected';?>>Pending</option>
						<option value="Finished" <?php if($item->status=='Finished')echo ' selected';?>>Finished</option>
					</select>
				</td>
			</tr>
		</table>
		<br>
		<table>
			<tr>
				<input type="hidden" name="actionid" value="<?php echo $_GET['id']; ?>">
				<td><input type="submit" name="action" value="Update"></td>
				<td><input type="submit" name="action" value="Delete"></td>
			</tr>
		</table>
	</form>
</center>
</div>