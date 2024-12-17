  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow" style="background-color: #007bff !important;">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#" style="font-size: 12px;">SIMKES - Sistem Kesehatan Sekolah</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <span class="text-white-50 ms-3 w-100 fs-6 py-1"><?= $_SESSION['ssUserRM'] ?></span>
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        <a class="nav-link px-3" href="<?= $main_url ?>otentikasi/logout.php">Sign out</a>
      </div>
    </div>
  </header>