<?php

date_default_timezone_set('Asia/Jakarta');

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'db_rekamedis';

$koneksi = mysqli_connect($host, $user, $pass,$dbname);

// if (!$koneksi) {
// die('Koneksi gagal');
// }else {
// echo "Koneksi Berhasil";
// }

$main_url = "http://localhost/project/rekam_medis/";

function uploadGbr($url){
    $namafile   = $_FILES['gambar']['name'];
    $ukuran     = $_FILES['gambar']['size'];
    $tmp        = $_FILES['gambar']['tmp_name'];

    $ekstensiValid  = ['jpg', 'jpeg', 'png', 'gif'];
    $ekstensiFile   = explode('.',$namafile);
    $ekstensiFile   = strtolower(end($ekstensiFile));

    if (!in_array($ekstensiFile, $ekstensiValid)){
        echo "<script>
            alert(' input user gagal, file yang anda upload bukan gambar !');
            window.location = '$url';
        </script>";
        die();
}
    if ($ukuran > 1000000) {
        echo "<script>
                alert('input user gagal, maksimal ukuran gambar 1 MB !');
                window.location = '$url';
            </script>";
            die();
}
    $namafileBaru = time() .'.'. $namafile;
    move_uploaded_file($tmp, '../asset/gambar/' . $namafileBaru);
    return $namafileBaru;
}
    function in_date($tgl){
        $dd = substr($tgl, 8, 2);
        $mm = substr($tgl, 5, 2);
        $yy = substr($tgl, 0, 4);

        return $dd . "-" . $mm . "-" . $yy;
}
    function htgUmur($tgl_lahir){
        $tglLahir = new DateTime($tgl_lahir);
        $hariini = new DateTime("today");
        $umur = $hariini->diff($tglLahir)->y;
        return $umur . " tahun";
}