<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HOME ::: PAJAK ALAT BERAT - KOTA DUMAI</title>
<link rel="stylesheet" href="css/style.css" />
</head>

<body>
<center>
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
$row = mysqli_fetch_array($data);
$kodeAksesLama = $row['kodeAkses'];
$noRangka = $row['noRangka'];


 	
  
	if(isset($_POST['kembali'])){
		header("Location: dabusedit.php?kodeInvent=$kodeInvent");
		}
		
	if(isset($_POST['bbn'])){
		$kodeAksesBaru = $_POST['kodeAkses'];
		$indexPajak = $_POST['ketBBN'];
		$sqlCode = "SELECT max(kodeInvent) as maxcode FROM inventaris where kodeAkses='$kodeAksesBaru'";
		$queryCode = mysqli_query($conn, $sqlCode) or die (mysqli_error());
		$arrayCode = mysqli_fetch_array($queryCode);
		if($arrayCode){
		$nilai = substr($arrayCode['maxcode'], 5);
		$kode = (int) $nilai;
 		$kode = $kode + 1;
		$kodeInventBaru = "$kodeAksesBaru" .str_pad($kode, 3, "0",  STR_PAD_LEFT);
		}
		$getBBN = mysqli_query($conn, "select * from pajakdasar where indexPajak='$indexPajak'");
		$rowgetBBN = mysqli_fetch_array($getBBN);
		$keteranganBBN = $rowgetBBN['keteranganPajak'];
		
		$update = mysqli_query($conn, "update inventaris set kodeInvent='$kodeInventBaru', kodeAkses='$kodeAksesBaru' where noRangka='$noRangka'");
		$insert1 = mysqli_query($conn, "update pajakinventaris set indexPajak='$indexPajak' where kodeInvent='$kodeInventBaru'");
		$insert = mysqli_query($conn, "insert into riwayatbbn (noRangka, kodeAksesLama, keteranganBBN) values ('$noRangka', '$kodeAksesLama', '$keteranganBBN')");
		
		
		header("Location: dabusedit.php?kodeInvent=$kodeInventBaru");
		}
?>
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
<form name="bbn" method="post" autocomplete="off">
<table border="0" width="55%" class="info">
  <tr>
  <td colspan=6 align="center">Kode Perusahaan : <select name="kodeAkses" id="kodeAkses" onchange='changeValueUser(this.value)'><option value="" selected="selected">---------</option>
  <?php 
  $query = mysqli_query($conn, "select * from datauser where kodeAkses!='$kodeAksesLama' ");
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
  </table>
  
  <select name="ketBBN" id="ketBBN">
  <?php 
  	$queryBBN = mysqli_query($conn, "select * from pajakdasar where indexPajak!='1'");
	while($rowBBN = mysqli_fetch_array($queryBBN)){?>
	<option value="<?php echo $rowBBN['indexPajak']; ?>"><?php echo $rowBBN['keteranganPajak']; ?></option>	
		<?php }
  ?>
  </select>
  <br /><br />
  <br />
  <input type="submit" name="bbn" id="bbn" value="Edit" />
  <input type="submit" name="kembali" id="kembali" value="Kembali" />
  </form>
</center>
</body>
</html>

<script type="text/javascript">
<?php echo $userArray; ?>
function changeValueUser(id){
	document.getElementById('alamat').value = userKode[id].alamat;
	document.getElementById('nama').value = userKode[id].nama;
	
	
	}

</script>