
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DATA PERUSAHAAN ::: PAJAK ALAT BERAT - KOTA DUMAI</title>
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
<td align="center"><h3>ANDA LOGIN SEBAGAI : <?php echo $namaSes; ?> </h3></td>
</tr>
</table>

<?php if($hakAkses == "Admin"){?>
<header>
	    <div class="nav">
      <ul>
        <li class="home"><a href="home.php">Home</a></li>
        <li class="karyawan"><a href="karyawan.php">Data Karyawan</a></li>
        <li class="daus"><a class="active" href="#">Data Perusahaan</a></li>
        <li class="dab"><a href="dab.php">Data Alat Berat</a></li>
        <li class="dabus"><a href="dabus.php">Data Alat Berat Perusahaan</a></li>
        <li class="dapeng"><a href="dapeng.php">Data Pengajuan Alat Berat Baru</a></li>
       	</ul>
    </div>
    
  </header>
  <br /><br />
	<p>DATA PERUSAHAAN : </p>
    <table border="0" width="60%" class="cantik">
    <tr align="center">
    <th width="30%"><b>Nama Perusahaan</b></th>
    <th width="30%"><b>Nomor Telepon</b></th>
    <th width="30%"><b>Email</b></th>
    <th width="5%">EDIT</th>
    <th width="5%">HAPUS</th>
    </tr>
    <?php
	$halaman = 5;
	$page = isset($_GET['halaman'])? (int)$_GET["halaman"]: 1;
	$mulai = ($page>1)?($page * $halaman) - $halaman : 0;
	$result = mysqli_query($conn, "select datauser.*, login.* from datauser, login where datauser.kodeAkses = login.kodeAksesUser and login.hakAkses = 'Perusahaan'");
	$total = mysqli_num_rows($result);
	$pages = ceil($total/$halaman);
	$perusahaan = mysqli_query($conn, "select datauser.*, login.* from datauser, login where datauser.kodeAkses = login.kodeAksesUser and login.hakAkses = 'Perusahaan' LIMIT $mulai, $halaman");
	while($row = mysqli_fetch_array($perusahaan)){
	echo "<tr align = 'center'>";
	echo "<td>" . $row['nama'] . "</td>";
	echo "<td>" . $row['nomorTelepon'] . "</td>";
	echo "<td>" . $row['email'] ."</td>";
	echo "<td><a href=\"dausEDIT.php?kodeAkses=$row[kodeAkses]\" class=\"tombol\">EDIT</a></td>";
	echo "<td><a href=\"dausHAPUS.php?kodeAkses=$row[kodeAkses]\" onClick=\"return confirm('Apakah yakin data ini akan di HAPUS?')\" class=\"tombol1\">HAPUS</a></td>";
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
	<p>DATA PERORANGAN : </p>
    <table border="0" width="60%" class="cantik">
    <tr align="center">
    <th width="30%"><b>Nama Perorangan</b></th>
    <th width="30%"><b>Nomor Telepon</b></th>
    <th width="30%"><b>Email</b></th>
    <th width="5%">EDIT</th>
    <th width="5%">HAPUS</th>
    </tr>
    <?php
	$halaman1 = 5;
	$page1 = isset($_GET['halaman1'])? (int)$_GET["halaman1"]: 1;
	$mulai1 = ($page1>1)?($page1 * $halaman1) - $halaman1 : 0;
	$result1 = mysqli_query($conn, "select datauser.*, login.* from datauser, login where datauser.kodeAkses = login.kodeAksesUser and login.hakAkses = 'Perorangan'");
	$total1 = mysqli_num_rows($result1);
	$pages1 = ceil($total1/$halaman1);
	$perorangan = mysqli_query($conn, "select datauser.*, login.* from datauser, login where datauser.kodeAkses = login.kodeAksesUser and login.hakAkses = 'Perorangan' LIMIT $mulai1, $halaman1");
	while($row1 = mysqli_fetch_array($perorangan)){
	echo "<tr align = 'center'>";
	echo "<td>" . $row1['nama'] . "</td>";
	echo "<td>" . $row1['nomorTelepon'] . "</td>";
	echo "<td>" . $row1['email'] ."</td>";
	echo "<td><a href=\"dausEDIT.php?kodeAkses=$row1[kodeAkses]\" class=\"tombol\">EDIT</a></td>";
	echo "<td><a href=\"dausHAPUS.php?kodeAkses=$row1[kodeAkses]\" onClick=\"return confirm('Apakah yakin data ini akan di HAPUS?')\" class=\"tombol1\">HAPUS</td>";
	echo "</tr>";
	}
	 ?>
    </table><br />
    <?php 


for ($ii = 1;$ii<=$pages1;$ii++){ ?>
	
    <a href="?halaman1=<?php echo $ii; ?>" style="text-decoration:none"> <?php echo $ii;?> </a>
	
<?php 
}
?>
    <br /><br />
    
    <input type="button" id="tambahUser" name="tambahUser" value="Tambah Data" onclick="window.location.href='daustambah.php'"/> 
  	
<?php } else if($hakAkses == "Operator"){?>
<header>
	    <div class="nav">
      <ul>
        <li class="home"><a href="home.php">Home</a></li>
        <li class="daus"><a class="active" href="#">Data Perusahaan</a></li>
        <li class="dab"><a href="dab.php">Data Alat Berat</a></li>
        <li class="dabus"><a href="dabus.php">Data Alat Berat Perusahaan</a></li>
        <li class="dapeng"><a href="dapeng.php">Data Pengajuan Alat Berat Baru</a></li>
       	</ul>
    </div>
    
  </header>
  <br /><br />
	<p>DATA PERUSAHAAN : </p>
    <table border="0" width="60%" class="cantik">
    <tr align="center">
    <th width="31%"><b>Nama Perusahaan</b></th>
    <th width="31%"><b>Nomor Telepon</b></th>
    <th width="31%"><b>Email</b></th>
    <th width="7%">EDIT</th>
    </tr>
    <?php
	$halaman = 5;
	$page = isset($_GET['halaman'])? (int)$_GET["halaman"]: 1;
	$mulai = ($page>1)?($page * $halaman) - $halaman : 0;
	$result = mysqli_query($conn, "select datauser.*, login.* from datauser, login where datauser.kodeAkses = login.kodeAksesUser and login.hakAkses = 'Perusahaan'");
	$total = mysqli_num_rows($result);
	$pages = ceil($total/$halaman);
	$perusahaan = mysqli_query($conn, "select datauser.*, login.* from datauser, login where datauser.kodeAkses = login.kodeAksesUser and login.hakAkses = 'Perusahaan' LIMIT $mulai, $halaman");
	while($row = mysqli_fetch_array($perusahaan)){
	echo "<tr align = 'center'>";
	echo "<td>" . $row['nama'] . "</td>";
	echo "<td>" . $row['nomorTelepon'] . "</td>";
	echo "<td>" . $row['email'] ."</td>";
	echo "<td><a href=\"dausEDIT.php?kodeAkses=$row[kodeAkses]\" class=\"tombol\">EDIT</a></td>";
	echo "</tr>";
	}
	 ?>
    </table><br />
    <?php 


for ($i = 1;$i<=$pages;$i++){ ?>
	
    <a href="?halaman=<?php echo $i; ?>" style="text-decoration:none"> <?php echo $i;?> </a>
	
<?php 
}
?>
    <br /><br />
	<p>DATA PERORANGAN : </p>
    <table border="0" width="60%" class="cantik">
    <tr align="center">
    <th width="31%"><b>Nama Perorangan</b></th>
    <th width="31%"><b>Nomor Telepon</b></th>
    <th width="31%"><b>Email</b></th>
    <th width="7%">EDIT</th>
    </tr>
    <?php
	$halaman1 = 5;
	$page1 = isset($_GET['halaman1'])? (int)$_GET["halaman1"]: 1;
	$mulai1 = ($page1>1)?($page1 * $halaman1) - $halaman1 : 0;
	$result1 = mysqli_query($conn, "select datauser.*, login.* from datauser, login where datauser.kodeAkses = login.kodeAksesUser and login.hakAkses = 'Perorangan'");
	$total1 = mysqli_num_rows($result1);
	$pages1 = ceil($total1/$halaman1);
	$perorangan = mysqli_query($conn, "select datauser.*, login.* from datauser, login where datauser.kodeAkses = login.kodeAksesUser and login.hakAkses = 'Perorangan' LIMIT $mulai1, $halaman1");
	while($row1 = mysqli_fetch_array($perorangan)){
	echo "<tr align = 'center'>";
	echo "<td>" . $row1['nama'] . "</td>";
	echo "<td>" . $row1['nomorTelepon'] . "</td>";
	echo "<td>" . $row1['email'] ."</td>";
	echo "<td><a href=\"dausEDIT.php?kodeAkses=$row1[kodeAkses]\" class=\"tombol\">EDIT</a></td>";
	echo "</tr>";
	}
	 ?>
    </table><br />
    <?php 


for ($ii = 1;$ii<=$pages1;$ii++){ ?>
	
    <a href="?halaman1=<?php echo $ii; ?>" style="text-decoration:none"> <?php echo $ii;?> </a>
	
<?php 
}
?>
    <br /><br />
    
    <input type="button" id="tambahUser" name="tambahUser" value="Tambah Data" onclick="window.location.href='daustambah.php'"/> 
  	
<?php } ?>
  

</center>
</body>
</html>