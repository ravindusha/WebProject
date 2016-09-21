<?php
//error_reporting(0);
ob_start();
@session_start();

require 'dbconnect.php';
require 'item.php';

if(isset($_GET['id']))
{
	$result = mysqli_query($con,'select * from products where id='.$_GET['id']);
	$product = mysqli_fetch_object($result);

	$item = new Item();
	$item->id = $product->id;
	$item->name = $product->name;
	$item->description = $product->description;
	$item->price = $product->price;
	$item->quantity = 1;
	$item->category = $product->category;
	$item->stock = $product->stock;

	$index = -1;
	if(isset($_SESSION['cart'])){
		$cart = unserialize(serialize($_SESSION['cart']));

		for($i=0; $i<count($cart); $i++){
			if($cart[$i]->id == $_GET['id']){
				$index = $i;
				break;
			}
		}
	}
	if($index==-1){
		$_SESSION['cart'][] = $item;
	}else{
		$cart[$index]->quantity++;
		if(($cart[$index]->quantity)>($product->stock)){
			$cart[$index]->quantity=$product->stock;
			$_SESSION['message']="Not Enough Items in Stock";
		}else{
			$_SESSION['message']="Item Added Successfully";
		}
		$_SESSION['cart']= $cart;
	}
}
if(isset($_GET['index'])){
	$cart = unserialize(serialize($_SESSION['cart']));
	unset($cart[$_GET['index']]);
	$cart = array_values($cart);
	$_SESSION['cart'] = $cart;
	$_SESSION['message']="Item Deleted Successfully";
	//header('location: cart.php?action=view');
	//echo '<meta http-equiv="Location" content="cart.php?action=view">';
	echo '<script> location.replace("cart.php?action=view"); </script>';
}
if(isset($_GET['update'])){
	$cart = unserialize(serialize($_SESSION['cart']));
	$cart[$_GET['update']]->quantity=$_GET['value'];
	$_SESSION['cart'] = $cart;
	$_SESSION['message']="Cart Updated Successfully";
	//header('location: cart.php?action=view');
	//echo '<meta http-equiv="Location" content="cart.php?action=view">';
	echo '<script> location.replace("cart.php?action=view"); </script>';
}


if(isset($_SESSION['cart'])){
	$cart = unserialize(serialize($_SESSION['cart']));
}else{
	$cart = [];
}

if(count($cart)==0){
	require 'header.php'; ?>
	<center>
	<div class="content" style="font-size:24px;">Cart is Empty!</br>
	<a href="viewitems.php?type=all">Continue Shopping</a>
	</div>
	</center>
	<?php

}
else{ 
	if(isset($_GET['action'])){
		if($_GET['action']=="view"){
			viewCart();
		}
		if($_GET['action']=="back"){
			//header('location: '. $_SERVER['HTTP_REFERER']);
			//echo '<meta http-equiv="Location" content="'. basename($_SERVER['HTTP_REFERER']).'">';
			echo '<script> location.replace("'. basename($_SERVER['HTTP_REFERER']).'"); </script>';
		}
	}
}

function viewCart(){
	require 'dbconnect.php';
	require 'header.php'; ?>
	
	<center>
	<div class="content">
	<h2><b>Cart</b></h2>
		<table cellpadding="5px">
			<tr><td></td><td></td><td style="background-color:#ea7b7e">Quantity</td><td></td><td style="background-color:#ea7b7e">Price</td><td></td></tr>
		<?php
		if(isset($_SESSION['cart'])){
			$cart = unserialize(serialize($_SESSION['cart']));
		}else{
			$cart = [];
}
		$total = 0;
		$index=0;
		for($i=0; $i<count($cart); $i++){ 
				$total += $cart[$i]->price * $cart[$i]->quantity;
			?>
		<tr class="carttable">
			<td><img src="images/products/<?php echo $cart[$i]->id ?>.jpg" height="100px" width="100px"/></td>
			<td style="min-width:200px;">
				<p class="bold"><?php echo $cart[$i]->name; ?></p><br/><br/>
			</td>
			<?php
				$query = mysqli_query($con,'select * from products where id='.$cart[$i]->id);
				$item = mysqli_fetch_object($query);
				$stock = $item->stock;
			?>
			<td><form method="GET" action="cart.php">
					<input type="hidden" name="update" value="<?php echo $index; ?>">
					<input type="number" name="value" min="1" value="<?php echo $cart[$i]->quantity; ?>" max="<?php echo $stock ?>" size="2">
					<input type="submit" value="Update"/>
				</form>
			</td>
			<td><?php echo $stock." Items Left"; ?></td>
			<td align="right"><?php echo number_format($cart[$i]->price * $cart[$i]->quantity,2); ?></td>
			<td><a class="deletelink" href="cart.php?index=<?php echo $index; ?>" onClick="return confirm('Are you sure?');">Delete</a></td>
		</tr>
		<?php 
			$index++;
		} ?>
		<tr style="background-color:#ea7b7e">
			<td colspan="4" align="right"><b>Total</b></td>
			<td align="right"><b><?php echo "Rs. ".number_format($total,2); ?></b></td>
		
			<td><form action="orderform.php" method="POST">
				<input type="hidden" name="cost" value="<?php echo $total; ?>"/>
				<input type="submit" value="Order Now!" id="order"/>
			</form></td>
		</tr>
		</table>
		<br/>
	<a href="viewitems.php?type=all">Continue Shopping</a>
	</div>
	</center>

<?php } ?>
<?php 
require 'footer.php';
?>