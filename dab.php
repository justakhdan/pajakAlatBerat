<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DATA ALAT BERAT ::: PAJAK ALAT BERAT - KOTA DUMAI</title>
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

$query = "select * from alatberat";
$alat = mysqli_query($conn, $query);


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
<?php if($hakAkses == "Admin"){ ?>
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
  <br /><br />
 
	
	</p>
    <form action="dab.php" id="search" method="post">
<label> Cari Berdasarkan Type : </label>

<input type="text" name="cari" autocomplete="off">
<input type="submit" value="Cari">

</form>

<br /><br />
    <table border="0" width="70%"><tr><td align="right" > <input type="button" name="tambah" id="tambah" onclick="window.location.href='dabtambah.php'" value="Tambah Alat Berat" /></td></tr></table>
    <table border="0" width="60%" class="cantik">
    <tr align="center">
    <th width="22,5%"><b>Merk</b></th>
    <th width="22,5%"><b>Type</b></th>
    <th width="22,5%"><b>Tahun Buat</b></th>
    <th width="22,5%"><b>Nilai Jual</b></th>
    <th width="5%">EDIT</th>
    <th width="5%">HAPUS</th>
    </tr>
    <?php
	$halaman = 5;
	$page = isset($_GET['halaman'])? (int)$_GET["halaman"]: 1;
	$mulai = ($page>1)?($page * $halaman) - $halaman : 0;
	$result = mysqli_query($conn, "select * from alatberat");
	$total = mysqli_num_rows($result);
	if(isset($_POST['cari'])){
		
		$cari = $_POST['cari'];
		$query = mysqli_query($conn, "select merkalat.*, typealat.*, alatberat.* from merkalat, typealat, alatberat where (merkalat.kodeMerk = typealat.kodeMerk and typealat.kodeType = alatberat.kodeType) AND (typealat.type like '%".$cari."%') LIMIT $mulai, $halaman");
	$result = mysqli_query($conn, "select merkalat.*, typealat.*, alatberat.* from merkalat, typealat, alatberat where (merkalat.kodeMerk = typealat.kodeMerk and typealat.kodeType = alatberat.kodeType) AND (typealat.type like '%".$cari."%')");
	$total = mysqli_num_rows($result);
	}
	else{
	$query = mysqli_query($conn, "select merkalat.*, typealat.*, alatberat.* from merkalat, typealat, alatberat where merkalat.kodeMerk = typealat.kodeMerk AND typealat.kodeType = alatberat.kodeType LIMIT $mulai, $halaman");
	}
	$pages = ceil($total/$halaman);
	while($row1 = mysqli_fetch_array($query)){
	$njkb = "Rp. " . number_format ($row1['njkb'],0,',','.');
	echo "<tr align = 'center'>";
	echo "<td>" . $row1['merk'] . "</td>";
	echo "<td>" . $row1['type'] .  "</td>";
	echo "<td>" . $row1['tahun'] . "</td>";
	echo "<td>" . $njkb . "</td>";
	echo "<td><a href=\"dabedit.php?kodeAB=$row1[kodeAB]\" class=\"tombol\">EDIT</a></td>";
	echo "<td><a href=\"dabhapus.php?kodeAB=$row1[kodeAB]\" onClick=\"return confirm('Apakah yakin data ini akan di hapus?')\" class=\"tombol1\" >HAPUS</td>";
	echo "</tr>";
	}
	 ?>
    </table>
    <br />
<?php 


for ($i = 1;$i<=$pages;$i++){ ?>
	
    <a href="?halaman=<?php echo $i; ?>"  style="text-decoration:none"> <?php echo $i;?> </a>
	
<?php 
}
}
else if($hakAkses == "Operator"){
?>
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
  <br /><br />
 
	
	</p>
    <form action="dab.php" id="search" method="post">
<label> Cari Berdasarkan Type : </label>

<input type="text" name="cari" autocomplete="off">
<input type="submit" value="Cari">

</form>

<br /><br />
    <table border="0" width="70%"><tr><td align="right"> <input type="button" name="tambah" id="tambah" onclick="window.location.href='dabtambah.php'" value="Tambah Alat Berat" /></td></tr></table>
    <table border="0" width="60%" class="cantik">
    <tr align="center">
    <th width="23,75%"><b>Merk</b></th>
    <th width="23,75%"><b>Type</b></th>
    <th width="23,75%"><b>Tahun Buat</b></th>
    <th width="23,75%"><b>Nilai Jual</b></th>
    <th width="5%">EDIT</th>
    </tr>
    <?php
	$halaman = 5;
	$page = isset($_GET['halaman'])? (int)$_GET["halaman"]: 1;
	$mulai = ($page>1)?($page * $halaman) - $halaman : 0;
	$result = mysqli_query($conn, "select * from alatberat");
	$total = mysqli_num_rows($result);
	if(isset($_POST['cari'])){
		
		$cari = $_POST['cari'];
		$query = mysqli_query($conn, "select merkalat.*, typealat.*, alatberat.* from merkalat, typealat, alatberat where (merkalat.kodeMerk = typealat.kodeMerk and typealat.kodeType = alatberat.kodeType) AND (typealat.type like '%".$cari."%') LIMIT $mulai, $halaman");
	$result = mysqli_query($conn, "select merkalat.*, typealat.*, alatberat.* from merkalat, typealat, alatberat where (merkalat.kodeMerk = typealat.kodeMerk and typealat.kodeType = alatberat.kodeType) AND (typealat.type like '%".$cari."%')");
	$total = mysqli_num_rows($result);
	}
	else{
	$query = mysqli_query($conn, "select merkalat.*, typealat.*, alatberat.* from merkalat, typealat, alatberat where merkalat.kodeMerk = typealat.kodeMerk AND typealat.kodeType = alatberat.kodeType LIMIT $mulai, $halaman");
	}
	$pages = ceil($total/$halaman);
	while($row1 = mysqli_fetch_array($query)){
	$njkb = "Rp. " . number_format ($row1['njkb'],0,',','.');
	echo "<tr align = 'center'>";
	echo "<td>" . $row1['merk'] . "</td>";
	echo "<td>" . $row1['type'] .  "</td>";
	echo "<td>" . $row1['tahun'] . "</td>";
	echo "<td>" . $njkb . "</td>";
	echo "<td><a href=\"dabedit.php?kodeAB=$row1[kodeAB]\" class=\"tombol\">EDIT</a></td>";
	echo "</tr>";
	}
	 ?>
    </table>
    <br />
<?php 


for ($i = 1;$i<=$pages;$i++){ ?>
	
    <a href="?halaman=<?php echo $i; ?>" style="text-decoration:none"> <?php echo $i;?> </a>
	

<?php }} ?>

</center>
</body>
</html>

