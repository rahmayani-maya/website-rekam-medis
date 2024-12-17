<?php

    session_start();

    if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../otentikasi/index.php");
    exit();
}

    require "../config.php";

    if (isset($_POST['simpan'])) {
        $username   = trim(htmlspecialchars($_POST['username'])); 
        $nama       = trim(htmlspecialchars($_POST['fullname'])); 
        $jabatan    = $_POST['jabatan'];
        $alamat     = trim(htmlspecialchars($_POST['alamat']));
        $gambar     = htmlspecialchars($_FILES['gambar']['name']);
        $password   = trim(htmlspecialchars($_POST['password']));
        $password2  = trim(htmlspecialchars($_POST['password2']));

    $cekUsername = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username'");
    
    if (mysqli_num_rows($cekUsername)) {
        echo "<script>
            alert('username sudah terpakai, user baru gagal di registrasi !');
            window.location = 'tambah-user.php';
        </script>";
        return;
}

    if ($password !== $password2) {
        echo "<script>
                alert('konfirmasi password tidak sesuai, user baru gagal di registrasi !');
                window.location = 'tambah-user.php';
        </script>";
        return;
}

    $pass = password_hash($password, PASSWORD_DEFAULT);

    if ($gambar != null) {
        $url = 'tambah-user.php';
        $gambar = uploadGbr($url);
    } else {
        $gambar = 'user.png';
        }

    mysqli_query($koneksi, "INSERT INTO tbl_user VALUES (null, '$username', '$nama', '$pass', '$jabatan', '$alamat', '$gambar')");

    echo "<script>
            alert('User baru berhasil di registrasi !');
            window.location = 'tambah-user.php';
        </script>";
        return;
}

    if (@$_GET['aksi'] == 'hapus-user') {
    $id = $_GET['id'];
    $gbr = $_GET['gambar'];

    mysqli_query($koneksi, "DELETE FROM tbl_user WHERE userid = $id");
    if ($gbr != 'user.png') {
        unlink('../asset/gambar/' . $gbr);
    }

    echo "<script>
            alert('User berhasil dihapus !');
            window.location = 'index.php';
        </script>";
        return;

}

    if (isset($_POST['update'])) {
        $id         = $_POST['id'];
        $userLama   = trim(htmlspecialchars($_POST['usernameLama'])); 
        $username   = trim(htmlspecialchars($_POST['username'])); 
        $nama       = trim(htmlspecialchars($_POST['fullname'])); 
        $jabatan    = $_POST['jabatan'];
        $alamat     = trim(htmlspecialchars($_POST['alamat']));
        $gambar     = htmlspecialchars($_FILES['gambar']['name']);
        $gbrLama    = htmlspecialchars($_POST['gbrLama']);

    $cekUsername = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username'");

    if ($username !== $userLama) {
    if (mysqli_num_rows($cekUsername)) {
        echo "<script>
            alert('username sudah terpakai, user baru gagal di registrasi !');
            window.location = 'index.php';
        </script>";
        return;
    }
}

    if ($gambar != null) {
        $url = 'index.php';
        $gbrUser = uploadGbr($url);
        if ($gbrLama !== 'user.png') {
            @unlink('../asset/gambar/' . $gbrLama);
        }
    } else {
        $gbrUser = $gbrLama;
        }

    mysqli_query($koneksi, "UPDATE tbl_user SET 
    username        = '$username', 
    fullname        = '$nama', 
    jabatan         = '$jabatan', 
    alamat          = '$alamat', 
    gambar          = '$gbrUser'
    WHERE userid    = $id
    ");

    echo "<script>
            alert('Data user berhasil di perbarui !');
            window.location = 'index.php';
    </script>";
    return;
}

//ganti password
    if(isset($_POST['ganti-password'])) {
        $curPass = trim(htmlspecialchars($_POST['oldPass']));
        $newPass = trim(htmlspecialchars($_POST['newPass']));
        $confPass = trim(htmlspecialchars($_POST['confPass']));


        $userLogin = $_SESSION['ssUserRM'];
        $queryUser = mysqli_query($koneksi,"SELECT * FROM tbl_user WHERE username = '$userLogin'");
        $dataUser = mysqli_fetch_assoc($queryUser);

    if ($newPass !== $confPass){
        echo "<script>
            alert('password gagal diperbarui, konfirmasi password tidak sama..');
            window.location = '../otentikasi/password.php';
        </script>";
        return false;
}

    if (!password_verify($curPass, $dataUser['password'])) {
        echo "<script>
            alert('password gagal diperbarui, password lama tidak cocok..');
            window.location = '../otentikasi/password.php';
        </script>";
        return false;
    } else {
        $pass = password_hash($newPass, PASSWORD_DEFAULT);
        mysqli_query($koneksi, "UPDATE tbl_user SET password = '$pass' WHERE username = '$userLogin'");
        echo "<script>
            alert('password berhasil diubah..');
            window.location = '../otentikasi/password.php';
        </script>";
        return true;
    }
}

?>