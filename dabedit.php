
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DATA ALAT BERAT - EDIT ::: PAJAK ALAT BERAT - KOTA DUMAI</title>
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

$kodeAB = $_GET['kodeAB'];

$dataAlat = mysqli_query($conn, "SELECT merkalat.*, typealat.*, alatberat.* from merkalat, typealat, alatberat where (merkalat.kodeMerk = typealat.kodeMerk and typealat.kodeType = alatberat.kodeType) AND(alatberat.kodeAB = '$kodeAB')");
 if (!$dataAlat) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
while($res = mysqli_fetch_array($dataAlat))
{
	$merk = $res['merk'];
	$type = $res['type'];
	$tahun = $res['tahun'];
    $njkb = $res['njkb'];
	}
if(isset($_POST['oke'])){
	$njkb = (int)$_POST['njkb'];
	$nilaiPajak = (int)$njkb * $nilai;
	
	$update = mysqli_query($conn, "UPDATE alatberat SET njkb='$njkb', nilaiPajak='$nilaiPajak' WHERE kodeAB='$kodeAB'");
	
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
  <form name="editDab" method="POST">
  <table border="0" width="25%" class="info">
  <tr>
  <td width="40%">Merk</td>
  <td width="1%">:</td>
  <td width="50%"><input type="text" name="merek" id="merek" disabled="disabled"  size=30 value="<?php echo $merk;?>"//>
  </td>
  </tr>
  <tr>
  <td>Type</td>
  <td>:</td>
  <td><input type="text" name="type" id="type" disabled="disabled" size=30 value="<?php echo $type;?>"//></td>
  </tr>
  <tr>
  <td>Tahun Pembuatan</td>
  <td>:</td>
  <td><input type="text" name="tahun" id="tahun" disabled="disabled" size=30 value="<?php echo $tahun;?>"//></td>
  </tr>
  <tr>
  <td>Nilai Jual</td>
  <td>:</td>
  <td><input type="text" name="njkb" id="njkb" size=30 value="<?php echo $njkb;?>" required="required"/></td>
  </tr>
  </table>
  <br />
  <input type="submit" name="oke" id="oke" value="Edit" />
  <input type="button" name="batal" id="batal" value="  Batal  " onclick="window.location.href='dab.php'"/>
  </form>


</center>
</body>
</html>