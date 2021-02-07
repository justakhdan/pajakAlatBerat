
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DATA ALAT BERAT ::: PAJAK ALAT BERAT - KOTA DUMAI</title>
<link rel="stylesheet" href="css/style.css" />
</head>

<body>
<center>
<?php 
session_start();
$nama = $_SESSION['nama'];
$hakAkses = $_SESSION['hakAkses'];
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
        <li class="dataalat"><a class="active" href="#">Data Alat Berat</a></li>
        <li class="pengajuan"><a href="userpengajuan.php">Pengajuan Alat Berat</a></li>
        
       	</ul>
    </div>
    
  </header>

<br /><br /><br />
  <table border="0" width="80%" class="cantik">
    <tr align="center">
    <th width="3%"><b>No.</b></th>
    <th width="22.5%"><b>Merk</b></th>
    <th width="22.5%"><b>Type</b></th>
    <th width="22.5%"><b>Tahun Buat</b></th>
    <th width="22.5%"><b>Nomor Rangka</b></th>
    <th width="8%">LIHAT</td>
    </tr>
    <?php
	$halaman = 8;
	$page = isset($_GET['halaman'])? (int)$_GET["halaman"]: 1;
	$mulai = ($page>1)?($page * $halaman) - $halaman : 0;
	$result = mysqli_query($conn, "select datauser.*, alatberat.*, merkalat.*, typealat.*, inventaris.* from datauser, alatberat, merkalat, typealat, inventaris where datauser.kodeAkses=inventaris.kodeAkses and merkalat.kodeMerk=typealat.kodeMerk and typealat.kodeType=alatberat.kodeType and alatberat.kodeAB=inventaris.kodeAB and datauser.nama='$nama'");
	$total = mysqli_num_rows($result);
	$pages = ceil($total/$halaman);
	$no = 0;
	
	$data = mysqli_query($conn, "select datauser.*, alatberat.*, merkalat.*, typealat.*, inventaris.* from datauser, alatberat, merkalat, typealat, inventaris where datauser.kodeAkses=inventaris.kodeAkses and merkalat.kodeMerk=typealat.kodeMerk and typealat.kodeType=alatberat.kodeType and alatberat.kodeAB=inventaris.kodeAB and datauser.nama='$nama' ORDER BY merkalat.merk, typealat.type, alatberat.tahun LIMIT $mulai, $halaman");
	while($row1 = mysqli_fetch_array($data)){
	$no++;
	echo "<tr align = 'center'>";
	echo "<td>" . $no . "</td>";
	echo "<td>" . $row1['merk'] . "</td>";
	echo "<td>" . $row1['type'] . "</td>";
	echo "<td>" . $row1['tahun'] . "</td>";
	echo "<td>" . $row1['noRangka'] . "</td>";
	echo "<td><a href=\"userdabdetail.php?kodeInvent=$row1[kodeInvent]\" class=\"tombol\">LIHAT</td>";
	
	echo "</tr>";
	
	}
	 ?></table><br />
     <?php 


for ($i = 1;$i<=$pages;$i++){ ?>
	
    <a href="?halaman=<?php echo $i; ?>"> <?php echo $i;?> </a>
	
<?php 
}
?>
</center>
</body>
</html>