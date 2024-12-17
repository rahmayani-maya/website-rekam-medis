<?php

    session_start();

    if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../otentikasi/index.php");
    exit();
}

    require "../config.php";
    $title = "Data - Rekam Medis";
    require "../template/navbar.php";
    require "../template/header.php";
    require "../template/sidebar.php";

    if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
    } else {
        $msg = '';
    }

    $alert = "";
    if ($msg == 'deleted') {
        $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                    </svg>Hapus data rekam medis berhasil..</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }

    if ($msg == 'updated') {
        $alert = '<div class="alert alert-success alert-dismissible fade show updated" role="alert">
                    <strong><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                    </svg>Edit data rekam medis berhasil..</strong>
                </div>';
    }
?>    

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Data Rekam Medis</h1>
        </div>
        <?php
            if ($msg !== '') {
                echo $alert;
            }
        ?>
        <a href="<?= $main_url ?>rekamedis/tambah-data.php" class="btn btn-outline-secondary btn-sm mb-3" title="tambah data">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
            </svg>Data Perekaman
        </a>

        <table class="table table-responsive table-hover" id="myTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Pasien</th>
                    <th>Alamat</th>
                    <th>Keluhan</th>
                    <th>Dokter</th>
                    <th>Diagnosa</th>
                    <th>Obat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $sqlrm = "SELECT *, tbl_pasien.alamat AS alamatpasien FROM tbl_rekamedis INNER JOIN tbl_pasien ON tbl_rekamedis.id_pasien = tbl_pasien.id INNER JOIN tbl_user ON tbl_rekamedis.id_dokter = tbl_user.userid order by tgl_rm desc";
                $queryrm = mysqli_query($koneksi,$sqlrm);
                while ($rm = mysqli_fetch_assoc($queryrm)) {
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= in_date($rm['tgl_rm']) ?></td>
                    <td><?= $rm['nama'] ?></td>
                    <td><?= $rm['alamatpasien'] ?></td>
                    <td><?= $rm['keluhan'] ?></td>
                    <td><?= $rm['fullname'] ?></td>
                    <td><?= $rm['diagnosa'] ?></td>
                    <td><?= $rm['obat'] ?></td>
                    <td>
                        <a href="edit-data.php?id=<?= $rm['no_rm'] ?>" class="btn btn-sm btn-outline-warning" title="edit data">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                            </svg>
                        </a>
                        <a href="proses-data.php?id=<?= $rm['no_rm'] ?>&aksi=hapus-data" onclick="return confirm ('anda yakin mau menghapus data ini ?')" class="btn btn-sm btn-outline-danger" title="hapus data">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
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