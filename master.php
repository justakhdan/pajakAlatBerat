<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MASTER DATA ::: PAJAK ALAT BERAT - KOTA DUMAI</title>
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
        <li class="dabus"><a href="dabus.php">Data Alat Berat Perusahaan</a></li>
        <li class="dapeng"><a href="dapeng.php">Data Pengajuan Alat Berat Baru</a></li>
       	</ul>
    </div>
    
  </header>

<?php } else if($hakAkses=="Operator"){?>
<header>
	    <div class="nav">
      <ul>
        <li class="home"><a href="home.php">Home</a></li>
        <li class="daus"><a href="daus.php">Data Perusahaan</a></li>
        <li class="dab"><a href="dab.php">Data Alat Berat</a></li>
        <li class="dabus"><a href="dabus.php">Data Alat Berat Perusahaan</a></li>
        <li class="dapeng"><a href="dapeng.php">Data Pengajuan Alat Berat Baru</a></li>
       	</ul>
    </div>
    
  </header>
 
<?php } ?>
 <br /><br />
 <div style="width:800px;">
 <table border="0" align="left" class="cantik">
 <tr><th colspan="3">KETERANGAN PAJAK</th></tr>
 <?php 
 $queryPajak = mysqli_query($conn, "select * from pajakdasar");
 while($rowPajak = mysqli_fetch_array($queryPajak)){
 ?>
 <tr align="center"><th><?php echo $rowPajak['keteranganPajak']; ?></th><td><?php echo $rowPajak['nilaiKaliPajak']; ?></td>
 <?php echo "<td><a href=\"mastereditpajak.php?indexPajak=$rowPajak[indexPajak]\" class=\"tombol\">edit</a></td>";?>
  </tr>
 <?php } ?>
 
 </table>
 
 <table border="0" align="right" class="cantik">
 <tr><th colspan="3">DENDA</th></tr>
 <?php 
 $queryDenda = mysqli_query($conn, "select * from dendapajak");
 while($rowDenda = mysqli_fetch_array($queryDenda)){?> 
 <tr align="center"><th><?php echo $rowDenda['keteranganDenda'];?></th><td><?php echo $rowDenda['nilaiDenda'];?></td><?php echo "<td><a href=\"mastereditpajak.php?indexDenda=$rowDenda[indexDenda]\" class=\"tombol\">edit</a></td>";?></tr>
 <?php }
 ?>
 </table>
 </div>
 <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
 <div>
 <table border="0" align="center" class="cantik">
 <tr><th colspan="4">TANDA TANGAN PKB</th></tr>
 <?php 
 $queryTTD = mysqli_query($conn, "select * from tandatangan");
 while($rowTTD = mysqli_fetch_array($queryTTD)){?>
	<tr align="center"><th><?php echo $rowTTD['jabatan'];?></th><td><?php echo $rowTTD['nama'];?></td><td><?php echo $rowTTD['keterangan'];?></td><?php echo "<td><a href=\"mastereditpajak.php?indexTTD=$rowTTD[indexTTD]\" class=\"tombol\">edit</a></td>";?></tr>		
	<?php } ?>
 
 </table>
 </div>
 </center>
 </body>
 </html>