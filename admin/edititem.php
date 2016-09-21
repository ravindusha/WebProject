<?php
	ob_start();
	require '../dbconnect.php';
	$editquery = mysqli_query($con,'select * from products where id="'.$_GET['id'].'"');
	$item =  mysqli_fetch_object($editquery);

	if (isset($_POST['action'])) {
		if($_POST['action']=='Update'){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$stock = $_POST['stock'];
		$category = $_POST['category'];

		$updatequery = mysqli_query($con,'update products set name="'.$name.'",description="'.$description.'",price="'.$price.'",stock="'.$stock.'",category="'.$category.'" where id="'.$id.'"');
		}
		if($_POST['action']=='Delete') {
			$deletequery = mysqli_query($con,'delete from products where id="'.$_POST["id"].'"');
		}
		header('location: adminpanel.php?page=edit');
	}
?>
<div class="content">
<center>
	<h2>Edit Item</h2>
	<form action="edititem.php" method="POST" name="editform">
	<table class="edititem">
		<tr>
			<td width="30%" class="label">ID</td>
			<td width="50%"><input type="number" name="id" value="<?php echo $_GET['id']; ?>" min="1000" max="5000" required readonly></td>
		</tr>
		<tr>
			<td class="label">Name</td>
			<td><input type="text" name="name" value="<?php echo $item->name; ?>" required></td>
		</tr>
		<tr>
			<td class="label">Description</td>
			<td><textarea rows="7" cols="60" name="description" maxlength="550"><?php echo $item->description; ?></textarea></td>
		</tr>
		<tr>
			<td class="label">Price</td>
			<td><input type="number" name="price" value="<?php echo $item->price; ?>" required></td>
		</tr>
		<tr>
			<td class="label">Stock</td>
			<td><input type="number" name="stock" value="<?php echo $item->stock; ?>" min="0" max="1000" required></td>
		</tr>
		<tr>
			<td class="label">Category</td>
			<td><select name="category">
				  <option value="Lip" <?php if($item->category=='Lip')echo ' selected'; ?>>Lip</option>
				  <option value="Face" <?php if($item->category=='Face')echo ' selected'; ?>>Face</option>
				  <option value="Eye" <?php if($item->category=='Eye')echo ' selected'; ?>>Eye</option>
				  <option value="Accessories" <?php if($item->category=='Accessories')echo ' selected'; ?>>Accessories</option>
				</select>
		</td>
		</tr>
		<tr>
			<input type="hidden" name="action" value="update">
			<td align="center">
				<input type="submit" name="action" value="Update">
			</td>
			<td align="center">
				<input type="submit" name="action" value="Delete">
			</td>
		</tr>
	</table>
	</form>
</center>
</div>