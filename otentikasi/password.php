<?php

    session_start();

    if (!isset($_SESSION['ssLoginRM'])) {
    header("location: index.php");
    exit();
}

    require "../config.php";
    $title = "Password - Rekam Medis";
    require "../template/navbar.php";
    require "../template/header.php";
    require "../template/sidebar.php";
?>    

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Ganti Password</h1>
        </div>
        <form action="../user/proses-user.php" method="post">
            <div class="form-group mb-3 col-6">
                <label for="oldPass" class="form-label">Password Lama</label>
                <input type="password" name="oldPass" class="form-control" id="oldPass" placeholder="Password Lama" autocomplete="off" required>
            </div>
            <div class="form-group mb-3 col-6">
                <label for="newPass" class="form-label">Password Baru</label>
                <input type="password" name="newPass" class="form-control" id="newPass" placeholder="Password Baru" autocomplete="off" required>
            </div>
            <div class="form-group mb-3 col-6">
                <label for="confPass" class="form-label">Konfirmasi Password</label>
                <input type="password" name="confPass" class="form-control" id="confPass" placeholder="Kondirmasi Password" autocomplete="off" required>
            </div>
            <button type="reset" class="btn btn-outline-danger btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                </svg>Reset
            </button>
            <button type="submit" name="ganti-password" class="btn btn-outline-primary btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                <path d="M11 2H9v3h2z"/>
                <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/>
                </svg>Simpan
            </button>
        </form>
    </main>

<?php
require "../template/footer.php";
?>