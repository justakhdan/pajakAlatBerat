
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PENGAJUAN ALAT BERAT BARU - TAMBA  ::: PAJAK ALAT BERAT - KOTA DUMAI</title>
<link rel="stylesheet" href="css/style.css" />
</head>

<body>
<center>
<?php 
session_start();
$nama = $_SESSION['nama'];
$hakAkses = $_SESSION['hakAkses'];
$kodeAkses = $_SESSION['kodeAkses'];
if(!isset($nama)){
	header("Location:./index.php");
	}
	else{
		if($hakAkses=="Perusahaan"){
			
			}
		else if($hakAkses=="Perorangan"){
			
			}
		else{
			header("Location:./index.php");
			session_destroy();
			}		
		}
		include("configDB.php");
	
if(isset($_POST['oke'])){
	$noRangka = strtoupper($_POST['noRangka']);
	$noMesin = strtoupper($_POST['noMesin']);
	$warna = strtoupper($_POST['warna']);
	$kodeAB = $_POST['kodeAB'];
	$tanggalPengajuan = date('Y/m/d');
	$foto = $_FILES['foto']['name'];
	$fotoTemp = $_FILES['foto']['tmp_name'];
	$faktur = $_FILES['faktur']['name'];
	$fakturTemp = $_FILES['faktur']['tmp_name'];

		$sqlCode = "SELECT max(kodeAju) as maxcode FROM pengajuan";
		$queryCode = mysqli_query($conn, $sqlCode) or die (mysqli_error());
		$arrayCode = mysqli_fetch_array($queryCode);
		if($arrayCode){
		$nilai = substr($arrayCode['maxcode'], 3);
		$kode = (int) $nilai;
 		$kode = $kode + 1;
		$kodeAju = "AJU" .str_pad($kode, 4, "0",  STR_PAD_LEFT);
		}
		
	$lokasiFoto = "C:/xampp/htdocs/PajakAlber/file/foto/$kodeAju-";
	$lokasiFaktur = "C:/xampp/htdocs/PajakAlber/file/faktur/$kodeAju-";
	$uploadFoto = move_uploaded_file($fotoTemp, $lokasiFoto.$foto);
	$uploadFaktur = move_uploaded_file($fakturTemp, $lokasiFaktur.$faktur);
			
	$update = mysqli_query($conn, "insert into pengajuan (kodeAju, warna, noRangka, noMesin, tanggalPengajuan, dataFaktur, dataGambar, status , kodeAkses, kodeAB) values ('$kodeAju', '$warna', '$noRangka', '$noMesin', '$tanggalPengajuan', '$kodeAju-$faktur' , '$kodeAju-$foto' ,'On Progress', '$kodeAkses', '$kodeAB')");
	}
	
	
?>
<table border="0" align="center" width="100%">
<tr>
<td rowspan="2" align="right"><img src="images/logoRiau.png" height="123,5" width="83,75" /></td>
<td align="center"><h2>SELAMAT DATANG DI WEBSITE PERPAJAKAN ALAT BERAT KOTA DUMAI PROVINSI RIAU</h2></td>
<td rowspan="2"><img src="images/logoDumai.png" height="123,5" width="100" /></td>
</tr>

<tr>
<td align="center"><h3>ANDA LOGIN SEBAGAI : <?php echo $nama; ?> </h3></td>
</tr>
</table>
<header>
	    <div class="nav">
      <ul>
        <li class="home"><a href="userhome.php">Home</a></li>
        <li class="dataalat"><a href="userdab.php">Data Alat Berat</a></li>
        <li class="pengajuan"><a class="active" href="#">Pengajuan Alat Berat</a></li>
        
       	</ul>
    </div>
    
  </header>
  <br /><br /><br />
  <form name="" method="POST">
  <label> Masukkan Type : </label>

<input type="text" name="cari" autocomplete="off">
<input type="submit" value="Cari">
  </form><br />
  <form method="post" autocomplete="off" enctype="multipart/form-data">
  <table border="0" width="50%" align="center" class="cantik">
  <tr>
  	<th width="1%">(option)</th>
    <th width="33%" align="center"><b>Merk</b></th>
    <th width="33%" align="center"><b>Type</b></th>
    <th width="33%" align="center"><b>Tahun</b></th>
  </tr>
  <?php 
  
  	$halaman = 5;
	$page = isset($_GET['halaman'])? (int)$_GET["halaman"]: 1;
	$mulai = ($page>1)?($page * $halaman) - $halaman : 0;
	$result = mysqli_query($conn, "select merkalat.*, typealat.*, alatberat.* from merkalat, typealat, alatberat where merkalat.kodeMerk=typealat.kodeMerk and typealat.kodeType=alatberat.kodeType");
	$total = mysqli_num_rows($result);
	if(isset($_POST['cari'])){
		$cari = $_POST['cari'];
	$que = mysqli_query($conn, "select merkalat.*, typealat.*, alatberat.* from merkalat, typealat, alatberat where (merkalat.kodeMerk = typealat.kodeMerk and typealat.kodeType = alatberat.kodeType) AND (typealat.type like '%".$cari."%') ORDER BY merkalat.merk, typealat.type, alatberat.tahun LIMIT $mulai, $halaman ");
	}
	else{
		$que = mysqli_query($conn, "select merkalat.*, typealat.*, alatberat.* from merkalat, typealat, alatberat where merkalat.kodeMerk = typealat.kodeMerk and typealat.kodeType = alatberat.kodeType ORDER BY merkalat.merk, typealat.type, alatberat.tahun LIMIT $mulai, $halaman ");
		}
	$pages = ceil($total/$halaman);
	
  while ($row = mysqli_fetch_array($que)){
	?> 
    <tr align="center">
	<td><input type="radio" name="kodeAB" value="<?php echo $row['kodeAB'];?>"</td>
    <td><?php echo $row['merk'];?></td>
    <td><?php echo $row['type'];?></td>
    <td><?php echo $row['tahun'];?></td>
    </tr>
	<?php  
	  }
  
  ?>
  </table>
  <br />
  <?php 
  
	for ($i = 1;$i<=$pages;$i++){ ?>
	
    <a href="?halaman=<?php echo $i; ?>"> <?php echo $i;?> </a>
	
<?php 
}
  ?>
  <br /><br />
  <table class="info">
  <tr><td>Warna</td> <td>:</td> <td><input type="text" name="warna" id="warna" required="required"/></td></tr>
  <tr><td>Nomor Rangka</td> <td>:</td> <td><input type="text" name="noRangka" id="noRangka" required="required"/></td></tr>
  <tr><td>Nomor Mesin</td> <td>:</td> <td><input type="text" name="noMesin" id="noMesin" required="required"/></td></tr>
  </table>
  <br />
  <table class="info" width="50%">
  <tr align="center"><td>Foto Alat (.jpg)</td><td>Faktur Pembelian (.pdf)</td></tr>
  <tr align="center"><td><input type="file" name="foto" accept="image/jpeg" required="required"/></td><td><input type="file" name="faktur" accept="application/pdf" required="required"/></td></tr>
  </table>
  <br />
  <input type="submit" name="oke" id="oke" value="Tambah"/>
  </form>
  <br />
  <input type="button" name="riwayat" id="riwayat" value="Riwayat Pengajuan" onclick="window.location.href='userriwayat.php'"/>
</center>

</body>
</html>