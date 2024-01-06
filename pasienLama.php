<?php
if (!isset($_SESSION)) {
  session_start();
}

$showTable = false;
$searchResults = [];

if (isset($_POST['cari'])) {
  $no_ktp = $_POST['searchTerm']; // Update the array key here
  // Check if the No KTP already exists
  $checkNoKTP = mysqli_query($mysqli, "SELECT * FROM pasien WHERE no_ktp = '$no_ktp'");
  if (mysqli_num_rows($checkNoKTP) > 0) {
      $showTable = true;
      // Fetch the rows that match the entered No KTP
      $searchResults = mysqli_query($mysqli, "SELECT * FROM pasien WHERE no_ktp = '$no_ktp'");
  } else {
      // No KTP doesn't exist, show an alert
      echo "<script>alert('No KTP Belum terdaftar. Pasien dengan No KTP tersebut tidak dapat mendaftar Poliklinik.');</script>";
  }
}
?>
