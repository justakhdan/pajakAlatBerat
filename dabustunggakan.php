<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DATA ALAT BERAT PERUSAHAAN - TUNGGAKAN PAJAK ::: PAJAK ALAT BERAT - KOTA DUMAI</title>
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
<?php } else if($hakAkses == "Operator"){?>
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
<?php } ?>
  <br /><br />
  <table border="0" width="80%" class="cantik">
  <tr>
  <th>Nama Perusahaan</th>
  <th>Merk</th>
  <th>Type</th>
  <th>Tahun Buat</th>
  <th>Nomor Rangka</th>
  <th>Tanggal Jatuh Tempo</th>
  <th>Besar Tunggakan <br /> (Nilai Pajak x Denda 25%)</th></tr>
  <?php 
  $tanggal = strtotime(date('Y/m/d'));
  
  $total = 0;
    $queryDenda = mysqli_query($conn, "select * from dendapajak where indexDenda='1'");
	$rowDenda = mysqli_fetch_array($queryDenda);
	$kaliDenda = (float)$rowDenda['nilaiDenda'];
  $data = mysqli_query($conn, "select merkalat.*, typealat.*, alatberat.*,datauser.*, inventaris.*, pajakdasar.* from merkalat, typealat, alatberat, datauser, inventaris, pajakdasar where merkalat.kodeMerk=typealat.kodeMerk and typealat.kodeType=alatberat.kodeType and alatberat.kodeAB=inventaris.kodeAB and datauser.kodeAkses=inventaris.kodeAkses and pajakdasar.indexPajak=inventaris.indexPajak and date(inventaris.tanggalJatuhTempo)< curdate()");
  while($row = mysqli_fetch_array($data)){
	  $njkb = $row['njkb'];
	  $nilaiKaliPajak = $row['nilaiKaliPajak'];
	  $nilaiPajak = (int)$njkb * (float)$nilaiKaliPajak;
	  $tanggalJatuhTempo = strtotime($row['tanggalJatuhTempo']);
	  $selisih = ((($tanggalJatuhTempo-$tanggal))/(60*60*24));
	 
	if($selisih>=0){
	$updateDenda = (int)((int)$nilaiPajak * $kaliDenda * (0/12));
	$keterangan = "PEMBAYARAN TIDAK TELAT";	
		}
	else if($selisih>=-31){
	$updateDenda = (int)((int)$nilaiPajak * $kaliDenda * (1/12));
	$keterangan = "PEMBAYARAN TELAT 1 BULAN";	
	}
	else if($selisih>=-59 && $selisih<-31){
	$updateDenda = (int)((int)$nilaiPajak * $kaliDenda * (2/12));
	$keterangan = "PEMBAYARAN TELAT 2 BULAN";
	}
	else if($selisih>=-90 && $selisih<-59){
	$updateDenda = (int)((int)$nilaiPajak * $kaliDenda * (3/12));
	$keterangan = "PEMBAYARAN TELAT 3 BULAN";
	}
	else if($selisih>=-120 && $selisih<-90){
	$updateDenda = (int)((int)$nilaiPajak * $kaliDenda * (4/12));
	$keterangan = "PEMBAYARAN TELAT 4 BULAN";
	}
	else if($selisih>=-151 && $selisih<-120){
	$updateDenda = (int)((int)$nilaiPajak * $kaliDenda * (5/12));
	$keterangan = "PEMBAYARAN TELAT 5 BULAN";
	}
	else if($selisih>=-181 && $selisih<-151){
	$updateDenda = (int)((int)$nilaiPajak * $kaliDenda * (6/12));
	$keterangan = "PEMBAYARAN TELAT 6 BULAN";
	}
	else if($selisih>=-212 && $selisih<-181){
	$updateDenda = (int)((int)$nilaiPajak * $kaliDenda * (7/12));
	$keterangan = "PEMBAYARAN TELAT 7 BULAN";
	}
	else if($selisih>=-243 && $selisih<-212){
	$updateDenda = (int)((int)$nilaiPajak * $kaliDenda * (8/12));
	$keterangan = "PEMBAYARAN TELAT 8 BULAN";
	}
	else if($selisih>=-273 && $selisih<-243){
	$updateDenda = (int)((int)$nilaiPajak * $kaliDenda * (9/12));
	$keterangan = "PEMBAYARAN TELAT 9 BULAN";
	}
	else if($selisih>=-304 && $selisih<-273){
	$updateDenda = (int)((int)$nilaiPajak * $kaliDenda * (10/12));
	$keterangan = "PEMBAYARAN TELAT 10 BULAN";
	}
	else if($selisih>=-334 && $selisih<-304){
	$updateDenda = (int)((int)$nilaiPajak * $kaliDenda * (11/12));
	$keterangan = "PEMBAYARAN TELAT 11 BULAN";
	}
	else if($selisih<-335){
	$updateDenda = (int)((int)$nilaiPajak * $kaliDenda * (12/12));
	$keterangan = "PEMBAYARAN TELAT 1 TAHUN";
	}
	$denda = (int)$nilaiPajak + (int)$updateDenda;
	
	  ?>
	  <tr align="center">
      <td><?php echo $row['nama']; ?></td>
      <td><?php echo $row['merk']; ?></td>
      <td><?php echo $row['type']; ?></td>
      <td><?php echo $row['tahun']; ?></td>
      <td><?php echo $row['noRangka']; ?></td>
      <td><?php echo date('d F Y', strtotime($row['tanggalJatuhTempo'])); ?></td>
      <td><?php echo "Rp. " . number_format ($denda,0,',','.'); ?></td>
      
      </tr>
	<?php 
	$total = $total + $denda;
	 }
  ?>
  <tr>
  <th colspan="6" align="right">Jumlah Tunggakan Keseluruhan</th>
  <th><?php echo "Rp. " . number_format ($total,0,',','.');; ?></th>
  <tr>
  </table>
  <br /><br />
  <input type="button" name="batal" id="batal" value=" Kembali " onclick="window.location.href='dabus.php'"/>
  </center>
</body>
</html>