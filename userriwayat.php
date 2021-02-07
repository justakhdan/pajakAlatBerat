<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PENGAJUAN ALAT BERAT BARU - RIWAYAT DAN PENGAJUAN ::: PAJAK ALAT BERAT - KOTA DUMAI</title>
<link rel="stylesheet" href="css/style.css" />
</head>

<body>
<center>
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
		?>
        
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
<label> DATA PENGAJUAN</label><br /><br />
    <table border=0 width="80%" class="cantik">
    <tr align="center">
    <th width="5%"><b>No.</b></th>
    <th width="22,5%"><b>Merk</b></th>
    <th width="22,5%"><b>Type</b></th>
    <th width="22,5%"><b>Tahun Pembuatan</b></th>
    <th width="22,5%"><b>No. Rangka</b></th>
    <th width="5">EDIT</th>
    </tr>
    <?php
	$halaman = 5;
	$page = isset($_GET['halaman'])? (int)$_GET["halaman"]: 1;
	$mulai = ($page>1)?($page * $halaman) - $halaman : 0;
	$result = mysqli_query($conn, "select pengajuan.*, datauser.*, merkalat.*, typealat.*, alatberat.* from pengajuan, datauser, merkalat, typealat, alatberat where merkalat.kodeMerk=typealat.kodeMerk and typealat.kodeType=alatberat.kodeType and alatberat.kodeAB=pengajuan.kodeAB and datauser.kodeAkses=pengajuan.kodeAkses and datauser.kodeAkses='$kodeAkses' and pengajuan.status='On Progress'");
	$total = mysqli_num_rows($result);
	$pages = ceil($total/$halaman);
	$no=0;
	$data = mysqli_query($conn, "select pengajuan.*, datauser.*, merkalat.*, typealat.*, alatberat.* from pengajuan, datauser, merkalat, typealat, alatberat where merkalat.kodeMerk=typealat.kodeMerk and typealat.kodeType=alatberat.kodeType and alatberat.kodeAB=pengajuan.kodeAB and datauser.kodeAkses=pengajuan.kodeAkses and datauser.kodeAkses='$kodeAkses' and pengajuan.status='On Progress' LIMIT $mulai, $halaman");
	while($row = mysqli_fetch_array($data)){
	$no++;
	echo "<tr align = 'center'>";
	echo "<td>". $no ."</td>";
	echo "<td>" . $row['merk'] . "</td>";
	echo "<td>" . $row['type'] . "</td>";
	echo "<td>" . $row['tahun'] . "</td>";
	echo "<td>" . $row['noRangka'] . "</td>";
	echo "<td> <a href=\"userubahpengajuan.php?kodeAju=$row[kodeAju]\" class=\"tombol\">EDIT</a> </td>"; 
	echo "</tr>";
	}
	 ?>
    </table>  
    <br /> <br />
    
    <label> RIWAYAT PENGAJUAN</label><br /><br />
    <table border=0 width="80%" class="cantik">
    <tr align="center">
    <th width="5%"><b>No.</b></th>
    <th width="19%"><b>Merk</b></th>
    <th width="19%"><b>Type</b></th>
    <th width="19%"><b>Tahun Pembuatan</b></th>
    <th width="19%"><b>No. Rangka</b></th>
    <th width="19%"><b>Status</b></th>
    </tr>
    <?php
	$halaman1 = 5;
	$page1 = isset($_GET['halaman1'])? (int)$_GET["halaman1"]: 1;
	$mulai1 = ($page1>1)?($page1 * $halaman1) - $halaman1 : 0;
	$result1 = mysqli_query($conn, "select pengajuan.*, datauser.*, merkalat.*, typealat.*, alatberat.* from pengajuan, datauser, merkalat, typealat, alatberat where merkalat.kodeMerk=typealat.kodeMerk and typealat.kodeType=alatberat.kodeType and alatberat.kodeAB=pengajuan.kodeAB and datauser.kodeAkses=pengajuan.kodeAkses and datauser.kodeAkses='$kodeAkses'");
	$total1 = mysqli_num_rows($result1);
	$pages1 = ceil($total1/$halaman1);
	$no1=0;
	$data1 = mysqli_query($conn, "select pengajuan.*, datauser.*, merkalat.*, typealat.*, alatberat.* from pengajuan, datauser, merkalat, typealat, alatberat where merkalat.kodeMerk=typealat.kodeMerk and typealat.kodeType=alatberat.kodeType and alatberat.kodeAB=pengajuan.kodeAB and datauser.kodeAkses=pengajuan.kodeAkses and datauser.kodeAkses='$kodeAkses' LIMIT $mulai1, $halaman1");
	while($row2 = mysqli_fetch_array($data1)){
	$no1++;
	echo "<tr align = 'center'>";
	echo "<td>". $no1 ."</td>";
	echo "<td>" . $row2['merk'] . "</td>";
	echo "<td>" . $row2['type'] . "</td>";
	echo "<td>" . $row2['tahun'] . "</td>";
	echo "<td>" . $row2['noRangka'] . "</td>";
	echo "<td>" . $row2['status'] . "</td>"; 
	echo "</tr>";
	}
	 ?>
    </table>  
    <br /> <br />
    <br />
  <input type="button" name="riwayat" id="riwayat" value="Kembali" onclick="window.location.href='userPengajuan.php'"/></center>
</body>
</html>