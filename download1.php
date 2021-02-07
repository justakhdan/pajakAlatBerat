<?php
// Tentukan folder file yang boleh di download
$folder = "C:/xampp/htdocs/PajakAlber/file/faktur/";

// Lalu cek menggunakan fungsi file_exist
if (!file_exists($folder.$_GET['dataFaktur'])) {
  echo "<h1>FILE TIDAK DITEMUKAN</h1>";
  exit;
}

// Apabila mendownload file di folder files
else {
  header("Content-Type: octet/stream");
  header("Content-Disposition: attachment; filename=".$_GET['dataFaktur']."");
  $fp = fopen($folder.$_GET['dataFaktur'], "r");
  $data = fread($fp, filesize($folder.$_GET['dataFaktur']));
  fclose($fp);
  print $data;
}
?>
