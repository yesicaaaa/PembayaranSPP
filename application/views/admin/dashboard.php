<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="javascript:void(0)"><i class="fa fa-fw fa-users mr-2"></i>Management</a></li>
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-3">
      <canvas id="kelasChart" width="350" height="200"></canvas>
    </div>
    <div class="col-md-3" style="margin-left: 80px;">
      <canvas id="petugasChart" width="350" height="200"></canvas>
    </div>
    <div class="col-md-3" style="margin-left: 90px;">
      <canvas id="sppChart" width="350" height="200"></canvas>
    </div>
  </div>
  <canvas id="pembayaranChart" width="1000" height="200" style="margin-top: 20px;"></canvas>
  <?php
  //kelas chart
  $komp = null;
  $total = null;

  foreach ($kelas_result as $kr) {
    $kelas = $kr['kompetensi_keahlian'];
    $komp .= "'$kelas'" . ", ";
    $tot = $kr['total'];
    $total .= "'$tot'" . ", ";
  }

  //petugas chart
  $level = null;
  $total_pet = null;
  foreach ($petugas_result as $pr) {
    $lev = $pr['level'];
    $level .= "'$lev'" . ", ";
    $tot_pet = $pr['total'];
    $total_pet .= "'$tot_pet'" . ", ";
  }

  //spp chart
  $nominal = null;
  $total_spp = null;
  foreach ($spp_result as $sr) {
    $nom = $sr['nominal'];
    $nominal .= "'$nom'" . ", ";
    $tot_spp = $sr['total'];
    $total_spp .= "'$tot_spp'" . ", ";
  }

  //pembayaran chart
  $tahun_dibayar = null;
  $total_pem = null;
  foreach ($pembayaran_result as $pem) {
    $tahun = $pem['tahun_dibayar'];
    $tahun_dibayar .= "'$tahun'" . ", ";
    $tot_pem = $pem['total'];
    $total_pem .= "'$tot_pem'" . ", ";
  }
  ?>
  <script>
    //chart kelas
    var ctx_kelas = document.getElementById('kelasChart').getContext('2d');
    var chart_kelas = new Chart(ctx_kelas, {
      type: 'line',
      data: {
        labels: [<?= $komp; ?>],
        datasets: [{
          label: 'Jumlah Siswa per Jurusan',
          borderColor: "RGB(0, 117, 127)",
          data: [<?= $total ?>]
        }]
      },
      options: {
        responsive: false,
        maintainAspectRatio: false
      }
    });

    //chart petugas
    var ctx_petugas = document.getElementById('petugasChart').getContext('2d');
    var chart_petugas = new Chart(ctx_petugas, {
      type: 'line',
      data: {
        labels: [<?= $level ?>],
        datasets: [{
          label: 'Jumlah Petugas Berdasar Level',
          borderColor: 'RGB(245, 210, 83)',
          data: [<?= $total_pet ?>]
        }]
      },
      options: {
        responsive: false,
        maintainAspectRatio: false
      }
    });

    //chart spp
    var ctx_spp = document.getElementById('sppChart').getContext('2d');
    var chart_spp = new Chart(ctx_spp, {
      type: 'line',
      data: {
        labels: [<?= $nominal ?>],
        datasets: [{
          label: 'Data SPP Yang Dipakai',
          borderColor: 'RGB(40, 39, 70)',
          data: [<?= $total_spp ?>]
        }]
      },
      options: {
        responsive: false,
        maintainAspectRatio: false
      }
    });

    //chart pembayaran
    var ctx_pem = document.getElementById('pembayaranChart').getContext('2d');
    var chart_pembayaran = new Chart(ctx_pem, {
      type: 'line',
      data: {
        labels: [<?= $tahun_dibayar ?>],
        datasets: [{
          label: 'Data Pembayaran SPP per Tahun',
          borderColor: 'RGB(35, 146, 225)',
          data: [<?= $total_pem ?>]
        }]
      },
      options: {
        responsive: false,
        maintainAspectRatio: false
      }
    })
  </script>
</div>