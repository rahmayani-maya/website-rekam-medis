<?php

session_start();

    if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../otentikasi/index.php");
    exit();
}

    require "../config.php";
    $title = "Tambah User - Rekam Medis";
    require "../template/navbar.php";
    require "../template/header.php";
    require "../template/sidebar.php";

    if ($dataUser['jabatan'] != 1) {
        echo "<script>
            alert('Halaman tidak ditemukan..');
            window.location = '../index.php'
        </script>";
        exit();
}
?>    

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">User Baru</h1>
            <a href="<?= $main_url ?>user" class="text-decoration-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
            </svg>Kembali</a>
        </div>

    <form action="proses-user.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-4 mb-4 text-center">
                <div class="px-4 mb-4">
                    <img src="<?= $main_url?>asset/gambar/default-user.png" alt="user"
                    class="img-thumbnail mb-3 rounded-circle tampil" width="120px">
                    <input type="file" class="form-control form-control-sm" name="gambar" onchange="imgView()" id="gambar">
                    <span class="text-sm">Type file gambar JPG | PNG | GIF</span><br>
                    <span class="text-sm">width = height</span>
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
            <div class="col-lg-8">
                <div class="form-group mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="masukkan username" autocomplete="off" autofocus required>
                </div>
                <div class="form-group mb-3">
                    <label for="fullname" class="form-label">Fullname</label>
                    <input type="text" name="fullname" class="form-control" id="fullname" placeholder="masukkan nama lengkap user" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="masukkan password" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password2" class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password2" class="form-control" id="password2" placeholder="masukkan kembali password" required>
                </div>
                <div class="form-group mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <select name="jabatan" id="jabatan" class="form-select" required>
                        <option value="">--Pilih Jabatan--</option>
                        <option value="1">Administrator</option>
                        <option value="2">Petugas</option>
                        <option value="3">Dokter</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" cols="" rows="3" id="alamat" placeholder="masukkan alamat" required></textarea>
                </div>
            </div>
        </div>
    </form>
    </main>

    <script>
        function imgView() {
            let gambar = document.getElementById('gambar');
            let tampil =document.querySelector('.tampil');

            let fileReader = new FileReader();
            fileReader.readAsDataURL(gambar.files[0]);

            fileReader.addEventListener('load', (e) => {
                tampil.src = e.target.result;
            })
        }
    </script>

<?php
require "../template/footer.php";
?>