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


$kodeAkses = $_GET['kodeAkses'];
$query = mysqli_query($conn, "delete from datauser where kodeAkses ='$kodeAkses'");

header("location:daus.php");

?>