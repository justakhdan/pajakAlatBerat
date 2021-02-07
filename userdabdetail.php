
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DATA ALAT BERAT - DETAIL ::: PAJAK ALAT BERAT - KOTA DUMAI</title>
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
		$kodeInvent = $_GET['kodeInvent'];
		$dataInvent = mysqli_query($conn, "select datauser.*, alatberat.*, merkalat.*, typealat.*, inventaris.*, pajakdasar.*, pajakinventaris.*, dendapajak.* from datauser, alatberat, merkalat, typealat, inventaris, pajakdasar, pajakinventaris, dendapajak where datauser.kodeAkses=inventaris.kodeAkses and merkalat.kodeMerk=typealat.kodeMerk and typealat.kodeType=alatberat.kodeType and alatberat.kodeAB=inventaris.kodeAB and pajakdasar.indexPajak=pajakinventaris.indexPajak and inventaris.kodeInvent=pajakinventaris.kodeInvent and dendapajak.indexDenda=pajakinventaris.indexDenda and inventaris.kodeInvent='$kodeInvent' ");
 if (!$dataInvent) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}

while($res = mysqli_fetch_array($dataInvent))
{
	$nama = $res['nama'];
	$alamat = $res['alamat'];
	$merk = $res['merk'];
	$type = $res['type'];
    $tahun = $res['tahun'];
	$noRangka = $res['noRangka'];
	$warna = $res['warna'];
	$noMesin = $res['noMesin'];
	$njkb = $res['njkb'];
	$nilaiKaliPajak= $res['nilaiKaliPajak'];
	$tanggalMasuk = $res['tanggalMasuk'];
	$keteranganPajak = $res['keteranganPajak'];
	$indexDenda = $res['indexDenda'];
	$tanggalJatuhTempo= date('d F Y', strtotime($res['tanggalJatuhTempo']));
	
	}
	$tanggalSekarang = date('d F Y');
	$selisih = (((strtotime($tanggalJatuhTempo)-strtotime($tanggalSekarang)))/(60*60*24));
	$nilaiPajak = (int)$njkb * (float)$nilaiKaliPajak;
	$query = mysqli_query($conn, "select max(noIndex) as noIndex from riwayatpajak where kodeInvent='$kodeInvent'");
	$arrayQuery = mysqli_fetch_array($query);
	$noIndex = $arrayQuery['noIndex'];
	$query1 = mysqli_query($conn, "select * from riwayatpajak where noIndex='$noIndex'");
	$arrayQuery1 = mysqli_fetch_array($query1);
	if ($arrayQuery1){
		$gettanggalJatuhTempo = strtoupper(date('Y', strtotime($arrayQuery1['tanggalJatuhTempo'])));
		$tanggalPembayaran = strtoupper(date('d F Y', strtotime($arrayQuery1['tanggalPembayaran'])));
		$jumlah = $arrayQuery1['jumlah'];
	}
	else{
		$gettanggalJatuhTempo="";
		$tanggalPembayaran="";
		$jumlah = "";
		}
	$queryDenda = mysqli_query($conn, "select * from dendapajak where indexDenda='1'");
	$rowDenda = mysqli_fetch_array($queryDenda);
	$kaliDenda = (float)$rowDenda['nilaiDenda'];
	if($selisih>=0){
	$updateDenda = (int)((int)$nilaiPajak * $kaliDenda * (0/12));
	$keterangan = "PEMBAYARAN TIDAK TELAT";	
		}
	else if($selisih>=-31){
	$updateDenda = (int)((int)$nilaiPajak * $kaliDenda * (1/12));
	$keterangan = "PEMBAYARAN TELAT 1 BULAN";	
	}
	else if($selisih>=-59 && $selisih<-31){
	$updateDenda = (int)((int)$nilaiPajak * $kaliDenda * (2/12));
	$keterangan = "PEMBAYARAN TELAT 2 BULAN";
	}
	else if($selisih>=-90 && $selisih<-59){
	$updateDenda = (int)((int)$nilaiPajak * $kaliDenda * (3/12));
	$keterangan = "PEMBAYARAN TELAT 3 BULAN";
	}
	else if($selisih>=-120 && $selisih<-90){
	$updateDenda = (int)((int)$nilaiPajak * $kaliDenda * (4/12));
	$keterangan = "PEMBAYARAN TELAT 4 BULAN";
	}
	else if($selisih>=-151 && $selisih<-120){
	$updateDenda = (int)((int)$nilaiPajak * $kaliDenda * (5/12));
	$keterangan = "PEMBAYARAN TELAT 5 BULAN";
	}
	else if($selisih>=-181 && $selisih<-151){
	$updateDenda = (int)((int)$nilaiPajak * $kaliDenda * (6/12));
	$keterangan = "PEMBAYARAN TELAT 6 BULAN";
	}
	else if($selisih>=-212 && $selisih<-181){
	$updateDenda = (int)((int)$nilaiPajak * $kaliDenda * (7/12));
	$keterangan = "PEMBAYARAN TELAT 7 BULAN";
	}
	else if($selisih>=-243 && $selisih<-212){
	$updateDenda = (int)((int)$nilaiPajak * $kaliDenda * (8/12));
	$keterangan = "PEMBAYARAN TELAT 8 BULAN";
	}
	else if($selisih>=-273 && $selisih<-243){
	$updateDenda = (int)((int)$nilaiPajak * $kaliDenda * (9/12));
	$keterangan = "PEMBAYARAN TELAT 9 BULAN";
	}
	else if($selisih>=-304 && $selisih<-273){
	$updateDenda = (int)((int)$nilaiPajak * $kaliDenda * (10/12));
	$keterangan = "PEMBAYARAN TELAT 10 BULAN";
	}
	else if($selisih>=-334 && $selisih<-304){
	$updateDenda = (int)((int)$nilaiPajak * $kaliDenda * (11/12));
	$keterangan = "PEMBAYARAN TELAT 11 BULAN";
	}
	else if($selisih<-335){
	$updateDenda = (int)((int)$nilaiPajak * $kaliDenda * (12/12));
	$keterangan = "PEMBAYARAN TELAT 1 TAHUN";
	}
	$denda = (int)$nilaiPajak + (int)$updateDenda;
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
        <li class="dataalat"><a class="active" href="#">Data Alat Berat</a></li>
        <li class="pengajuan"><a href="userpengajuan.php">Pengajuan Alat Berat</a></li>
        
       	</ul>
    </div>
    
  </header>
<br /><br />
 <table border="0" width="60%" class="info1">
  <tr>
  <td width="25%">Nama Perusahaan</td>
  <td width="1%">:</td>
  <td width="24%"><label> <b><?php echo $nama;?></label> </b></td>
  <td width="25%">Alamat</td>
  <td width="1%">:</td>
  <td width="24%"><label> <b><?php echo $alamat;?></label> </b></td>
  </tr>
  <tr><td colspan=6><br /><br /></td></tr>
  <tr>
  <td>Merk</td>
  <td>:</td>
  <td><label> <b><?php echo $merk;?></label> </b></td>
  <td>Type</td>
  <td>:</td>
  <td><label> <b><?php echo $type;?></label> </b></td>
  </tr><tr>
  <td>Tahun Pembuatan</td>
  <td>:</td>
  <td><label> <b><?php echo $tahun;?></label> </b></td>
  <td>Nilai Jual</td>
  <td>:</td>
  <td><label> <b><?php echo "Rp. " . number_format ($njkb,0,',','.');?></label> </b></td>
  </tr>
  <tr><td colspan=6<br /></td></tr>
  <tr>
  <td colspan=3 align="center"><label> Nilai Pajak : <b><?php echo "Rp. " . number_format ($nilaiPajak,0,',','.');?> </b></label></td><td colspan=3 align="center"><label>Keterangan Pajak : <b><?php echo $keteranganPajak;?> </b></label></td></tr>
  <tr><td colspan=6><br /><br /></td></tr><tr>
  <td>Nomor Rangka</td>
  <td>:</td>
  <td><label> <b><?php echo $noRangka;?> </b></label></td>
  <td>Nomor Mesin</td>
  <td>:</td>
  <td><label> <b><?php echo $noMesin;?> </b></label></td>
  </tr>
  <tr>
  <td colspan=6 align="center"><label>Warna : <b> <?php echo $warna;?> </b></label></td>
  </tr>
  </table>

  <table>
  <tr><td colspan=6><br /><br /></td></tr>
  <tr>
  <td colspan=6 align="center"><?php if(strtotime($tanggalJatuhTempo) > strtotime($tanggalSekarang)){?><label>Tanggal jatuh tempo : <b><?php echo $tanggalJatuhTempo;?></b> sebesar <b><?php echo "Rp. " . number_format ($nilaiPajak,0,',','.'); ?>   </b></label><br /><label class="huruf-hijau"> (TENGGAT PEMBAYARAN <b><?php echo round($selisih);?> HARI LAGI) </b> </label> <?php } else { ?> <label>Tanggal jatuh tempo : <b><?php echo $tanggalJatuhTempo;?></b> sebesar <b><?php echo "Rp. " . number_format ($denda,0,',','.'); ?>   </b></label> <br /><label class="huruf-merah"> (TENGGAT PEMBAYARAN SUDAH LEWAT <b><?php echo round(abs($selisih));?> HARI </b>)  </label> <?php }?></td>
  </tr>
  <tr><td colspan=6><br /></td></tr>
  <tr>
  <td colspan=6 align="center"><?php if(strtotime($tanggalPembayaran)<strtotime($tanggalMasuk)){} else{ ?>
  <label>Riwayat Pembayaran Terakhir : Pajak tahun <b><?php echo $gettanggalJatuhTempo;?></b> dibayarkan pada <b> <?php echo $tanggalPembayaran;?></b> sebesar <b> <?php echo "Rp. " . number_format ($jumlah,0,',','.');?></b> </label> <?php }; ?></td>
  </tr>
  </table>
  <br />
  <input type="button" name="batal" id="batal" value=" Kembali " onclick="window.location.href='userdab.php'"/>

</center>
</body>
</html>