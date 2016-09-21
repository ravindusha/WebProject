<?php
ob_start();
require 'dbconnect.php';
require 'header.php';
@session_start();
?>
<div class="content">
<center>
	<h2>Order Form</h2>
	<div id="backbutton"><a href="cart.php?action=view"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Back to Cart</a></div>
	<form action="admin/orders.php" method="POST">
		<table id="ordertable">
		<tr>
			<td class="label" width="30%">Name</td>
			<td width="50%"><input type="text" name="name"	 required></td>
		</tr>
		<tr>
			<td class="label">E-mail</td>
			<td><input type="email" name="email"></td>
		</tr>
		<tr>
			<td class="label">Contact No.</td>
			<td><input type="text" name="contact" required></td>
		</tr>
		<tr>
			<td class="label">Address</td>
			<td><textarea name="address" rows="5" cols="30" required></textarea></td>
		</tr>
		<tr>
			<td class="label">Total Cost</td>
			<td><?php echo 'Rs. '.number_format($_POST['cost'],2);?></td>
			<input type="hidden" name="cost" value="<?php echo $_POST['cost'];?>">
		</tr>
		<tr><td></td></tr>
		<tr>
			<td colspan="2" align="center" class="label">Credit Card Details</td>
		</tr>
		<tr>
			<td class="label">Card Holder's Name</td>
			<td><input type="text" name="cardname" required></td>
		</tr>
		<tr>
			<td class="label">Card Number</td>
			<td><input type="text" name="cardnumber" required placeholder="xxxx-xxxx-xxxx-xxxx" maxlength="16"></td>
		</tr>
		<tr>
			<td class="label">Expiry Date</td>
			<td><input type="month" name="expmonth" required></td>
		</tr>
		<tr>
			<td class="label">CVV</td>
			<td><input type="number" name="cvv" max="999" min="111" required></td>
		</tr>
		<tr>
		<input type="hidden" name="action" value="add">
		<td colspan="2" align="center"><input type="submit" value="Order" class="orderbutton"></td>
		</tr>
		</table>
	</form>
</center>
</div>
<?php
require 'footer.php';
?>