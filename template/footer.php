</div>
</div>
    <script src="<?= $main_url ?>asset/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    
<?php
    $bln_ini = date('n');
    $thn_ini = date('Y');
    $list_data = [];

    for ($i=1; $i <= $bln_ini ; $i++) {
    $rm_yearly = mysqli_query($koneksi, "SELECT * FROM tbl_rekamedis WHERE tgl_rm BETWEEN '$thn_ini-$i-01' AND '$thn_ini-$i-31'");
    $list_data[] = mysqli_num_rows($rm_yearly);
}
?>

<script>
/* globals Chart:false, feather:false */
    let blnSkrg = <?= $bln_ini ?>;
    let nmBln = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    let listBln = [];
    for (let i = 0; i < blnSkrg; i++) {
      listBln.push(nmBln[i]);
}

  (function () {
    'use strict'
    feather.replace({ 'aria-hidden': 'true' })

    // Graphs
    var ctx = document.getElementById('myChart')
    // eslint-disable-next-line no-unused-vars
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels :listBln,
        datasets: [{
          data : <?= json_encode($list_data) ?>,
          lineTension: 0,
          backgroundColor: 'transparent',
          borderColor: '#007bff',
          borderWidth: 4,
          pointBackgroundColor: '#007bff'
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: false
            }
          }]
        },
        legend: {
          display: false
        }
      }
    })
  })()
</script>

      <script>
        let table = new DataTable('#myTable');
      </script>
    </body>
</html>
