<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="javascript:void(0)"><i class="fa fa-fw fa-tasks mr-2"></i>Laporan SPP</a></li>
    </ol>
  </nav>
  <div class="datasiswa">
    <h6>
      Nama : <span><?= $siswa['nama'] ?></span> &nbsp;
      NISN : <span><?= $siswa['nisn'] ?></span>
    </h6>
  </div>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Bulan Dibayar</th>
        <th scope="col">Tahun Dibayar</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; ?>
      <?php foreach ($laporanSiswa as $ls) : ?>
        <tr>
          <th scope="row"><?= $i++ ?></th>
          <td><?= $ls['bulan'] ?></td>
          <td><?= $ls['tahun'] ?></td>
          <td><?= $ls['status'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
</div>