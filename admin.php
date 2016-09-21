<?php 
ob_start();
require 'header.php';
require 'dbconnect.php';
@session_start();
if(isset($_SESSION['access'])&&$_SESSION['access']==true){
	header('location: admin/adminpanel.php?page=orders');
}
?>
<div class="content">
<center>
<form action="admin/adminpanel.php?page=orders" method="POST" class="loginform">
<table>
	<tr>
		<td>Username</td>
		<td><input type="text" name="username"></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><input type="password" name="password"></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" name="submit" value="Login" class="loginbtn"></td>
	</tr>
</table>
</form>
</center>
</div>
<?php
require 'footer.php';
 ?>