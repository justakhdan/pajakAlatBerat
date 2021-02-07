<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PAJAK ALAT BERAT - KOTA DUMAI</title>
</head>

<body>
<?php
include("configDB.php");



if(isset($_POST['login'])){
	$uname = $_POST['username'];
$pass = $_POST['password'];
$login = mysqli_query($conn, "select * from login where username = '$uname' and password = '$pass'");
$rowcount = mysqli_num_rows($login);
if ($rowcount == 1) {
	session_start();
	$data = mysqli_fetch_array($login);
	$hakAkses = $data['hakAkses'];
	$kodeAksesKaryawan = $data['kodeAksesKaryawan'];
	$kodeAksesUser = $data['kodeAksesUser'];
	$_SESSION['username'] = $data['username'];
	
	$_SESSION['hakAkses'] = $hakAkses;
	
		if($hakAkses == 'Admin'){
		$nama = mysqli_query($conn, "select kodeAkses, nama from datakaryawan where kodeAkses='$kodeAksesKaryawan'");
		while($row = mysqli_fetch_assoc($nama)){
		$_SESSION['kodeAkses'] = $row['kodeAkses'];
		$_SESSION['nama'] = $row['nama'];
		
		}
		header("Location:./home.php");
		}
		
		else if($hakAkses == 'Operator'){
		$nama = mysqli_query($conn, "select kodeAkses, nama from datakaryawan where kodeAkses='$kodeAksesKaryawan'");
		while($row = mysqli_fetch_assoc($nama)){
		$_SESSION['kodeAkses'] = $row['kodeAkses'];
		$_SESSION['nama'] = $row['nama'];
		
		}
		header("Location:./home.php");
		}
		else{
		$nama = mysqli_query($conn, "select kodeAkses, nama from datauser where kodeAkses='$kodeAksesUser'");
		while($row = mysqli_fetch_assoc($nama)){
		$_SESSION['kodeAkses'] = $row['kodeAkses'];
		$_SESSION['nama'] = $row['nama'];
		
		}
		header("Location:./userhome.php");
		}
		
}
else
{
header("Location:./index.php");
}
}
?>
<center><br /><br /><br /><br /><br /><br /><br />
<h2>SELAMAT DATANG DI WEBSITE PERPAJAKAN ALAT BERAT KOTA DUMAI PROVINSI RIAU</h2>
<form method="POST">
<table border="0" align="center">

<tr>
<td height="30">Username</td>
<td>:</td>
<td><input type="text" name="username" id="username"/></td>
</tr>

<tr>
<td height="30">Password</td>
<td>:</td>
<td><input type="password" name="password" id="password"/></td>
</tr>

<tr>
<td height="30"></td>
<td></td>
<td><input type="submit" name="login" id="login" value="Login" /></td>
</tr>

</table>
</form>


</center>
</body>
</html>