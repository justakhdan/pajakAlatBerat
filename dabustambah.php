
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DATA ALAT BERAT PERUSAHAAN - BALIK NAMA ::: PAJAK ALAT BERAT - KOTA DUMAI</title>
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


if(isset($_POST['oke'])){
	$kodeAkses = $_POST['kodeAkses'];
	$kodeAB = $_POST['kodeAB'];
	$warna = strtoupper($_POST['warna']);
	$noRangka = strtoupper($_POST['noRangka']);
	$noMesin = strtoupper($_POST['noMesin']);
	$tanggalSekarang = date('Y/m/d');
	$cekTanggalMasuk = $_POST['tanggalMasuk'];
	if (strtotime($cekTanggalMasuk) < strtotime($tanggalSekarang)){
		$tanggalMasuk = $cekTanggalMasuk;
		}
	else{
		$tanggalMasuk = $tanggalSekarang;
		}	
		
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
		
	$update = mysqli_query($conn, "INSERT INTO inventaris (kodeInvent, noRangka, noMesin, warna, tanggalMasuk, tanggalJatuhTempo, kodeAB, kodeAkses) values ('$kodeInvent', '$noRangka', '$noMesin', '$warna', '$tanggalMasuk','$tanggalJatuhTempo', '$kodeAB', '$kodeAkses')");
	$tambah = mysqli_query($conn, "insert into pajakinventaris (kodeInvent, indexPajak, indexDenda) values ('$kodeInvent', '1', '1')");
	
	?> 
	<script>window.alert("Data Berhasil Ditambah");</script>
	<?php
	header("Location: dabus.php");
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
  <form name="tambahDabus" method="POST" action="" autocomplete="off">
  <table border="0" width="55%" class="info">
  <tr>
  <td colspan=6 align="center">Kode Perusahaan : <select name="kodeAkses" id="kodeAkses" onchange='changeValueUser(this.value)'><option value="" selected="selected">---------</option>
  <?php 
  $query = mysqli_query($conn, "select * from datauser");
  $userArray = "var userKode = new Array();\n";
  while($user = mysqli_fetch_array($query)){
  echo '<option value="'.$user['kodeAkses'].'">' .$user['kodeAkses'].'</option>';
  $userArray .="userKode['" . $user['kodeAkses'] . "'] = {nama:'" . addslashes($user['nama']) . "', alamat:'" . addslashes($user['alamat']) . "'};\n";
  }
  ?>
  </select></td>
  </tr>
  <tr>
  <td>Nama</td>
  <td>:</td>
  <td><input type="text" name="nama" id="nama" disabled="disabled"></td>
  <td width="19%">Alamat</td>
  <td width="1%">:</td>
  <td width="30%"><textarea cols=20 rows=2 name="alamat" id="alamat" disabled="disabled"></textarea></td>
  </tr> <tr><td colspan=6><label> &nbsp;</label></td></tr><tr></tr>
  <tr>
  <td colspan=6 align="center">Kode Alat Berat :  <select name="kodeAB" id = "kodeAB" onchange='changeValueAlat(this.value)'><option value="" selected="selected">---------</option>
  <?php 
  $query1 = mysqli_query($conn, "select merkalat.*, typealat.*, alatberat.* from merkalat, typealat, alatberat where merkalat.kodeMerk = typealat.kodeMerk AND typealat.kodeType = alatberat.kodeType");
  $alatArray = "var alatKode = new Array();\n";
  while($alat = mysqli_fetch_array($query1)){
  echo '<option value="'.$alat['kodeAB'].'">' .$alat['kodeAB'].'</option>';
  $alatArray .="alatKode['" . $alat['kodeAB'] . "'] = {merk:'" . addslashes($alat['merk']) . "', type:'" . addslashes($alat['type']) . "', tahun:'" . addslashes($alat['tahun']) . "', njkb:'" . addslashes("Rp. " . number_format ($alat['njkb'],0,',','.')) . "'};\n";
  }
  
  ?>
  </select></td>
  </tr>
  <tr>
  <td>Merk</td>
  <td>:</td>
  <td><input type="text" name="merk" id="merk" disabled="disabled"></td>
  <td>Type</td>
  <td>:</td>
  <td><input type="text" name="type" id="type" disabled="disabled"></td>
  </tr><tr>
  <td>Tahun Pembuatan</td>
  <td>:</td>
  <td><input type="text" name="tahun" id="tahun" disabled="disabled"></td>
  <td>Nilai Jual</td>
  <td>:</td>
  <td><input type="text" name="njkb" id="njkb" disabled="disabled"/></td>
  </tr>
  <tr><td colspan=6><label> &nbsp;</label></td></tr><tr>
  <td>Nomor Rangka</td>
  <td>:</td>
  <td><input type="text" name="noRangka" id="noRangka" required="required"/></td>
  <td>Nomor Mesin</td>
  <td>:</td>
  <td><input type="text" name="noMesin" id="noMesin" required="required"/></td>
  </tr>
  <tr>
  <td>Warna</td>
  <td>:</td>
  <td><input type="text" name="warna" id="warna" required="required"/></td>
  <td>Tanggal</td>
  <td>:</td>
  <td><input type="date" name="tanggalMasuk" id="tanggalMasuk" required="required"/></td>
  </tr>
  
  </table>
  <br /><br />
  
  <input type="submit" name="oke" id="oke" value="Tambah" />
  <input type="button" name="batal" id="batal" value=" Kembali " onclick="window.location.href='dabus.php'"/>
</form>
</center>
</body>
</html>

<script type="text/javascript">
<?php echo $alatArray; ?>
function changeValueAlat(id){
	document.getElementById('merk').value = alatKode[id].merk;
	document.getElementById('type').value = alatKode[id].type;
	document.getElementById('tahun').value = alatKode[id].tahun;
	document.getElementById('njkb').value = alatKode[id].njkb;
	
	
	
	}
<?php echo $userArray; ?>
function changeValueUser(id){
	document.getElementById('alamat').value = userKode[id].alamat;
	document.getElementById('nama').value = userKode[id].nama;
	
	
	}

</script>