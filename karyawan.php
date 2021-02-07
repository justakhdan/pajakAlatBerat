<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DATA KARYAWAN ::: PAJAK ALAT BERAT - KOTA DUMAI</title>
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
		if($hakAkses!="Admin"){
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
<td align="center"><h3>ANDA LOGIN SEBAGAI : <?php echo $namaSes; ?> </h3></td>
</tr>
</table>

<header>
	    <div class="nav">
      <ul>
        <li class="home"><a href="home.php">Home</a></li>
        <li class="karyawan"><a class="active" href="#">Data Karyawan</a></li>
        <li class="daus"><a href="daus.php">Data Perusahaan</a></li>
        <li class="dab"><a href="dab.php">Data Alat Berat</a></li>
        <li class="dabus"><a href="dabus.php">Data Alat Berat Perusahaan</a></li>
        <li class="dapeng"><a href="dapeng.php">Data Pengajuan Alat Berat Baru</a></li>
       	</ul>
    </div>
    
  </header>
  <br /><br />
  
  <form action="karyawan.php" method="post" autocomplete="off">
  <label> Cari Berdasarkan Nama : </label>
  
  <input type="text" name="cari" />
  <input type="submit" value="Cari" />
  </form><br /><br />
  <table border="0" width="80%"><tr><td align="right"><input type="button" name="tambah" id="tambah" onclick="window.location.href='karyawantambah.php'" value="Tambah Data" /></td></tr></table>
  <table border="0" width="80%" class="cantik">
    <tr align="center">
    <th width="30%"><b>Nama</b></th>
    <th width="30%"><b>Nomor Telepon</b></th>
    <th width="30%"><b>Email</b></th>
    <th width="5%">EDIT</th>
    <th width="5%">HAPUS</th>
    </tr>
    <?php
	$halaman = 5;
	$page = isset($_GET['halaman'])? (int)$_GET["halaman"]: 1;
	$mulai = ($page>1)?($page * $halaman) - $halaman : 0;
	$result = mysqli_query($conn, "select datakaryawan.*, login.* from datakaryawan, login where datakaryawan.kodeAkses=login.kodeAksesKaryawan");
	$total = mysqli_num_rows($result);
	if(isset($_POST['cari'])){
		$cari = $_POST['cari'];
		$data = mysqli_query($conn, "select datakaryawan.*, login.* from datakaryawan, login where (datakaryawan.kodeAkses=login.kodeAksesKaryawan) AND (datakaryawan.nama like '%".$cari."%') LIMIT $mulai, $halaman");
		$result = mysqli_query($conn, "select datakaryawan.*, login.* from datakaryawan, login where (datakaryawan.kodeAkses=login.kodeAksesKaryawan) AND (datakaryawan.nama like '%".$cari."%')");
	$total = mysqli_num_rows($result);
	}
	else{
	
	$data = mysqli_query($conn, "select datakaryawan.*, login.* from datakaryawan, login where datakaryawan.kodeAkses=login.kodeAksesKaryawan LIMIT $mulai, $halaman");
	$total = mysqli_num_rows($result);
	}
	$pages = ceil($total/$halaman);
	while($row1 = mysqli_fetch_array($data)){
	echo "<tr align = 'center'>";
	echo "<td>" . $row1['nama'] . "</td>";
	echo "<td>" . $row1['nomorTelepon'] . "</td>";
	echo "<td>" . $row1['email'] . "</td>";
	echo "<td><a href=\"karyawanubah.php?kodeAkses=$row1[kodeAkses]\" class=\"tombol\">EDIT</td>";
	echo "<td><a href=\"karyawanhapus.php?kodeAkses=$row1[kodeAkses]\" onClick=\"return confirm('Apakah yakin data ini akan di hapus?')\" style=\"text-decoration:none\" class=\"tombol1\">HAPUS</td>";
	echo "</tr>";
	}
	 ?></table>
     <br />
     <?php 


for ($i = 1;$i<=$pages;$i++){ ?>
	
    <a href="?halaman=<?php echo $i; ?>"  style="text-decoration:none"> <?php echo $i;?> </a>
	
<?php }?>
</center>
</body>
</html>