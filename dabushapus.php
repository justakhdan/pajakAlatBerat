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


$kodeInvent = $_GET['kodeInvent'];
$query = mysqli_query($conn, "delete from inventaris where kodeInvent ='$kodeInvent'");

header("location:dabus.php");

?>