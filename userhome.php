
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
$nama = $_SESSION['nama'];
$hakAkses = $_SESSION['hakAkses'];
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
        <li class="home"><a class="active" href="#">Home</a></li>
        <li class="dataalat"><a href="userdab.php">Data Alat Berat</a></li>
        <li class="pengajuan"><a href="userpengajuan.php">Pengajuan Alat Berat</a></li>
        
       	</ul>
    </div>
    
  </header>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

<footer>
<div class="log">
    <ul>
    
    	<li class="logout"><a href="logout.php">KELUAR</a></li>
    </ul></div>
</footer>
</center>
</body>
</html>