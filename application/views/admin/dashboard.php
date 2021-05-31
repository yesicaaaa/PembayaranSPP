<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="javascript:void(0)"><i class="fa fa-fw fa-users mr-2"></i>Management</a></li>
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
  </nav>
  <canvas id="userChart"></canvas>
  <?php
  $id_kelas = null;
  $total = null;

  foreach ($result as $r) {
    $kelas = $r->id_kelas;
    $id_kelas .= "'$kelas'" . ", ";
    $tot = $r->total;
    $total .= "'$tot'" . ", ";
  }
  ?>
  <script>
    var ctx = $('#userChart').getContext('2d');
    var chart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [<?= $id_kelas; ?>],
        datasets: [{
          label: 'Data Kelas Siswa',
          backgroudColor: [
            'rgb(217, 107, 130)',
            'rgb(242, 102, 211)',
            'rgb(136, 55, 177)',
            'rgb(124, 86, 241)',
            'rgb(59, 152, 239)',
            'rgb(34, 215, 231)',
            'rgb(44, 231, 176)',
            'rgb(75, 235, 110)',
            'rgb(161, 227, 37)'
          ],
          borderColor: ['rgb(217, 107, 130)'],
          data: [<?= $jumlah ?>]
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero:true
            }
          }]
        }
      }
    })
  </script>
</div>