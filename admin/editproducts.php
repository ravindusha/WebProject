<div class="content">
<center>
	<h2>Edit Products</h2>
	<table width="100%" id="editproducts">
		<tr>
			<th width="25%"><a href="adminpanel.php?page=edit&amp;type=face">Skin Makeup</a></th>
			<th width="25%"><a href="adminpanel.php?page=edit&amp;type=lip">Lip Makeup</a></th>
			<th width="25%"><a href="adminpanel.php?page=edit&amp;type=eye">Eye Makeup</a></th>
			<th width="25%"><a href="adminpanel.php?page=edit&amp;type=accessories">Accessories</a></th>
		</tr>
	</table>
	<br><br>
	<?php
	if(isset($_GET['type'])){
	?>
	<table id="itemtable">
	<tr id="tableheader">
		<th>Image</th>
		<th>Name</th>
		<th>Description</th>
		<th>Category</th>
		<th>Price</th>
		<th>Stock</th>
	</tr>
	<?php
		require '../dbconnect.php';
		$editquery = mysqli_query($con,'select * from products where category="'.$_GET['type'].'"');
		while ($product = mysqli_fetch_object($editquery)) {
		?>
				<tr class="item" onclick="window.location='adminpanel.php?page=edit&amp;id=<?php echo $product->id;?>'">
					<td><img src="../images/products/<?php echo $product->id; ?>.jpg" height="100px" width="100px"/></td>
					<td class="name"><?php echo $product->name; ?></td>
					<td class="description"><?php echo $product->description; ?></td>
					<td><?php echo $product->category; ?></td>
					<td>Rs.&nbsp;<?php echo number_format($product->price,2); ?></td>
					<td><?php echo $product->stock; ?></td>
				</tr>
		<?php
		}
	}
	?>
	</table>
</center>
</div>