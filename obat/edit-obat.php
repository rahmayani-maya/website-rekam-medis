<?php

    session_start();

    if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../otentikasi/index.php");
    exit();
}

    require "../config.php";
    $title = "Edit obat - Rekam Medis";
    require "../template/navbar.php";
    require "../template/header.php";
    require "../template/sidebar.php";

    $id         = $_GET['id'];
    $queryObat  = mysqli_query($koneksi,"SELECT * FROM tbl_obat WHERE id = $id");
    $obat       = mysqli_fetch_assoc( $queryObat );
?>    

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Edit Obat</h1>
            <a href="<?= $main_url ?>obat" class="text-decoration-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                </svg>Kembali
            </a>
        </div>
        
        <form action="proses-obat.php" method="post">
            <div class="row">
                <div class="col-lg-8">
                    <input type="hidden" name="id" value="<?= $obat['id'] ?>">
                    <div class="form-group mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama Obat" value="<?= $obat['nama'] ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="kegunaan" class="form-label">Kegunaan</label>
                        <textarea name="kegunaan" id="kegunaan" cols="" rows="" class="form-control" placeholder="Kegunaan Obat" required><?= $obat['kegunaan'] ?>"</textarea>
                    </div>
                    <button type="submit" name="update" class="btn btn-outline-primary btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                        <path d="M11 2H9v3h2z"/>
                        <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/>
                        </svg>Update
                    </button>
                </div>
            </div>
        </form>
    </main>

<?php
require "../template/footer.php";
?>