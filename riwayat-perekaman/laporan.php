<?php

    session_start();

    if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../otentikasi/index.php");
    exit();
}

    require "../config.php";
    $title = "Laporan Rekam Medis - Rekam Medis";

    // somewhere early in your project's loading, require the Composer autoloader
    // see: http://getcomposer.org/doc/00-intro.md
    require "../../vendor/autoload.php";

    // reference the Dompdf namespace
    use Dompdf\Dompdf;

    // instantiate and use the dompdf class
    $dompdf = new Dompdf();

    $id = $_GET['id'];
    $queryPasien = mysqli_query($koneksi,"SELECT * FROM tbl_pasien");
    $pasien = mysqli_fetch_assoc($queryPasien);

    if ($pasien['gender'] == 'P') {
        $gender = 'Pria';
    } else {
        $gender = 'Wanita';
}

            $content = '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                <style>
                    .head{
                        text-align: center;
                        margin-bottom: 40px;
                        margin-top: -5px;
                    }
                    .label-head{
                        width: 120px;
                        padding-left: 1px;
                        padding-bottom: 5px;
                        text-align: left;
                    }
                    .data-left{
                        width: 300px;
                        padding-left: 1px;
                        padding-bottom: 5px;
                        text-align: left;
                    }
                    .data-right{
                        width: 130px;
                        padding-left: 1px;
                        padding-bottom: 5px;
                        text-align: left;
                    }
                    hr {
                        margin-bottom: 2px;
                        margin-left: -5px;
                        width: 700px;
                    }
                    .table-head{
                        text-align: left;
                    }
                    .data{
                        vertical-align: top;
                    }
                </style>
            </head>
            <body>
                <h2 class="head">Rekam Medis Pasien</h2>
                <table>
                    <tr>
                        <th class="label-head">Nama Pasien</th>
                        <td class="data-left">: '. $pasien['nama'] .'</td>
                        <th class="label-head">Jenis Kelamin</th>
                        <td class="data-right">: '. $gender .'</td>
                    </tr>
                    <tr>
                        <th class="label-head">Umur</th>
                        <td class="data-left">: '. htgUmur($pasien['tgl_lahir']) .'</td>
                        <th class="label-head">telpon</th>
                        <td class="data-right">: '. $pasien['telpon'] .'</td>
                    </tr>
                    <tr>
                        <th class="label-head">Alamat</th>
                        <td class="data-left" colspan="3">: '. $pasien['alamat'] .'</td>
                    </tr>
                </table>

                <table>
                    <thead>
                        <tr>
                            <th colspan="5">
                                <hr size="3">
                            </th>
                        </tr>
                        <tr>
                            <th class="table-head" style="width: 90px;">Tanggal</th>
                            <th class="table-head" style="width: 200px;">Keluhan</th>
                            <th class="table-head" style="width: 120px;">Diagnosa</th>
                            <th class="table-head" style="width: 200px;">Obat</th>
                            <th class="table-head" style="width: 70px;">Dokter</th>
                        </tr>
                        <tr>
                            <th colspan="5">
                                <hr size="3">
                            </th>
                        </tr>
                    </thead>
                    <tbody>';
                    $sqlrm = "SELECT * FROM tbl_rekamedis INNER JOIN tbl_user ON tbl_rekamedis.id_dokter = tbl_user.userid WHERE id_pasien = '$id'";
                    $queryrm = mysqli_query($koneksi,$sqlrm);
                    while ($rm = mysqli_fetch_assoc($queryrm)){
                        $content .=
                        '<tr>
                            <td class="data">'. in_date($rm['tgl_rm']) .'</td>
                            <td class="data">'. $rm['keluhan'].'</td>
                            <td class="data">'. $rm['diagnosa'].'</td>
                            <td class="data">'. $rm['obat'].'</td>
                            <td class="data">'. $rm['fullname'].'</td>
                        </tr>';
                    }
                    $content .=
                    '</tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5">
                                <hr size="3"> 
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </body>
            </html>';

$dompdf->loadHtml($content);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('Laporan Rekam Medis', array('Attachment' => false));

?>