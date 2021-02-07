<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MASTER DATA - PAJAK ::: PAJAK ALAT BERAT - KOTA DUMAI</title>
<link rel="stylesheet" href="css/style.css" />
</head>

<body>
<center>
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
	if (isset($_GET['indexPajak'])){
			$indexPajak = $_GET['indexPajak'];
			$data = mysqli_query($conn, "select * from pajakdasar where indexPajak='$indexPajak'");
			while($rowData = mysqli_fetch_array($data)){
				$isiNilai = $rowData['nilaiKaliPajak'];
				$isiKet = $rowData['keteranganPajak'];
				}
			}
	else if (isset($_GET['indexTTD'])){
			$indexTTD = $_GET['indexTTD'];
			$dataTTD = mysqli_query($conn, "select * from tandatangan where indexTTD='$indexTTD'");
			while($rowDataTTD = mysqli_fetch_array($dataTTD)){
				$nama = $rowDataTTD['nama'];
				$jabatan = $rowDataTTD['jabatan'];
				$ket = $rowDataTTD['keterangan'];
				}
			}	
			else if (isset($_GET['indexDenda'])){
			$indexDenda = $_GET['indexDenda'];
			$dataDenda = mysqli_query($conn, "select * from dendapajak where indexDenda='$indexDenda'");
			while($rowDataDenda = mysqli_fetch_array($dataDenda)){
				$nilaiDenda = $rowDataDenda['nilaiDenda'];
				$ketDenda = $rowDataDenda['keteranganDenda'];
				}
			}	
			
			if(isset($_POST['submitNilai'])){
				$nilaiBaru = $_POST['editNilai'];
				$ketBaru = strtoupper($_POST['editKet']);
				$queryNilai = mysqli_query($conn, "update pajakdasar set nilaiKaliPajak='$nilaiBaru', keteranganPajak='$ketBaru' where indexPajak='$indexPajak'");
				header("Location: master.php");
				}
				
			if(isset($_POST['submitNilaiBaru'])){
				$tambahNilai = $_POST['tambahNilai'];
				$tambahKet = strtoupper($_POST['tambahKet']);
				$queryNilai = mysqli_query($conn, "insert into pajakdasar (nilai, keteranganPajak) values ('$tambahNilai', '$tambahKet')");
				header("Location: master.php");
				}
			if(isset($_POST['submitTTD'])){
				$tambahNama = strtoupper($_POST['nama']);
				$tambahJabatan = strtoupper($_POST['jabatan']);
				$tambahKet = strtoupper($_POST['keterangan']);
				$queryTTD = mysqli_query($conn, "update tandatangan set nama='$tambahNama', jabatan='$tambahJabatan', keterangan='$tambahKet' where indexTTD='$indexTTD'");
				header("Location: master.php");
				}
			if(isset($_POST['submitDenda'])){
				$dendaBaru = $_POST['nilaiDenda'];
				$ketBaru = strtoupper($_POST['ketDenda']);
				$queryDenda = mysqli_query($conn, "update dendapajak set nilaiDenda='$dendaBaru', keteranganDenda='$ketBaru' where indexDenda='$indexDenda'");
				header("Location: master.php");
				}
?>
<table border="0" align="center" width="100%">
<tr>
<td rowspan="2" align="right"><img src="images/logoRiau.png" height="123,5" width="83,75" /></td>
<td align="center"><h2>SELAMAT DATANG DI WEBSITE PERPAJAKAN ALAT BERAT KOTA DUMAI PROVINSI RIAU</h2></td>
<td rowspan="2"><img src="images/logoDumai.png" height="123,5" width="100" /></td>
</tr>

<tr>
<td align="center"><h3>ANDA LOGIN SEBAGAI : <?php echo $namaSes; ?> </h3></td>
</tr>
</table>
<?php if($hakAkses == "Admin"){?>
<header>
	    <div class="nav">
      <ul>
        <li class="home"><a href="home.php">Home</a></li>
        <li class="karyawan"><a href="karyawan.php">Data Karyawan</a></li>
        <li class="daus"><a href="daus.php">Data Perusahaan</a></li>
        <li class="dab"><a href="dab.php">Data Alat Berat</a></li>
        <li class="dabus"><a href="dabus.php">Data Alat Berat Perusahaan</a></li>
        <li class="dapeng"><a href="dapeng.php">Data Pengajuan Alat Berat Baru</a></li>
       	</ul>
    </div>
    
  </header>

<?php } else if($hakAkses=="Operator"){?>
<header>
	    <div class="nav">
      <ul>
        <li class="home"><a href="home.php">Home</a></li>
        <li class="daus"><a href="daus.php">Data Perusahaan</a></li>
        <li class="dab"><a href="dab.php">Data Alat Berat</a></li>
        <li class="dabus"><a href="dabus.php">Data Alat Berat Perusahaan</a></li>
        <li class="dapeng"><a href="dapeng.php">Data Pengajuan Alat Berat Baru</a></li>
       	</ul>
    </div>
    
  </header>
 
<?php } ?>
 <br /><br />
<?php if(isset($_GET['indexTTD'])){?>
<form name="editTTD" method="post">
<table border="0" class="info">
<tr>
<td>Nama</td>
<td>:</td>
<td><input type="text" name="nama" size="30" value="<?php echo $nama;?>"/></td>
</tr>
<tr>
<td>Jabatan</td>
<td>:</td>
<td><input type="text" name="jabatan" size="30" value="<?php echo $jabatan;?>"/></td>
</tr>
<tr>
<td>Keterangan (NRP/NIP/NPP)</td>
<td>:</td>
<td><input type="text" name="keterangan" size="30" value="<?php echo $ket;?>"/></td>
</tr>
</table>
<input type="submit" name="submitTTD" value="Edit" />
<input type="button" name="batal" value="Batal" onclick="window.location.href='master.php'" />
</form>

<?php } else if (isset($_GET['indexPajak'])){?>
<form name="editPajak" method="post"> 
<table border="0"  class="info">
<tr>
<td>Nilai Pajak (dalam bentuk desimal)</td>
<td>:</td>
<td><input type="text" name="editNilai" value="<?php echo $isiNilai;?>" required="required"/></td>
<td>contoh: 0.0003 (0.3/100)</td>
</tr>
<tr>
<td>Keterangan</td>
<td>:</td>
<td><input type="text" name="editKet" value="<?php echo $isiKet;?>" required="required"/></td>
</tr>
</table>
<br />
<input type="submit" name="submitNilai" value="Edit" />
<input type="button" name="batal" value="Batal" onclick="window.location.href='master.php'" />
</form>

<?php } else if (isset($_GET['indexDenda'])){?>
<form name="editDenda" method="post"> 
<table border="0"  class="info">
<tr>
<td>Nilai Denda (dalam bentuk desimal)</td>
<td>:</td>
<td><input type="text" name="nilaiDenda" value="<?php echo $nilaiDenda;?>" required="required"/></td>
<td>contoh: 0.0003 (0.3/100)</td>
</tr>
<tr>
<td>Keterangan</td>
<td>:</td>
<td><input type="text" name="ketDenda" value="<?php echo $ketDenda;?>" required="required"/></td>
</tr>
</table>
<br />
<input type="submit" name="submitDenda" value="Edit" />
<input type="button" name="batal" value="Batal" onclick="window.location.href='master.php'" />
</form>

<?php } else {?> 
<form name="tambahPajak" method="post"> 
<table border="0"  class="info">
<tr>
<td>Nilai Pajak (dalam bentuk desimal)</td>
<td>:</td>
<td><input type="text" name="tambahNilai" value="" required="required"/></td>
<td>contoh: 0.0003 (0.3/100)</td>
</tr>
<tr>
<td>Keterangan</td>
<td>:</td>
<td><input type="text" name="tambahKet" value="" required="required"/></td>
</tr>
</table>
<br />
<input type="submit" name="submitNilaiBaru" value="Tambah" />
<input type="button" name="batal" value="Batal" onclick="window.location.href='master.php'" />
</form>
<?php }  ?>
 </center>
 </body>
 </html>