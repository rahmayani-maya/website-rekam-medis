<?php

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
  header("location: otentikasi/index.php");
  exit();
}

require "config.php";

$title = "Dashboard - Rekam Medis";

require "template/navbar.php";
require "template/header.php";
require "template/sidebar.php";

?>    

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Kunjungan Pasien</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            Tahun Ini
          </button>
        </div>
      </div>

      <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
    </main>

<?php
require "template/footer.php";
?>