<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DATA ALAT BERAT - TAMBAH MERK / TYPE ::: PAJAK ALAT BERAT - KOTA DUMAI</title>
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

if(isset($_POST['submitMerk'])){
	$inputMerk = strtoupper($_POST['inputMerk']);
	$kodeMerk = substr($inputMerk, 0, 3);
	$sqlMerk = mysqli_query($conn, "insert into merkalat (kodeMerk, merk) values ('$kodeMerk', '$inputMerk')");
	}

if(isset($_POST['submitType'])){
	$pilihMerk = $_POST['pilihMerk'];
	$inputType = strtoupper($_POST['inputType']);
	$jenis = $_POST['pilihJenis'];
	$sqlType = mysqli_query($conn, "insert into typealat (kodeType, type, kodeMerk, indexJenis) values ('$pilihMerk$inputType', '$inputType', '$pilihMerk', '$jenis')");
	}
	
if(isset($_POST['submitJenis'])){
	$inputJenis = strtoupper($_POST['inputJenis']);
	$sqlMerk = mysqli_query($conn, "insert into jenisalat (jenis) values ('$inputJenis')");
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
 
	<form name="tambahType" method="post">
    <table width="25%" class="info">
    <tr>
    <td width="40%">Merk</td>
    <td width="10%">:</td>
    <td width="49%"><select name="pilihMerk">
    <?php 
	$getMerk = mysqli_query($conn, "select * from merkalat");
	while ($row = mysqli_fetch_array($getMerk)){
		?> 
		<option value="<?php echo $row['kodeMerk']; ?>"><?php echo $row['merk']; ?></option>
		<?php
		}
	?>
    </select></td>
    </tr>
    <tr>
    <td>Type</td>
    <td>:</td>
    <td><input type="text" name="inputType" required="required"/></td>
    </tr>
    <tr>
    <td>Jenis</td>
    <td>:</td>
    <td><select name="pilihJenis">
    <?php 
	$queryGetJenis = mysqli_query($conn, "select * from jenisalat");
	while($rowJenis = mysqli_fetch_array($queryGetJenis)){
	?>
	<option value="<?php echo $rowJenis['indexJenis']; ?>"><?php echo $rowJenis['jenis']; ?></option>
	<?php	
		}
	?>
    </select></td>
    </tr>
    </table><br />

    <input type="submit" name="submitType" value="Tambah" />
    <input type="button" name="kembali" id="kembali" onclick="window.location.href='dabtambah.php'" value="Kembali" />
    </form>
    <br /><br /><br />
    <form name="tambahMerk" method="post">
    <label> Apabila Merk belum terdaftar, masukkan disini terlebih dahulu</label><br /><br />
   	<table width="25%" class="info">
    <tr>
    <td width="41%">Merk</td>
    <td width="10%">:</td>
    <td width="49%"><input type="text" name="inputMerk" required="required"/></td>
    </tr>
    </table>
    <br />
    <input type="submit" name="submitMerk" value="Tambah" />
    </form>
    <br /><br /><br />
    <form name="tambahJenis" method="post">
    <label> Apabila Jenis belum terdaftar, masukkan disini terlebih dahulu</label><br /><br />
   	<table width="25%" class="info">
    <tr>
    <td width="41%">Jenis</td>
    <td width="10%">:</td>
    <td width="49%"><input type="text" name="inputJenis" required="required"/></td>
    </tr>
    </table>
    <br />
    <input type="submit" name="submitJenis" value="Tambah" />
    </form>
    <br /><br />
    
    <input type="button" name="kembali" id="kembali" onclick="window.location.href='dablihatType.php'" value="Lihat Data Merk / Type" />
    </center>
</body>
</html>