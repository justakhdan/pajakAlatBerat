<?php
// Tentukan folder file yang boleh di download
$folder = "C:/xampp/htdocs/PajakAlber/file/foto/";

// Lalu cek menggunakan fungsi file_exist
if (!file_exists($folder.$_GET['dataGambar'])) {
  echo "<h1>Access forbidden!</h1>
      <p> Anda tidak diperbolehkan mendownload file ini.</p>";
  exit;
}

// Apabila mendownload file di folder files
else {
  header("Content-Type: octet/stream");
  header("Content-Disposition: attachment; filename=".$_GET['dataGambar']."");
  $fp = fopen($folder.$_GET['dataGambar'], "r");
  $data = fread($fp, filesize($folder.$_GET['dataGambar']));
  fclose($fp);
  print $data;
}
?>
