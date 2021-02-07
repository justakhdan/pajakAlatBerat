<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PENGAJUAN ALAT BERAT BARU - UBAH PENGAJUAN ::: PAJAK ALAT BERAT - KOTA DUMAI</title>
<link rel="stylesheet" href="css/style.css" />
</head>

<body>
<?php 
session_start();
$nama = $_SESSION['nama'];
$hakAkses = $_SESSION['hakAkses'];
$kodeAkses = $_SESSION['kodeAkses'];
if(!isset($nama)){
	header("Location:./index.php");
	}
	else{
		if($hakAkses=="Perusahaan"){
			
			}
		else if($hakAkses=="Perorangan"){
			
			}
		else{
			header("Location:./index.php");
			session_destroy();
			}		
		}
		include("configDB.php");
		
		$kodeAju = $_GET['kodeAju'];
		$pengajuan = mysqli_query($conn, "select pengajuan.*, datauser.*, merkalat.*, typealat.*, alatberat.* from pengajuan, datauser, merkalat, typealat, alatberat where merkalat.kodeMerk=typealat.kodeMerk and typealat.kodeType=alatberat.kodeType and alatberat.kodeAB=pengajuan.kodeAB and datauser.kodeAkses=pengajuan.kodeAkses and datauser.kodeAkses='$kodeAkses' and pengajuan.kodeAju='$kodeAju'");
		while($row = mysqli_fetch_array($pengajuan)){
			$getmerk = $row['merk'];
			$gettype = $row['type'];
			$getnoRangka = $row['noRangka'];
			$getnoMesin = $row['noMesin'];
			$getwarna = $row['warna'];
			}
		if(isset($_POST['edit'])){
			$noRangka = $_POST['noRangka'];
			$noMesin = $_POST['noMesin'];
			$warna = $_POST['warna'];
			
			$update = mysqli_query($conn, "update pengajuan set noRangka='$noRangka', noMesin='$noMesin', warna='$warna' where kodeAju='$kodeAju'");
			header("Location: userriwayat.php");
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
<td align="center"><h3>ANDA LOGIN SEBAGAI : <?php echo $nama; ?> </h3></td>
</tr>
</table>
<header>
	    <div class="nav">
      <ul>
        <li class="home"><a href="userhome.php">Home</a></li>
        <li class="dataalat"><a href="userdab.php">Data Alat Berat</a></li>
        <li class="pengajuan"><a class="active" href="#">Pengajuan Alat Berat</a></li>
        
       	</ul>
    </div>
    
  </header>
  <br /><br /><br />
  <form name="ubahPengajuan" method="post">
  <table border="0" class="info" width="50%">
  <tr align="center">
  <td>Merk</td><td>:</td><td><input type="text" name="merk" value="<?php echo $getmerk; ?>" disabled="disabled"/></td>
  <td>Type</td><td>:</td><td><input type="text" name="type" value="<?php echo $gettype; ?>" disabled="disabled"/></td>
  </tr>
  <tr align="center">
  <td>Nomor Rangka</td><td>:</td><td><input type="text" name="noRangka" value="<?php echo $getnoRangka; ?>" required="required"/></td>
  <td>Nomor Mesin</td><td>:</td><td><input type="text" name="noMesin" value="<?php echo $getnoMesin; ?>" required="required"/></td>
  </tr>
  <tr>
  <td colspan="3" align="right">Warna</td><td colspan="3">: <input type="text" name="warna" value="<?php echo $getwarna; ?>" required="required"/></td>
  </tr>
  </table>
  <br />
  <input type="submit" name="edit" id="edit" value="  Edit  " />
  <input type="button" name="batal" id="batal" value="  Batal  " onclick="window.location.href='userriwayat.php'"/>
  </form>
</center>
</body>
</html>