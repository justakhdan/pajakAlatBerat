
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DATA ALAT BERAT - TAMBAH ::: PAJAK ALAT BERAT - KOTA DUMAI</title>
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


$queryPajak = mysqli_query($conn, "select * from pajakdasar where indexPajak='1'");
$rowPajak = mysqli_fetch_array($queryPajak);
$nilai = (float)$rowPajak['nilai'];


if(isset($_POST['oke'])){
	$kodeType = $_POST['kodeType'];
	$tahun = $_POST['tahun'];
	$njkb = (int)$_POST['njkb'];
	$subTahun = substr($tahun, 2, 2);
	$nilaiPajak = (int)$njkb * $nilai;
	$update = mysqli_query($conn, "INSERT into alatberat (kodeAB, kodeType, tahun, njkb, nilaiPajak) VALUES ('$kodeType$subTahun' ,'$kodeType',  '$tahun', '$njkb', '$nilaiPajak') ");
	
	header("Location: dab.php");
	
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
  <form name="" method="POST">
  <label> Masukkan Type : </label>

<input type="text" name="cari" autocomplete="off">
<input type="submit" value="Cari">
  </form>
  <form name="tambahDab" method="POST">
   <table border="0" width="50%" align="center" class="cantik">
  <tr>
  	<th width="2%">(option)</th>
    <th width="49%" align="center"><b>Merk</b></th>
    <th width="49%" align="center"><b>Type</b></th>
  </tr>
  <?php 
  
  	$halaman = 5;
	$page = isset($_GET['halaman'])? (int)$_GET["halaman"]: 1;
	$mulai = ($page>1)?($page * $halaman) - $halaman : 0;
	$result = mysqli_query($conn, "select merkalat.merk, typealat.* from merkalat, typealat where merkalat.kodeMerk = typealat.kodeMerk");
	$total = mysqli_num_rows($result);
	if(isset($_POST['cari'])){
		$cari = $_POST['cari'];
	$que = mysqli_query($conn, "select merkalat.merk, typealat.* from merkalat, typealat where (merkalat.kodeMerk = typealat.kodeMerk) AND (typealat.type like '%".$cari."%') LIMIT $mulai, $halaman ");
	}
	else{
		$que = mysqli_query($conn, "select merkalat.merk, typealat.* from merkalat, typealat where merkalat.kodeMerk = typealat.kodeMerk LIMIT $mulai, $halaman ");
		}
	$pages = ceil($total/$halaman);
	
  while ($row = mysqli_fetch_array($que)){
	?> 
    <tr align="center">
	<td><input type="radio" name="kodeType" value="<?php echo $row['kodeType'];?>"</td>
    <td><?php echo $row['merk'];?></td>
    <td><?php echo $row['type'];?></td>
    </tr>
	<?php  
	  }
  
  ?>
  </table>
  
  <?php 
  
	for ($i = 1;$i<=$pages;$i++){ ?>
	
    <a href="?halaman=<?php echo $i; ?>"> <?php echo $i;?> </a>
	
<?php 
}
  ?><br /><br />
  
  <table border="0" width="25%" class="info">
  <tr>
  <td width="40%">Tahun Pembuatan</td>
  <td  width="1%">:</td>
  <td width="50%">
  <?php
  $tahunAwal = 1986;
  $tahunSekarang = date('Y');
  print '<select name="tahun">';
  foreach ( range( $tahunAwal, $tahunSekarang ) as $tahunRakit ) {
    
    print '<option value="'.$tahunRakit.'"'.($tahunRakit === $tahunAwal ? ' selected="selected"' : '').'>'.$tahunRakit.'</option>';
  }
  print '</select>';
  ?></td>
  </tr>
  
  <tr>
  <td>Nilai Jual</td>
  <td>:</td>
  <td><input type="text" name="njkb" id="njkb" required="required" autocomplete="off"/></td>
  </tr>
  </table>
  <br />
  <input type="submit" name="oke" id="oke" value="Tambah" />
  <input type="button" name="batal" id="batal" value="  Batal  " onclick="window.location.href='dab.php'"/>
  
  <br /><br /><br />
  <label> (Apabila Type belum terdaftar, silahkan daftarkan terlebih dahulu disini)</label>
  <br /> <br />
  <input type="button" name="tambahType" onclick="window.location.href='dabtambahType.php'" value="Tambah Type"/>
  </form>
  <br />
  <input type="button" name="tambahType" onclick="window.location.href='dab.php'" value="Kembali"/>

</center>


</body>
</html>