<?php

    session_start();

    if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../otentikasi/index.php");
    exit();
}

    require "../config.php";
    $title = "Tambah Data - Rekam Medis";
    require "../template/navbar.php";
    require "../template/header.php";
    require "../template/sidebar.php";

    // fungsi penomoran otomatis
    $today      = date('dmy');
    $queryNo    = mysqli_query($koneksi,"SELECT max(no_rm) as maxno FROM tbl_rekamedis WHERE right(no_rm, 6) = '$today'");
    $dataNo     = mysqli_fetch_assoc($queryNo);
    $noRM       = $dataNo['maxno'] ?: '';
    $noUrut     = $noRM ? (int) substr($noRM, 3, 3) : 0;
    $noUrut++;
    $noRM       = 'RM-' . sprintf("%03s", $noUrut) . '-' . date('dmy');

    if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
    } else {
        $msg = '';
    }

    $alert = "";
    if ($msg == 'added') {
        $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                    </svg>Tambah data rekam medis berhasil..</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
?>    

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Tambah Data Perekaman</h1>
            <a href="<?= $main_url ?>rekamedis" class="text-decoration-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                </svg>Kembali
            </a>
        </div>
    
    <form action="proses-data.php" method="post">
        <div class="row">
            <?php
            if ($msg !== '') {
                echo $alert;
            }
            ?>
            <div class="col-lg-6 pd-4">
                <div class="form-group mb-3">
                    <label for="no" class="form-label">No Rekam Medis</label>
                    <input type="text" class="form-control" name="no_rm" id="no_rm" value="<?= $noRM ?>" readonly>
                </div>
                <div class="form-group mb-3">
                    <label for="tgl" class="form-label">No Perekaman</label>
                    <input type="date" class="form-control" name="tgl" id="tgl" value="<?= date('Y-m-d') ?>">
                </div>
                <div class="form-group mb-3">
                    <label for="pasien" class="form-label">Pasien</label>
                        <div class="input-group mb-3">
                        <input type="text" class="form-control" id="pasien_id" name="id" placeholder="ID Pasien" readonly>
                        <button class="btn btn-outline-secondary" type="button" id="cari" data-bs-toggle="modal" data-bs-target="#modalPasien"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/></svg>
                        </button>
                        </div>
                    <input type="text" id="namaPasien" class="form-control border-0 border-bottom mb-3" placeholder="Nama Pasien" readonly>
                    <textarea name="" id="alamatPasien" class="form-control border-0 border-bottom" placeholder="Alamat Pasien" rows="1" readonly></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="keluhan" class="form-label">Keluhan</label>
                    <textarea name="keluhan" id="keluhan" class="form-control" placeholder="Keluhan Pasien..."></textarea>
                </div>
            </div>
            <div class="col-lg-6 border-start ps-4">
                <div class="form-group mb-3">
                    <label for="dokter" class="form-label">Dokter</label>
                    <select name="dokter" id="dokter" class="form-select">
                        <option value="">--Pilih Dokter</option>
                        <?php
                        $queryDokter = mysqli_query($koneksi,"SELECT * FROM tbl_user WHERE jabatan = 3");
                        while ($data = mysqli_fetch_assoc($queryDokter)) {?>
                        <option value="<?= $data['userid'] ?>"><?= $data['fullname'] ?></option>
                        <?php }
                        ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="diagnosa" class="form-label">Diagnosa</label>
                    <textarea name="diagnosa" id="diagnosa" class="form-control" placeholder="Hasil Diagnosa Dokter..." ></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="obat" class="form-label">Obat (pisahkan dengan koma) </label>
                    <input type="text" class="form-control" name="obat" id="tokenfield"/>
                </div>
                <button type="reset" class="btn btn-outline-danger btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                    </svg>Reset
                </button>
                <button type="submit" name="simpan" class="btn btn-outline-primary btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                    <path d="M11 2H9v3h2z"/>
                    <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/>
                    </svg>Simpan
                </button>
            </div>
        </div>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="modalPasien" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-body">
            <h3>Cari Pasien</h3>
            <table class="table table-responsive table-hover" id="myTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Pasien</th>
                        <th>Nama</th>
                        <th>Alamat</ht>
                        <th>Pilih</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        $queryPasien = mysqli_query($koneksi,"SELECT * FROM tbl_pasien");
                        while ($pasien = mysqli_fetch_assoc($queryPasien)) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $pasien['id'] ?></td>
                            <td><?= $pasien['nama'] ?></td>
                            <td><?= $pasien['alamat'] ?></td>
                            <td>
                                <button type="button" title="pilih pasien" id="cekPasien" data-id="<?= $pasien['id'] ?>" data-namapasien="<?= $pasien['nama'] ?>" data-address="<?= $pasien['alamat'] ?>" class="btn btn-sm btn-outline-primary cekPasien">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                    <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>
    </div>
    </main>

    <!-- TOKENFIELD JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>
    <script>
        $(document).ready(function(){
            $(document).on('click', '.cekPasien', function(){
                let pasienID = $(this).data('id');
                let pasienName = $(this).data('namapasien');
                let pasienAddress = $(this).data('address');
                $('#pasien_id').val(pasienID);
                $('#namaPasien').val(pasienName);
                $('#alamatPasien').val(pasienAddress);
                $('#modalPasien').modal('hide');
            })
            <?Php
                $queryObat = mysqli_query($koneksi, "SELECT * FROM tbl_obat");
                while ($data = mysqli_fetch_assoc($queryObat)) {
                    $nmObat[] = $data['nama'];
                }
            ?>
            $('#tokenfield').tokenfield({
            autocomplete: {
                source: [<?php echo '"' . implode('","', $nmObat) . '"' ?>],
                delay: 100
            },
            showAutocompleteOnFocus: true
            })
        })
    </script>

<?php
require "../template/footer.php";
?>