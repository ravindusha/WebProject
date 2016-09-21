<?php
	ob_start();
	require '../dbconnect.php';
	$idquery = mysqli_query($con,'select id from products order by id desc limit 1;');
	$iddata = mysqli_fetch_object($idquery);
	$newid = intval($iddata->id)+1;

	if(isset($_POST['action'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$stock = $_POST['stock'];
		$category = $_POST['category'];

		$addquery = mysqli_query($con,'insert into products values('.$id.',"'.$name.'","'.$description.'",'.$price.','.$stock.',"'.$category.'")');
		header('location: adminpanel.php?page=add');

	}else{
		//header('location: adminpanel.php?page=add');
	}

?>
<div class="content">
<center>
	<h2>Add New Product</h2>
	<form action="addproduct.php" method="POST" name="addnewform">
	<table class="addnewtable">
		<tr>
			<td width="30%" class="label">ID</td>
			<td width="50%"><input type="number" name="id" value="<?php echo $newid; ?>" min="1000" max="5000" required readonly><br>*Please put the product image in 'images/products' folder and rename it with the given ID.</td>
		</tr>
		<tr>
			<td class="label">Name</td>
			<td><input type="text" name="name" required></td>
		</tr>
		<tr>
			<td class="label">Description</td>
			<td><textarea rows="7" cols="60" name="description" maxlength="550"></textarea></td>
		</tr>
		<tr>
			<td class="label">Price</td>
			<td><input type="number" name="price" required></td>
		</tr>
		<tr>
			<td class="label">Stock</td>
			<td><input type="number" name="stock" value="25" min="0" max="1000" required></td>
		</tr>
		<tr>
			<td class="label">Category</td>
			<td><select name="category">
				  <option value="Lip">Lip</option>
				  <option value="Face">Face</option>
				  <option value="Eye">Eye</option>
				  <option value="Accessories">Accessories</option>
				</select>
		</td>
		</tr>
		<tr>
			<td align="center">
				<input type="submit" name="action" value="Add">
			</td>
			<td align="center">
				<input type="reset" name="clear" value="Clear">
			</td>
		</tr>
	</table>
	</form>
</center>
</div>