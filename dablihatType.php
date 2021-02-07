<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DATA ALAT BERAT - LIHAT MERK / TYPE ::: PAJAK ALAT BERAT - KOTA DUMAI</title>
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

  <table border="0" class="cantik">

<tr><th colspan="2">DATA MERK</th></tr>
<tr><th>Merk</th><th>Edit</th></tr>
<?php
	
	$queryMerk = mysqli_query($conn, "select * from merkalat");
	while($rowMerk = mysqli_fetch_array($queryMerk)){?> 
	<tr><td><?php echo $rowMerk['merk'];?></td>
	<?php 
	echo "<td><a href=\"dabeditType.php?kodeMerk=$rowMerk[kodeMerk]\" class=\"tombol\">edit</a></td>";
	?>
	</tr>
	<?php } ?>
	</table>
    <br /><br />
    <table border="0" class="cantik">

	<tr><th colspan="3">DATA TYPE</th></tr>
	<tr><th>Merk</th><th>Type</th><th>Edit</th></tr>
	<?php
	$queryType = mysqli_query($conn, "select merkalat.*, typealat.* from merkalat, typealat where merkalat.kodeMerk=typealat.kodeMerk");
	while($rowType = mysqli_fetch_array($queryType)){?> 
	<tr><td><?php echo $rowType['merk'];?></td><td><?php echo $rowType['type'];?></td>
	<?php 
	echo "<td><a href=\"dabeditType.php?kodeType=$rowType[kodeType]\" class=\"tombol\">edit</a></td>";
	?>
	</tr>
	<?php }?>
	</table>
    <br /><br />
    
    <br /><br />
    <table border="0" class="cantik">

	<tr><th colspan="3">DATA JENIS</th></tr>
	<tr><th>Jenis</th><th>Type</th></tr>
	<?php
	$queryJenis = mysqli_query($conn, "select * from jenisalat");
	while($rowJenis = mysqli_fetch_array($queryJenis)){?> 
	<tr><td><?php echo $rowJenis['jenis'];?></td>
	<?php 
	echo "<td><a href=\"dabeditType.php?indexJenis=$rowJenis[indexJenis]\" class=\"tombol\">edit</a></td>";
	?>
	</tr>
	<?php }?>
	</table>
    <br /><br />
    <input type="button" name="kembali" id="kembali" onclick="window.location.href='dabtambahType.php'" value="Kembali" />
    </center>
</body>
</html>