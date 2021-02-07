
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DATA ALAT BERAT PERUSAHAAN - UBAH ::: PAJAK ALAT BERAT - KOTA DUMAI</title>
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
		$kodeInvent = $_GET['kodeInvent'];
		$data = mysqli_query($conn, "select datauser.*, alatberat.*, merkalat.*, typealat.*, inventaris.* from datauser, alatberat, merkalat, typealat, inventaris where datauser.kodeAkses=inventaris.kodeAkses and merkalat.kodeMerk=typealat.kodeMerk and typealat.kodeType=alatberat.kodeType and alatberat.kodeAB=inventaris.kodeAB and inventaris.kodeInvent='$kodeInvent'");
		while($res = mysqli_fetch_array($data))
{
		$nama = $res['nama'];
		$merk = $res['merk'];
		$type = $res['type'];
		$tahun = $res['tahun'];
		$noRangka = $res['noRangka'];
		$noMesin = $res['noMesin'];
		$njkb = $res['njkb'];
		$alamat = $res['alamat'];
		$warna = $res['warna'];

		
	}
	
	if(isset($_POST['bbn'])){
		header("Location: dabusbbn.php?kodeInvent=$kodeInvent");	
		}
	
	if(isset($_POST['oke'])){
		$warna = strtoupper($_POST['warna']);
		$noRangka = strtoupper($_POST['noRangka']);
		$noMesin = strtoupper($_POST['noMesin']);
		
		$update = mysqli_query($conn, "UPDATE inventaris SET warna='$warna', noRangka='$noRangka', noMesin='$noMesin' WHERE kodeInvent='$kodeInvent'");
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
  <form name="editDabus" method="POST" action="">
  <table border="0" width="65%" class="info">
  <tr>
  <td width="19%">Nama Perusahaan</td>
  <td width="1%">:</td>
  <td width="30%"><input type="text" name="nama" id="nama" disabled="disabled" value="<?php echo $nama;?>"/></td>
  <td width="19%">Alamat</td>
  <td width="1%">:</td>
  <td width="30%"><input type="text" name="alamat" id="alamat" disabled="disabled" value="<?php echo $alamat;?>"/></td>
  </tr>
  <tr>
  <td>Merk</td>
  <td>:</td>
  <td><input type="text" name="merk" id="merk" disabled="disabled" value="<?php echo $merk;?>"></td>
  <td>Type</td>
  <td>:</td>
  <td><input type="text" name="type" id="type" disabled="disabled" value="<?php echo $type;?>"></td>
  </tr><tr>
  <td>Tahun Pembuatan</td>
  <td>:</td>
  <td><input type="text" name="tahun" id="tahun" disabled="disabled" value="<?php echo $tahun;?>"></td>
  <td>Nilai Jual</td>
  <td>:</td>
  <td><input type="text" name="njkb" id="njkb" disabled="disabled" value="<?php echo $njkb;?>"/></td>
  </tr>

  <tr><td colspan=6><label> &nbsp;</label></td></tr><tr>
  <td>Nomor Rangka</td>
  <td>:</td>
  <td><input type="text" name="noRangka" id="noRangka" required="required" value="<?php echo $noRangka;?>"/></td>
  <td>Nomor Mesin</td>
  <td>:</td>
  <td><input type="text" name="noMesin" id="noMesin" required="required" value="<?php echo $noMesin;?>"/></td>
  </tr>
  <tr><tr>
  <td colspan=6 align="center">Warna : <input type="text" name="warna" id="warna" required="required" value="<?php echo $warna;?>"/></td>
  </tr>
  </table>
  <br /><br />
  <input type="submit" name="oke" id="oke" value="    Edit    " />
  <input type="button" name="batal" id="batal" value=" Kembali " onclick="window.location.href='dabus.php'"/>
</form>
<br /><br />
<form name="gobbn" method="post">
<input type="submit" name="bbn" id="bbn" value="Ubah Pemilik Alat Berat" />
</form> 
</center>
</body>
</html>