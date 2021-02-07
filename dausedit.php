
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DATA PERUSAHAAN - UBAH ::: PAJAK ALAT BERAT - KOTA DUMAI</title>
<link rel="stylesheet" href="css/style.css" />
</head>

<body>
<?php
session_start();
$namaSes = $_SESSION['nama'];
$hakAkses = $_SESSION['hakAkses'];
if(!isset($namaSes)){
	header("Location:./index.php");
	}
	else{
		if($hakAkses=="Admin"){
			
			}
		else if($hakAkses=="Operator"){
			
			}
		else{
			header("Location:./index.php");
			session_destroy();
			}
		}
		include("configDB.php");

$kodeAkses = $_GET['kodeAkses'];
$dataUser = mysqli_query($conn, "select datauser.*, login.* from datauser, login where datauser.kodeAkses=login.kodeAksesUser and datauser.kodeAkses='$kodeAkses'");
 if (!$dataUser) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
while($res = mysqli_fetch_array($dataUser))
{
	$nama= $res['nama'];
    $alamat = $res['alamat'];
	$nomorTelepon = $res['nomorTelepon'];
	$email = $res['email'];
	$username = $res['username'];
	$password = $res['password'];
    
}

if(isset($_POST['edit'])){
	$nama = trim(strtoupper($_POST['nama']));
    $alamat = trim(strtoupper($_POST['alamat']));
	$nomorTelepon = $_POST['nomorTelepon'];
	$email = $_POST['email'];
	$username = strtolower($_POST['username']);
	$password = strtolower($_POST['password']);
	
	$update = mysqli_query($conn, "UPDATE datauser SET nama='$nama', alamat='$alamat', nomorTelepon='$nomorTelepon', email='$email' WHERE kodeAkses='$kodeAkses'");
	$update2 = mysqli_query($conn, "update login set username='$username', password='$password' where kodeAksesUser='$kodeAkses'");
	header("Location: daus.php");
	}
?>
<center>
<table border="0" align="center" width="100%">
<tr>
<td rowspan="2" align="right"><img src="images/logoRiau.png" height="123,5" width="83,75" /></td>
<td align="center"><h2>SELAMAT DATANG DI WEBSITE PERPAJAKAN ALAT BERAT KOTA DUMAI PROVINSI RIAU</h2></td>
<td rowspan="2"><img src="images/logoDumai.png" height="123,5" width="100" /></td>
</tr>

<tr>
<td align="center"><h3>ANDA LOGIN SEBAGAI : <?php echo $namaSes; ?> </h4></t3>
</tr>
</table>

<?php if($hakAkses == "Admin"){?>
<header>
	    <div class="nav">
      <ul>
        <li class="home"><a href="home.php">Home</a></li>
        <li class="karyawan"><a href="karyawan.php">Data Karyawan</a></li>
        <li class="daus"><a class="active" href="#">Data Perusahaan</a></li>
        <li class="dab"><a href="dab.php">Data Alat Berat</a></li>
        <li class="dabus"><a href="dabus.php">Data Alat Berat Perusahaan</a></li>
        <li class="dapeng"><a href="dapeng.php">Data Pengajuan Alat Berat Baru</a></li>
       	</ul>
    </div>
    
  </header>
<?php } else if($hakAkses == "Operator"){?>
<header>
	    <div class="nav">
      <ul>
        <li class="home"><a href="home.php">Home</a></li>
        <li class="daus"><a class="active" href="#">Data Perusahaan</a></li>
        <li class="dab"><a href="dab.php">Data Alat Berat</a></li>
        <li class="dabus"><a href="dabus.php">Data Alat Berat Perusahaan</a></li>
        <li class="dapeng"><a href="dapeng.php">Data Pengajuan Alat Berat Baru</a></li>
       	</ul>
    </div>
    
  </header>
<?php } ?>
  <br /><br />
  <form name="editUser" method="POST">
  <table border="0" width="30%" class="info">
  <tr>
  <td width="49%">Nama</td>
  <td width="1%">:</td>
  <td width="50%"><input type="text" name="nama" id="nama" size=30 value="<?php echo $nama;?>" required="required"/></td>
  </tr>
  <tr>
  <td>Alamat</td>
  <td>:</td>
  <td><textarea name="alamat" cols=20 row=2>
<?php echo $alamat;?>
  </textarea></td>
  </tr>
  <tr>
  <td>Nomor Telepon</td>
  <td>:</td>
  <td><input type="text" name="nomorTelepon" id="nomorTelepon" size=30/ value="<?php echo $nomorTelepon;?>" required="required"></td>
  </tr>
  <tr>
  <td>Email</td>
  <td>:</td>
  <td><input type="text" name="email" id="email" size=30/ value="<?php echo $email;?>" required="required"></td>
  </tr>
  </table>
  <br /><br />
  <table border=0 width="30%">
  <tr>
  <td width="49%">Username</td>
  <td width="1%">:</td>
  <td width="50%"><input type="text" name="username" id="username" size=30  value="<?php echo $username;?>" required="required"/></td>
  </tr>
  <tr>
  <td>Password</td>
  <td>:</td>
  <td><input type="password" name="password" id="password" size=30/ value="<?php echo $password;?>" required="required"></td>
  </tr>
  </table>
  <br />
  <input type="submit" name="edit" id="edit" value="  Edit  " />
  <input type="button" name="batal" id="batal" value="  Batal  " onclick="window.location.href='daus.php'"/>
  </form>
</center>
</body>
</html>