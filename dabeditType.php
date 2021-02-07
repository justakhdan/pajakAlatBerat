<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DATA ALAT BERAT - UBAH MERK / TYPE ::: PAJAK ALAT BERAT - KOTA DUMAI</title>
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
		
		if (isset($_GET['kodeMerk'])){
			$kodeMerk = $_GET['kodeMerk'];
			$data = mysqli_query($conn, "select * from merkalat where kodeMerk='$kodeMerk'");
			while($rowData = mysqli_fetch_array($data)){
				$isiData = $rowData['merk'];
				}
			}
		else if(isset($_GET['kodeType'])){
			$kodeType = $_GET['kodeType'];
			$data = mysqli_query($conn, "select merkalat.*, typealat.* from merkalat, typealat where merkalat.kodeMerk=typealat.kodeMerk and typealat.kodeType='$kodeType'");
			while($rowData = mysqli_fetch_array($data)){
				$kodeMerkType = $rowData['kodeMerk'];
				$merkData = $rowData['merk'];
				$isiData = $rowData['type'];
				}
			}
		else if (isset($_GET['indexJenis'])){
			$indexJenis = $_GET['indexJenis'];
			$data = mysqli_query($conn, "select * from jenisalat where indexJenis='$indexJenis'");
			while($rowData = mysqli_fetch_array($data)){
				$isiData = $rowData['jenis'];
				}
			}	
	if(isset($_POST['submitMerk'])){
		$merkBaru = strtoupper($_POST['editMerk']);
		$kodeMerkBaru = substr($merkBaru, 0, 3);
		$queryMerk = mysqli_query($conn, "update merkalat set kodeMerk='$kodeMerkBaru', merk='$merkBaru' where kodeMerk='$kodeMerk'");
		header("Location: dablihatType.php");
		}
	if(isset($_POST['submitType'])){
		$typeBaru = strtoupper($_POST['editType']);
		$kodeTypeBaru = $kodeMerkType.$typeBaru;
		$queryType=mysqli_query($conn, "update typealat set kodeType='$kodeTypeBaru', type='$typeBaru' where kodeType='$kodeType'");
		header("Location: dablihatType.php");
		}
	if(isset($_POST['submitJenis'])){
		$jenisBaru = strtoupper($_POST['editJenis']);
		$queryMerk = mysqli_query($conn, "update jenisalat set jenis='$jenisBaru' where indexJenis='$indexJenis'");
		header("Location: dablihatType.php");
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
<td align="center"><h3>ANDA LOGIN SEBAGAI : <?php echo $namaSes; ?></h3></td>
</tr>
</table>
<?php if($hakAkses == "Admin"){?>
<header>
	    <div class="nav">
      <ul>
        <li class="home"><a href="home.php">Home</a></li>
        <li class="karyawan"><a href="karyawan.php">Data Karyawan</a></li>
        <li class="daus"><a href="daus.php">Data Perusahaan</a></li>
        <li class="dab"><a class="active" href="#">Data Alat Berat</a></li>
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
        <li class="daus"><a href="daus.php">Data Perusahaan</a></li>
        <li class="dab"><a class="active" href="#">Data Alat Berat</a></li>
        <li class="dabus"><a href="dabus.php">Data Alat Berat Perusahaan</a></li>
        <li class="dapeng"><a href="dapeng.php">Data Pengajuan Alat Berat Baru</a></li>
       	</ul>
    </div>
    
  </header>
<?php } ?>
  <br /><br />
<?php if (isset($_GET['kodeMerk'])){?>
<form name="editMerk" method="post"> 
<table border="0"  class="info">
<tr>
<td>Kode Merk</td>
<td>:</td>
<td><input type="text" name="showKodeMerk" value="<?php echo $kodeMerk;?>" disabled="disabled"/></td>
</tr>
<tr>
<td>Merk</td>
<td>:</td>
<td><input type="text" name="editMerk" value="<?php echo $isiData;?>"/></td>
</tr>
</table>
<br />
<input type="submit" name="submitMerk" value="Edit" />
<input type="button" name="batal" value="Batal" onclick="window.location.href='dablihatType.php'" />
</form>

<?php } else if(isset($_GET['kodeType'])){ ?>

<form name="editType" method="post"> 
<table border="0"  class="info">
<tr>
<td>Kode Type</td>
<td>:</td>
<td><input type="text" name="showKodeType" value="<?php echo $kodeType;?>" disabled="disabled"/></td>
</tr>
<tr>
<td>Merk</td>
<td>:</td>
<td><input type="text" name="showMerk" value="<?php echo $merkData;?>" disabled="disabled"/></td>
</tr>
<td>Type</td>
<td>:</td>
<td><input type="text" name="editType" value="<?php echo $isiData;?>"/></td>
</tr>
</table>
<br />
<input type="submit" name="submitType" value="Edit" />
<input type="button" name="batal" value="Batal" onclick="window.location.href='dablihatType.php'" />
</form>

<br /><br />
<?php } else if (isset($_GET['indexJenis'])){?>
<form name="editJenis" method="post"> 
<table border="0"  class="info">
<tr>
<td>Jenis</td>
<td>:</td>
<td><input type="text" name="editJenis" value="<?php echo $isiData;?>"/></td>
</tr>
</table>
<br />
<input type="submit" name="submitJenis" value="Edit" />
<input type="button" name="batal" value="Batal" onclick="window.location.href='dablihatType.php'" />
</form>
<?php }?>

</body>
</html>