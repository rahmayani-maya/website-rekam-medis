<?php

  session_start();

  if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../otentikasi/index.php");
    exit();
}

  require "../config.php";

  //tambah obat baru
  if (isset($_POST['simpan'])) {
      $nama     = trim(htmlspecialchars($_POST['nama']));
      $kegunaan = trim(htmlspecialchars($_POST['kegunaan']));

      mysqli_query($koneksi, "INSERT INTO tbl_obat VALUES (null, '$nama', '$kegunaan')");
      header('location: tambah-obat.php?msg=added');
      return;
}


  //hapus obat
  if (@$_GET['aksi'] == 'hapus-obat') {
  $id = $_GET['id'];

  mysqli_query($koneksi,"DELETE FROM tbl_obat WHERE id = $id");
  header('location: index.php?msg=deleted');
  return;
}

  //update eobat
  if (isset($_POST['update'])) {
      $id       = trim(htmlspecialchars($_POST['id']));
      $nama     = trim(htmlspecialchars($_POST['nama']));
      $kegunaan = trim(htmlspecialchars($_POST['kegunaan']));

      mysqli_query($koneksi, "UPDATE tbl_obat SET nama = '$nama', kegunaan = '$kegunaan' WHERE id = $id");
      header('location: index.php?msg=updated');
      return;
  }
?>
