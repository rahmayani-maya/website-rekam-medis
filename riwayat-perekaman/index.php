<?php

    session_start();

    if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../otentikasi/index.php");
    exit();
}

    require "../config.php";
    $title = "Riwayat Perekaman - Rekam Medis";
    require "../template/navbar.php";
    require "../template/header.php";
    require "../template/sidebar.php";    
?>    

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Laporan Rekam Medis Pasien</h1>
        </div>

    <table class="table table-responsive table-hover" id="myTable">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Pasien</th>
                <th>Nama</th>
                <th>Umur</th>
                <th>Jenis Kelamin</th>
                <th>Telpon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $queryPasien = mysqli_query($koneksi,"SELECT * FROM tbl_pasien");
            while ($pasien = mysqli_fetch_assoc($queryPasien)) {
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $pasien['id'] ?></td>
                <td><?= $pasien['nama'] ?></td>
                <td><?= htgUmur($pasien['tgl_lahir']) ?></td>
                <td>
                    <?php
                        if ($pasien['gender'] == 'P') {
                            echo 'Pria';
                        } else {
                            echo 'Wanita';
                        }
                    ?>
                </td>
                <td><?= $pasien['telpon'] ?></td>
                <td><?= $pasien['alamat'] ?></td>
                <td class="col-1">
                    <a href="laporan.php?id=<?= $pasien['id'] ?>" class="btn btn-sm btn-outline-primary" title="cetak pdf" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                    <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                    <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
                    </svg>
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </main>

    <script>
        window.setTimeout(function(){
            $('.updated').fadeOut();
        }, 5000)
    </script>

<?php
require "../template/footer.php";
?>