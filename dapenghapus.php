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
		else{
			header("Location:./index.php");
			session_destroy();
			}
		}
		include("configDB.php");


$kodeAju = $_GET['kodeAju'];
$query = mysqli_query($conn, "update pengajuan set status='Tidak Disetujui' where kodeAju='$kodeAju'");

header("Location: dapeng.php");

?>