<?php
session_start();
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


$kodeAB = $_GET['kodeAB'];
$query = mysqli_query($conn, "delete from alatberat where kodeAB ='$kodeAB'");

header("location:dab.php");

?>