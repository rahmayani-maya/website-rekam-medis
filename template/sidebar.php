  <div class="container-fluid">
    <div class="row">
      <?php
          $uri_path = parse_url( $_SERVER['REQUEST_URI'], 
          PHP_URL_PATH );

          $uri_segments = explode('/', $uri_path );
          $menu = $uri_segments[3];

          $userLogin = $_SESSION['ssUserRM'];
          $cekUser = mysqli_query( $koneksi,"SELECT * FROM tbl_user WHERE username = '$userLogin'");
          $dataUser = mysqli_fetch_assoc( $cekUser );
        ?>

    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 <?= $menu == 'index.php' ? 'active' : null ?>" aria-current="page" href="<?= $main_url ?>">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
              <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
              <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z"/>
              </svg><b>Dashboard</b>
              </a>
            </li>
              <?php
              if ( $dataUser['jabatan'] == 1) { ?>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 <?= $menu == 'user' ? 'active' : null ?>" aria-current="page" href="<?= $main_url ?>user">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                  <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                  <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
                </svg>&nbspUser
              </a>
            </li>
              <?php } ?>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 <?= $menu == 'otentikasi' ? 'active' : null ?>" href="<?= $main_url ?>otentikasi/password.php">
                <span data-feather="key"></span>Ganti Password
              </a>
            </li>
          </ul>
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Data</span>
              </h6>
          <ul class="nav flex-column mb-2">
              <?php if ($dataUser['jabatan'] != 3) { ?>
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 <?= $menu == 'pasien' ? 'active' : null ?>" href="<?= $main_url ?>pasien">
                  <span data-feather="user"></span>Pasien
                </a>
              </li>
              <?php } ?>
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 <?= $menu == 'obat' ? 'active' : null ?>" href="<?= $main_url ?>obat">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-capsule-pill" viewBox="0 0 16 16">
                  <path d="M11.02 5.364a3 3 0 0 0-4.242-4.243L1.121 6.778a3 3 0 1 0 4.243 4.243l5.657-5.657Zm-6.413-.657 2.878-2.879a2 2 0 1 1 2.829 2.829L7.435 7.536zM12 8a4 4 0 1 1 0 8 4 4 0 0 1 0-8m-.5 1.042a3 3 0 0 0 0 5.917zm1 5.917a3 3 0 0 0 0-5.917z"/>
                  </svg>&nbspObat
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 <?= $menu == 'rekamedis' ? 'active' : null ?>" href="<?= $main_url ?>rekamedis">
                  <span data-feather="activity"></span>Rekam Medis
                </a>
              </li>
          </ul>
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Laporan</span>
              </h6>
          <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 <?= $menu == 'riwayat-perekaman' ? 'active' : null ?>" href="<?= $main_url ?>riwayat-perekaman">
                  <span data-feather="file-text"></span>
                  Riwayat Perekaman
                </a>
              </li>
          </ul>
      </div>
    </nav>