
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DATA PERUSAHAAN - TAMBAH ::: PAJAK ALAT BERAT - KOTA DUMAI</title>
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
		
	$pesanError = "";
	
if(isset($_POST['oke'])){
	
	$nama = trim(strtoupper($_POST['nama']));
    $alamat = trim(strtoupper($_POST['alamat']));
	$no = $_POST['no'];
	$rt = $_POST['rt'];
	$rw = $_POST['rw'];
	$kodePos = $_POST['kodePos'];
	$kelurahan = strtoupper($_POST['kelurahan']);
	$kecamatan = strtoupper($_POST['kecamatan']);
	$nomorTelepon = $_POST['nomorTelepon'];
	$email = strtolower($_POST['email']);
	$username = strtolower($_POST['username']);
	$password = strtolower($_POST['password']);
	$hakAkses = $_POST['hakAkses'];
	
	
	if($hakAkses=="Perusahaan"){
		$sql = "SELECT max(kodeAksesUser) as maxcode FROM login where hakAkses='Perusahaan'";
		$query = mysqli_query($conn, $sql) or die (mysqli_error());
		$arrayCode = mysqli_fetch_array($query);
		if($arrayCode){
		$nilai = substr($arrayCode['maxcode'], 1);
		$kode = (int) $nilai;
 		$kode = $kode + 1;
		$kodeAkses = "P" .str_pad($kode, 4, "0",  STR_PAD_LEFT);
		} else {
		$kodeAkses = "P0001";
		}
	}
	else{
		$sql = "SELECT max(kodeAksesUser) as maxcode FROM login where hakAkses='Perorangan'";
		$query = mysqli_query($conn, $sql) or die (mysqli_error());
		$arrayCode = mysqli_fetch_array($query);
		if($arrayCode){
		$nilai = substr($arrayCode['maxcode'], 1);
		$kode = (int) $nilai;
 		$kode = $kode + 1;
		$kodeAkses = "U" .str_pad($kode, 4, "0",  STR_PAD_LEFT);
		} else {
		$kodeAkses = "U0001";
		}
	}
	
	$update = mysqli_query($conn, "INSERT into datauser (kodeAkses, nama, alamat, nomorTelepon, email) VALUES ('$kodeAkses', '$nama', 'JALAN $alamat, RT. $rt, RW $rw, NO. $no KELURAHAN $kelurahan, KECAMATAN $kecamatan, KODE POS $kodePos', '$nomorTelepon','$email') ");
	$update1 = mysqli_query($conn, "INSERT into login (kodeAksesUser, username, password, hakAkses) values ('$kodeAkses', '$username', '$password', '$hakAkses')");
	
	header("Location: daus.php");
	
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
        <li class="daus"><a class="active" href="#">Data Perusahaan</a></li>
        <li class="dab"><a href="dab.php">Data Alat Berat</a></li>
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
       <li class="daus"><a class="active" href="#">Data Perusahaan</a></li>
        <li class="dab"><a href="dab.php">Data Alat Berat</a></li>
        <li class="dabus"><a href="dabus.php">Data Alat Berat Perusahaan</a></li>
        <li class="dapeng"><a href="dapeng.php">Data Pengajuan Alat Berat Baru</a></li>
       	</ul>
    </div>
    
  </header>
<?php } ?>
  <br /><br />
  <form name="tambahDaus" method="POST" autocomplete="off">
  <table border="0" width="30%" class="info">
  <tr>
  <td width="49%">Perorangan / Perusahaan</td>
  <td width="1%">:</td>
  <td width="50%"><select name="hakAkses" id="hakAkses">
  <option value="Perorangan">Perorangan</option>
  <option value="Perusahaan">Perusahaan</option>
  </select>
  </td>
  </tr>
  
  <tr>
  <td>Nama</td>
  <td>:</td>
  <td><input type="text" name="nama" id="nama" size=30 required="required"/ ></td>
  </tr>
  <tr>
  <td>Alamat</td>
  <td>:</td>
  <td><input type="text" name="alamat" id="alamat" size=30 required="required"/></td>
  </tr>
  <tr>
  <td colspan="3"><table border="0" align="center">
  <tr>
  <td>No.</td><td>:</td><td><input type="text" name="no" id="no" size="2" required="required"/></td>
  <td>RT</td><td>:</td><td><input type="text" name="rt" id="rt" size="2" required="required"/></td>
  <td></td>
  <td>RW</td><td>:</td><td><input type="text" name="rw" id="rw" size="2" required="required"/></td>
  <td>Kode Pos</td><td>:</td><td><input type="text" name="kodePos" id="kodePos" size="10" required="required"/></td></tr>
  </table></td></tr>
  <tr>
  <td>Kelurahan</td>
  <td>:</td>
  <td><input type="text" name="kelurahan" id="kelurahan" size=30 required="required"/></td>
  </tr>
  <tr>
  <td>Kecamatan</td>
  <td>:</td>
  <td><input type="text" name="kecamatan" id="kecamatan" size=30 required="required"/></td>
  </tr>
  <td>Nomor Telepon</td>
  <td>:</td>
  <td><input type="text" name="nomorTelepon" id="nomorTelepon" size=30 required="required"/></td>
  <tr>
  <td>Email</td>
  <td>:</td>
  <td><input type="email" name="email" id="email" size=30 required="required"/></td>
  </tr>
  </table>
  <br /><br />
  <table border=0 width="30%">
  <tr>
  <td width="49%">Username</td>
  <td width="1%">:</td>
  <td width="50%"><input type="text" name="username" id="username" size=30 required="required"/></td>
  </tr>
  <tr>
  <td>Password</td>
  <td>:</td>
  <td><input type="password" name="password" id="password" size=30 required="required"/></td>
  </tr>
  <tr>
  <td><br /></td>
  </tr>
 
  </table>
  <br />
  <input type="submit" name="oke" id="oke" value="Tambah" />
  <input type="button" name="batal" id="batal" value="  Batal  " onclick="window.location.href='daus.php'"/>
  </form>

</center>
</body>
</html>