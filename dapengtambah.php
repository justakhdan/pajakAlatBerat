
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DATA PENGAJUAN ALAT BERAT PERUSAHAAN - TAMBAH ::: PAJAK ALAT BERAT - KOTA DUMAI</title>
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

$kodeAju = $_GET['kodeAju'];
$data = mysqli_query($conn, "select pengajuan.*, datauser.*, merkalat.*, typealat.*, alatberat.* from pengajuan, datauser, merkalat, typealat, alatberat where merkalat.kodeMerk=typealat.kodeMerk and typealat.kodeType=alatberat.kodeType and alatberat.kodeAB=pengajuan.kodeAB and datauser.kodeAkses=pengajuan.kodeAkses and pengajuan.kodeAju='$kodeAju'");

while($res=mysqli_fetch_array($data)){
	$kodeAkses = $res['kodeAkses'];
	$kodeAB = $res['kodeAB'];
	$tanggalPengajuan = date('d F Y', strtotime($res['tanggalPengajuan']));
	$nama = $res['nama'];
	$alamat = $res['alamat'];
	$merk = $res['merk'];
	$type = $res['type'];
	$tahun = $res['tahun'];
	$njkb = $res['njkb'];
	$noRangka = $res['noRangka'];
	$noMesin = $res['noMesin'];
	$warna = $res['warna'];
	$dataGambar = $res['dataGambar'];
	}
	
if(isset($_POST['oke'])){
	$getnoRangka = $_POST['noRangka'];
	$getnoMesin = $_POST['noMesin'];
	$tanggalMasuk = date('Y/m/d');
	$tanggalJatuhTempo = date('Y/m/d', strtotime($tanggalMasuk. ' +365 day'));
	
		$sqlCode = "SELECT max(kodeInvent) as maxcode FROM inventaris where kodeAkses='$kodeAkses'";
		$queryCode = mysqli_query($conn, $sqlCode) or die (mysqli_error());
		$arrayCode = mysqli_fetch_array($queryCode);
		if($arrayCode){
		$nilai = substr($arrayCode['maxcode'], 5);
		$kode = (int) $nilai;
 		$kode = $kode + 1;
		$kodeInvent = "$kodeAkses" .str_pad($kode, 3, "0",  STR_PAD_LEFT);
		}
		else{
		$kodeInvent = "$kodeAkses001";	
			}
	$insert = mysqli_query($conn, "insert into inventaris (kodeInvent, noRangka, noMesin, warna, tanggalMasuk, tanggalJatuhTempo, kodeAB, kodeAkses, kodeAju) values ('$kodeInvent', '$getnoRangka', '$getnoMesin', '$warna', '$tanggalMasuk','$tanggalJatuhTempo', '$kodeAB', '$kodeAkses', '$kodeAju')");
	
	$tambah = mysqli_query($conn, "insert into pajakinventaris (kodeInvent, indexPajak, indexDenda) values ('$kodeInvent', '1', '1')");
	$update=mysqli_query($conn, "update pengajuan set status='Disetujui' where kodeAju='$kodeAju'");
	
	
	header("Location: dapeng.php");
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
<form name="tambahDapeng" method="POST" action="">
  <table border="0" width="65%" class="info">
  <tr>
  <td width="19%">Nama Perusahaan</td>
  <td width="1%">:</td>
  <td width="30%"><input type="text" name="nama" id="nama" disabled="disabled" value="<?php echo $nama;?>"/></td>
  <td width="19%">Alamat</td>
  <td width="1%">:</td>
  <td width="30%"><textarea cols=20 rows=2 name="alamat" id="alamat" disabled="disabled"><?php echo $alamat;?></textarea></td>
  </tr>
  <tr>
  <td>Merk</td>
  <td>:</td>
  <td><input type="text" name="merk" id="merk" disabled="disabled" value="<?php echo $merk;?>"/></td>
  <td>Tahun Pembuatan</td>
  <td>:</td>
  <td><input type="text" name="tahunRakit" id="tahunRakit" disabled="disabled" value="<?php echo $tahun;?>"/></td>
  </tr><tr>
  <td>Type</td>
  <td>:</td>
  <td><input type="text" name="type" id="type" disabled="disabled" value="<?php echo $type;?>"/></td>
  <td>Nomor Rangka</td>
  <td>:</td>
  <td><input type="text" name="noRangka" id="noRangka" value="<?php echo $noRangka;?>"/></td>
  </tr><tr>
  <td>Nilai Jual Kendaraan Bermotor</td>
  <td>:</td>
  <td><input type="text" name="njkb" id="njkb" disabled="disabled" value="<?php echo "Rp. " . number_format ($njkb,0,',','.');?>"/></td>
  <td>Nomor Mesin</td>
  <td>:</td>
  <td><input type="text" name="noMesin" id="noMesin" value="<?php echo $noMesin;?>"/></td>
  </tr><tr>
  <td>Tanggal Pengajuan</td><td>:</td><td><input type="text" name="tanggalPengajuan" id="tanggalPengajuan" disabled="disabled" value="<?php echo $tanggalPengajuan;?>"/></td>
  <td>Warna Kendaraan Bermotor</td>
  <td>:</td>
  <td><input type="text" name="warna" id="warna" value="<?php echo $warna;?>"/></td>
  
  </tr>
  
  </table>
  <br />
  <table class="info" width="50%" >
  <tr align="center"><td>Foto Alat</td><td>Faktur Pembelian</td></tr>
  <?php 
  $data3 = mysqli_query($conn, "select pengajuan.*, datauser.*, merkalat.*, typealat.*, alatberat.* from pengajuan, datauser, merkalat, typealat, alatberat where merkalat.kodeMerk=typealat.kodeMerk and typealat.kodeType=alatberat.kodeType and alatberat.kodeAB=pengajuan.kodeAB and datauser.kodeAkses=pengajuan.kodeAkses and pengajuan.kodeAju='$kodeAju'");
  while($r = mysqli_fetch_assoc($data3)){ ?>
  <tr align="center"><td> <?php echo "<a href=\"download.php?dataGambar=$r[dataGambar]\" class=\"tombol\">Download</a>"; ?></td><td><?php echo "<a href=\"download1.php?dataFaktur=$r[dataFaktur]\" class=\"tombol\">Download</a>"; }?></td></tr>
  </table>
  <br /><br />
  <input type="submit" name="oke" id="oke" value="   Tambah   " />
  <input type="button" name="batal" id="batal" value=" Kembali " onclick="window.location.href='dapeng.php'"/>
</form>
</center>
</body>
</html>