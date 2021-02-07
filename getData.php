<?php 
$conn = mysqli_connect("localhost", "root", "", "pajakalatberat");
$result = mysqli_query($conn, "select * from alatberat");

$data = array();
while ($row = mysqli_fetch_assoc($result)){
	$data[] = $row;
	}
	
echo json_encode($data);	
?>