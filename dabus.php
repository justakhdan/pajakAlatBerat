
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DATA ALAT BERAT PERUSAHAAN ::: PAJAK ALAT BERAT - KOTA DUMAI</title>
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
        <li class="dab"><a href="dab.php">Data Alat Berat</a></li>
        <li class="dabus"><a class="active" href="#">Data Alat Berat Perusahaan</a></li>
        <li class="dapeng"><a href="dapeng.php">Data Pengajuan Alat Berat Baru</a></li>
       	</ul>
    </div>
    
  </header>
  
  <br /><br />
  
  <form action="dabus.php" method="post">
  <label> Cari Berdasarkan Nomor Rangka : </label>
  
  <input type="text" name="cari" />
  <input type="submit" value="Cari" />
  </form><br /><br />
  <table border="0" width="80%"><tr><td align="right"><input type="button" name="tambah" id="tambah" onclick="window.location.href='dabustunggakan.php'" value="Lihat Tunggakan Pajak" /><input type="button" name="tambah" id="tambah" onclick="window.location.href='dabustambah.php'" value="Tambah Alat Berat" /></td></tr></table>
  <table border="0" width="80%" class="cantik">
    <tr align="center">
    <th width="16%">Nama</th>
    <th width="16%">Merk</th>
    <th width="16%">Type</th>
    <th width="16%">Tahun Buat</th>
    <th width="16%">Nomor Rangka</th>
    <th width="5%">LIHAT</th>
    <th width="5%">EDIT</th>
    <th width="5%">CETAK</th>
    <th width="5%">HAPUS</th>
    </tr>
    <?php
	$halaman = 5;
	$page = isset($_GET['halaman'])? (int)$_GET["halaman"]: 1;
	$mulai = ($page>1)?($page * $halaman) - $halaman : 0;
	if(isset($_POST['cari'])){
		$cari = $_POST['cari'];
		$result = mysqli_query($conn, "select datauser.*, alatberat.*, merkalat.*, typealat.*, inventaris.* from datauser, alatberat, merkalat, typealat, inventaris where (datauser.kodeAkses=inventaris.kodeAkses and merkalat.kodeMerk=typealat.kodeMerk and typealat.kodeType=alatberat.kodeType and alatberat.kodeAB=inventaris.kodeAB) AND (inventaris.noRangka like '%".$cari."%')");
	
		$data = mysqli_query($conn, "select datauser.*, alatberat.*, merkalat.*, typealat.*, inventaris.* from datauser, alatberat, merkalat, typealat, inventaris where (datauser.kodeAkses=inventaris.kodeAkses and merkalat.kodeMerk=typealat.kodeMerk and typealat.kodeType=alatberat.kodeType and alatberat.kodeAB=inventaris.kodeAB) AND (inventaris.noRangka like '%".$cari."%') LIMIT $mulai, $halaman");
		
	}
	else{
	$result = mysqli_query($conn, "select datauser.*, alatberat.*, merkalat.*, typealat.*, inventaris.* from datauser, alatberat, merkalat, typealat, inventaris where datauser.kodeAkses=inventaris.kodeAkses and merkalat.kodeMerk=typealat.kodeMerk and typealat.kodeType=alatberat.kodeType and alatberat.kodeAB=inventaris.kodeAB");

	$data = mysqli_query($conn, "select datauser.*, alatberat.*, merkalat.*, typealat.*, inventaris.* from datauser, alatberat, merkalat, typealat, inventaris where datauser.kodeAkses=inventaris.kodeAkses and merkalat.kodeMerk=typealat.kodeMerk and typealat.kodeType=alatberat.kodeType and alatberat.kodeAB=inventaris.kodeAB LIMIT $mulai, $halaman");

	}
	$total = mysqli_num_rows($result);
	$pages = ceil($total/$halaman);
	while($row1 = mysqli_fetch_array($data)){
	echo "<tr align = 'center'>";
	echo "<td>" . $row1['nama'] . "</td>";
	echo "<td>" . $row1['merk'] . "</td>";
	echo "<td>" . $row1['type'] . "</td>";
	echo "<td>" . $row1['tahun'] . "</td>";
	echo "<td>" . $row1['noRangka'] . "</td>";
	echo "<td><a href=\"dabusdetail.php?kodeInvent=$row1[kodeInvent]\" class=\"tombol\">LIHAT</td>";
	echo "<td><a href=\"dabusEDIT.php?kodeInvent=$row1[kodeInvent]\" class=\"tombol\">EDIT</td>";
	echo "<td><a href=\"dabusCETAK.php?kodeInvent=$row1[kodeInvent]\" class=\"tombol\">CETAK</td>";
	echo "<td><a href=\"dabusHAPUS.php?kodeInvent=$row1[kodeInvent]\" onClick=\"return confirm('Apakah yakin data ini akan di HAPUS?')\" class=\"tombol1\">HAPUS</td>";
	echo "</tr>";
	}

	 ?></table>
     <br />
     <?php 


for ($i = 1;$i<=$pages;$i++){ 
?>
	<a href="?halaman=<?php echo $i; ?>"  style="text-decoration:none"> <?php echo $i;?> </a>
    
	
<?php } } else if($hakAkses == "Operator"){?>
<header>
	    <div class="nav">
      <ul>
        <li class="home"><a href="home.php">Home</a></li>
        <li class="daus"><a href="daus.php">Data Perusahaan</a></li>
        <li class="dab"><a href="dab.php">Data Alat Berat</a></li>
        <li class="dabus"><a class="active" href="#">Data Alat Berat Perusahaan</a></li>
        <li class="dapeng"><a href="dapeng.php">Data Pengajuan Alat Berat Baru</a></li>
       	</ul>
    </div>
    
  </header>


  <br /><br />
  
  <form action="dabus.php" method="post">
  <label> Cari Berdasarkan Nomor Rangka : </label>
  
  <input type="text" name="cari" />
  <input type="submit" value="Cari" />
  </form><br /><br />
  <table border="0" width="80%"><tr><td align="right"><input type="button" name="tambah" id="tambah" onclick="window.location.href='dabustambah.php'" value="Tambah Alat Berat" /></td></tr></table>
  <table border="0" width="80%" class="cantik">
    <tr align="center">
    <th width="17%">Nama</th>
    <th width="17%">Merk</th>
    <th width="17%">Type</th>
    <th width="17%">Tahun Buat</th>
    <th width="17%">Nomor Rangka</th>
    <th width="5%">LIHAT</th>
    <th width="5%">EDIT</th>
    <th width="5%">CETAK</th>
    </tr>
    <?php
	$halaman = 5;
	$page = isset($_GET['halaman'])? (int)$_GET["halaman"]: 1;
	$mulai = ($page>1)?($page * $halaman) - $halaman : 0;
	$result = mysqli_query($conn, "select datauser.*, alatberat.*, merkalat.*, typealat.*, inventaris.* from datauser, alatberat, merkalat, typealat, inventaris where datauser.kodeAkses=inventaris.kodeAkses and merkalat.kodeMerk=typealat.kodeMerk and typealat.kodeType=alatberat.kodeType and alatberat.kodeAB=inventaris.kodeAB");
	$total = mysqli_num_rows($result);
	if(isset($_POST['cari'])){
		$cari = $_POST['cari'];
		$result = mysqli_query($conn, "select datauser.*, alatberat.*, merkalat.*, typealat.*, inventaris.* from datauser, alatberat, merkalat, typealat, inventaris where (datauser.kodeAkses=inventaris.kodeAkses and merkalat.kodeMerk=typealat.kodeMerk and typealat.kodeType=alatberat.kodeType and alatberat.kodeAB=inventaris.kodeAB) AND (datauser.nama like '%".$cari."%')");
	$total = mysqli_num_rows($result);
		$data = mysqli_query($conn, "select datauser.*, alatberat.*, merkalat.*, typealat.*, inventaris.* from datauser, alatberat, merkalat, typealat, inventaris where (datauser.kodeAkses=inventaris.kodeAkses and merkalat.kodeMerk=typealat.kodeMerk and typealat.kodeType=alatberat.kodeType and alatberat.kodeAB=inventaris.kodeAB) AND (datauser.nama like '%".$cari."%') LIMIT $mulai, $halaman");
		
	}
	else{
	
	$data = mysqli_query($conn, "select datauser.*, alatberat.*, merkalat.*, typealat.*, inventaris.* from datauser, alatberat, merkalat, typealat, inventaris where datauser.kodeAkses=inventaris.kodeAkses and merkalat.kodeMerk=typealat.kodeMerk and typealat.kodeType=alatberat.kodeType and alatberat.kodeAB=inventaris.kodeAB LIMIT $mulai, $halaman");
	$total = mysqli_num_rows($result);
	}
	$pages = ceil($total/$halaman);
	while($row1 = mysqli_fetch_array($data)){
	echo "<tr align = 'center'>";
	echo "<td>" . $row1['nama'] . "</td>";
	echo "<td>" . $row1['merk'] . "</td>";
	echo "<td>" . $row1['type'] . "</td>";
	echo "<td>" . $row1['tahun'] . "</td>";
	echo "<td>" . $row1['noRangka'] . "</td>";
	echo "<td><a href=\"dabusdetail.php?kodeInvent=$row1[kodeInvent]\" class=\"tombol\">LIHAT</td>";
	echo "<td><a href=\"dabusEDIT.php?kodeInvent=$row1[kodeInvent]\" class=\"tombol\">EDIT</td>";
	echo "<td><a href=\"dabusCETAK.php?kodeInvent=$row1[kodeInvent]\" class=\"tombol\">CETAK</td>";
	echo "</tr>";
	}
	 ?></table>
     <br />
     <?php 


for ($i = 1;$i<=$pages;$i++){ ?>
	
    <a href="?halaman=<?php echo $i; ?>"  style="text-decoration:none"> <?php echo $i;?> </a>
	
<?php 
} }
?>

</center>
</body>
</html>