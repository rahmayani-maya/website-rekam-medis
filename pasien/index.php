<?php

    session_start();

    if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../otentikasi/index.php");
    exit();
}

    require "../config.php";
    $title = "Pasien - Rekam Medis";
    require "../template/navbar.php";
    require "../template/header.php";
    require "../template/sidebar.php";

    if ($dataUser['jabatan'] == 3) {
        echo "<script>
            alert('Halaman tidak ditemukan..');
            window.location = '../index.php';
        </script>";
        exit();
}
?>    

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Data Pasien</h1>
        </div>
        <a href="<?= $main_url ?>pasien/tambah-pasien.php" class="btn btn-outline-secondary btn-sm mb-3" title="tambah pasien baru">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
            </svg>Pasien Baru
        </a>

        <table class="table table-responsive table-hover" id="myTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Pasien</th>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
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
                    <td><?= in_date($pasien['tgl_lahir']) ?></td>
                    <td>
                        <?php
                            if ($pasien['gender'] == 'P') {
                                echo 'Pria';
                            } else {
                                echo 'Wanita';
                            }
                        ?>
                    </td>
                    <td><?= $pasien['telpon']?></td>
                    <td><?= $pasien['alamat']?></td>
                    <td>
                        <a href="edit-pasien.php?id=<?= $pasien['id'] ?>" class="btn btn-sm btn-outline-warning" title="edit pasien">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                            </svg>
                        </a>
                        <a href="proses-pasien.php?id=<?= $pasien['id'] ?>&aksi=hapus-pasien" onclick="return confirm ('anda yakin mau menghapus pasien ini ?')" class="btn btn-sm btn-outline-danger" title="hapus pasien">
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

<?php
require "../template/footer.php";
?>