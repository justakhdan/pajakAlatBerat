
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DATA PENGAJUAN ALAT BERAT PERUSAHAAN ::: PAJAK ALAT BERAT - KOTA DUMAI</title>
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
<td align="center"><h2>SELAMAT DATANG DI WEBSITE PERPAJAKAN ALAT BERAT KOTA DUMAI PROVINSI RIAU</h3></td>
<td rowspan="2"><img src="images/logoDumai.png" height="123,5" width="100" /></td>
</tr>

<tr>
<td align="center"><h3>ANDA LOGIN SEBAGAI : <?php echo $namaSes; ?></h4></td>
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
        <li class="dapeng"><a class="active" href="#" >Data Pengajuan Alat Berat Baru</a></li>
       	</ul>
    </div>
    
  </header>
<?php } else if($hakAkses == "Operator"){?>
<header>
	    <div class="nav">
      <ul>
        <li class="home"><a href="home.php">Home</a></li>
        <li class="daus"><a href="daus.php">Data Perusahaan</a></li>
        <li class="dab"><a href="dab.php">Data Alat Berat</a></li>
        <li class="dabus"><a href="dabus.php">Data Alat Berat Perusahaan</a></li>
        <li class="dapeng"><a class="active" href="#" >Data Pengajuan Alat Berat Baru</a></li>
       	</ul>
    </div>
    
  </header>
<?php } ?>
  <br /><br />
<label> DAFTAR PENGAJUAN BARU </label><br /><br />
<table border="0" width="80%" class="cantik">
    <tr align="center">
    <th width="5%"><b>No.</b></th>
    <th width="17%"><b>Tanggal Pengajuan</b></th>
    <th width="17%"><b>Nama Perusahaan</b></th>
    <th width="17%"><b>Merk</b></th>
    <th width="17%"><b>Type</b></th>
    <th width="17%"><b>Tahun Pembuatan</b></th>
    <th width="5%">SETUJU</th>
    <th width="5%">TIDAK</th>
    </tr>
    <?php
	$halaman = 5;
	$page = isset($_GET['halaman'])? (int)$_GET["halaman"]: 1;
	$mulai = ($page>1)?($page * $halaman) - $halaman : 0;
	$result = mysqli_query($conn, "select pengajuan.*, datauser.*, merkalat.*, typealat.*, alatberat.* from pengajuan, datauser, merkalat, typealat, alatberat where merkalat.kodeMerk=typealat.kodeMerk and typealat.kodeType=alatberat.kodeType and alatberat.kodeAB=pengajuan.kodeAB and datauser.kodeAkses=pengajuan.kodeAkses and pengajuan.status='On Progress'");
	$total = mysqli_num_rows($result);
	$pages = ceil($total/$halaman);
	$no = 0;
	$data = mysqli_query($conn, "select pengajuan.*, datauser.*, merkalat.*, typealat.*, alatberat.* from pengajuan, datauser, merkalat, typealat, alatberat where merkalat.kodeMerk=typealat.kodeMerk and typealat.kodeType=alatberat.kodeType and alatberat.kodeAB=pengajuan.kodeAB and datauser.kodeAkses=pengajuan.kodeAkses and pengajuan.status='On Progress' LIMIT $mulai, $halaman");
	while($row1 = mysqli_fetch_array($data)){
	$no++;	
	echo "<tr align = 'center'>";
	echo "<td>". $no ."</td>";
	echo "<td>" . date('d F Y', strtotime($row1['tanggalPengajuan'])) . "</td>";
	echo "<td>" . $row1['nama'] . "</td>";
	echo "<td>" . $row1['merk'] . "</td>";
	echo "<td>" . $row1['type'] . "</td>";
	echo "<td>" . $row1['tahun'] . "</td>";
	echo "<td><a href=\"dapengtambah.php?kodeAju=$row1[kodeAju]\" class=\"tombol\">+</td>";
	echo "<td><a href=\"dapenghapus.php?kodeAju=$row1[kodeAju]\" onClick=\"return confirm('Data ini tidak disetujui?')\" class=\"tombol1\">X</td>";
	echo "</tr>";
	}
	 ?>
    </table>
    <br />
     <?php 


for ($i = 1;$i<=$pages;$i++){ ?>
	
    <a href="?halaman=<?php echo $i; ?>" style="text-decoration:none"> <?php echo $i;?> </a>
	
<?php 
}
?>
    <br /><br />
    <label> RIWAYAT PENGAJUAN</label><br /><br />
    <table border=0 width="80%" class="cantik">
    <tr align="center">
    <th width="5,2%"><b>No.</b></th>
    <th width="15,8%"><b>Nama Perusahaan</b></th>
    <th width="15,8%"><b>Merk</b></th>
    <th width="15,8%"><b>Type</b></th>
    <th width="15,8%"><b>Tahun Pembuatan</b></th>
    <th width="15,8%"><b>No. Rangka</b></th>
    <th width="15,8%"><b>Status</b></th>
    </tr>
    <?php
	$halaman1 = 5;
	$page1 = isset($_GET['halaman1'])? (int)$_GET["halaman1"]: 1;
	$mulai1 = ($page1>1)?($page1 * $halaman1) - $halaman1 : 0;
	$result1 = mysqli_query($conn, "select pengajuan.*, datauser.*, merkalat.*, typealat.*, alatberat.* from pengajuan, datauser, merkalat, typealat, alatberat where merkalat.kodeMerk=typealat.kodeMerk and typealat.kodeType=alatberat.kodeType and alatberat.kodeAB=pengajuan.kodeAB and datauser.kodeAkses=pengajuan.kodeAkses");
	$total1 = mysqli_num_rows($result1);
	$pages1 = ceil($total1/$halaman1);
	$no1=0;
	$data1 = mysqli_query($conn, "select pengajuan.*, datauser.*, merkalat.*, typealat.*, alatberat.* from pengajuan, datauser, merkalat, typealat, alatberat where merkalat.kodeMerk=typealat.kodeMerk and typealat.kodeType=alatberat.kodeType and alatberat.kodeAB=pengajuan.kodeAB and datauser.kodeAkses=pengajuan.kodeAkses and pengajuan.status!='On Progress' LIMIT $mulai1, $halaman1");
	while($row2 = mysqli_fetch_array($data1)){
	$no1++;
	echo "<tr align = 'center'>";
	echo "<td>". $no1 ."</td>";	
	echo "<td>" . $row2['nama'] . "</td>";
	echo "<td>" . $row2['merk'] . "</td>";
	echo "<td>" . $row2['type'] . "</td>";
	echo "<td>" . $row2['tahun'] . "</td>";
	echo "<td>" . $row2['noRangka'] . "</td>";
	echo "<td>" . $row2['status'] . "</td>"; 
	echo "</tr>";
	}
	 ?>
    </table>
    <br />
    <?php 


for ($ii = 1;$ii<=$pages1;$ii++){ ?>
	
    <a href="?halaman1=<?php echo $ii; ?>" style="text-decoration:none"> <?php echo $ii;?> </a>
	
<?php 
}
?>
</center>
</body>
</html>