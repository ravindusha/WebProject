<?php
	require '../dbconnect.php';
	@session_start();
	if(isset($_POST['action'])){
		if ($_POST['action']=='Update') {
			$getpass = mysqli_query($con,'select * from admin where username="admin"');
			$pass = mysqli_fetch_object($getpass);
			$currentpass= $pass->password;
			$enteredpass = hash('sha256', $_POST['oldpass']);
			$pass1 = hash('sha256', $_POST['password1']);
			$pass2 = hash('sha256', $_POST['password2']);

			if($currentpass==$enteredpass) {
				if ($pass1!=$pass2) {
					$_SESSION['error2']="Entered passwords do not match";
				}else{
					mysqli_query($con,'update admin set password="'.$pass1.'" where username="admin"');
					$_SESSION['message']="Password Updated Successfully!";
				}
			}else{
				$_SESSION['error1']="Incorrect password";
			}
		}
	}
?>
<div class="content">
<center>
	<h2>Change Password</h2>
	<h4><?php if(isset($_SESSION['message'])){echo $_SESSION['message'];unset($_SESSION['message']); }?></h4>
	<form action="" method="POST" class="accountform">
	<table>
	<tr>
		<td>Old Password</td>
		<td><input type="password" name="oldpass" required><?php if(isset($_SESSION['error1'])){echo "<br>*".$_SESSION['error1'];unset($_SESSION['error1']); }?></td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td>New Password</td>
		<td><input type="password" name="password1" minlength="8" required></td>
	</tr>
	<tr>
		<td>Confirm Password</td>
		<td><input type="password" name="password2" minlength="8" required><?php if(isset($_SESSION['error2'])){echo "<br>*".$_SESSION['error2'];unset($_SESSION['error2']); }?></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" name="action" value="Update" class="changebtn"></td>
	</tr>
	</table>
	</form>
</center>
</div>