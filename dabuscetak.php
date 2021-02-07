<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
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

$dataInvent = mysqli_query($conn, "select datauser.*, alatberat.*, merkalat.*, typealat.*, inventaris.*, pajakdasar.*, pajakinventaris.*, dendapajak.* from datauser, alatberat, merkalat, typealat, inventaris, pajakdasar, pajakinventaris, dendapajak where datauser.kodeAkses=inventaris.kodeAkses and merkalat.kodeMerk=typealat.kodeMerk and typealat.kodeType=alatberat.kodeType and alatberat.kodeAB=inventaris.kodeAB and pajakdasar.indexPajak=pajakinventaris.indexPajak and inventaris.kodeInvent=pajakinventaris.kodeInvent and dendapajak.indexDenda=pajakinventaris.indexDenda and inventaris.kodeInvent='$kodeInvent' ");
 if (!$dataInvent) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}

while($res = mysqli_fetch_array($dataInvent))
{
	$namaa = $res['nama'];
	$alamat = $res['alamat'];
	$merk = $res['merk'];
	$type = $res['type'];
    $tahun = $res['tahun'];
	$noRangka = $res['noRangka'];
	$warna = $res['warna'];
	$noMesin = $res['noMesin'];
	$tanggalJatuhTempo = $res['tanggalJatuhTempo'];
	$nilaiKaliPajak = (float)$res['nilaiKaliPajak'];
	$njkb = (int)$res['njkb'];
	
	$tanggalJatuhTempo = date('d/m/Y', strtotime($tanggalJatuhTempo));
	
	
	}
	
	$getMax = mysqli_query($conn, "select max(noIndex) as noIndex from riwayatpajak where kodeInvent='$kodeInvent'");
	$rowMax = mysqli_fetch_array($getMax);
	$numMax = mysqli_num_rows($getMax);
	$noIndex = $rowMax['noIndex'];
	
	if((int)$noIndex<1){
		$pkb = (int) ($njkb * $nilaiKaliPajak);
		}
		else{
	$riwayat = mysqli_query($conn, "select * from riwayatpajak where noIndex='$noIndex'");
	$rowRiwayat = mysqli_fetch_array($riwayat);
	$pkb = $rowRiwayat['nilaiPajak'];
		}
		$ttda = mysqli_query($conn, "select * from tandatangan where indexTTD='1'");
		$rowttd1 = mysqli_fetch_array($ttda);
		$ttd1 = $rowttd1['nama'];
		$jabatan1 = $rowttd1['keterangan'];
		$ttdb = mysqli_query($conn, "select * from tandatangan where indexTTD='2'");
		$rowttd2 = mysqli_fetch_array($ttdb);
		$ttd2 = $rowttd2['nama'];
		$jabatan2 = $rowttd2['keterangan'];
		$ttdc = mysqli_query($conn, "select * from tandatangan where indexTTD='3'");
		$rowttd3 = mysqli_fetch_array($ttdc);
		$ttd3 = $rowttd3['nama'];
		$jabatan3 = $rowttd3['keterangan'];
	?>
<h3>SURAT KETETAPAN PAJAK DAERAH PKB/BBN-KB DAN SWDKLLJ</h3>


<table border=0>
<tr><td width="30"></td><td><font size="2">NAMA PEMILIK</font></td><td width="40"></td><td><font size="2"><?php echo $namaa;?></font></td></tr>
<tr><td></td><td><font size="2">ALAMAT</font></td><td></td><td><font size="2"><?php echo $alamat;?></font></td></tr>
</table>
<br />
<br />

<table border=0>
<tr><td width="10"></td><td width="100"><font size="2"> MERK / TYPE</font></td><td width="30"></td><td><font size="2"><?php echo $merk.' / '.$type;?></font></td><td width="500"></td><td><font size="2"><?php echo $pkb;?></td><td width="50"></td><td><font size="2">PKB</font></td></tr>
<tr><td></td><td><font size="2">TH PEMBUATAN / PERAKITAN</font></td><td></td><td><font size="2"><?php echo $tahun;?></font></td></tr>
<tr><td></td><td><font size="2">WARNA KB</font></td><td></td><td><font size="2"><?php echo $warna;?></font></td></tr>
<tr><td></td><td><font size="2">NO RANGKA / NIK</font></td><td></td><td><font size="2"><?php echo $noRangka;?></font></td></tr>
<tr><td></td><td><font size="2">NO MESIN</font></td><td></td><td><font size="2"><?php echo $noMesin;?></font></td></tr>

</table>

<br />
<table>
<tr><td colspan="3" align="right"><font size="2">BERLAKU SAMPAI</font></td><td width="20" ></td><td><font size="2"><?php echo $tanggalJatuhTempo;?></font></td><td width="150"></td><td align="center"><font size="1"><?php echo $ttd1; ?> <br /><?php echo $jabatan1; ?></font></td><td width="8"></td><td align="center"><font size="1"><?php echo $ttd2; ?><br /><?php echo $jabatan2; ?></font></td><td width="8"></td><td align="center"><font size="1"><?php echo $ttd3; ?><br /><?php echo $jabatan3; ?></font></td></tr>
</table>

	<script>
		window.print();
	</script>
</body>
</html>