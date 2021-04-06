<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="javascript:void(0)"><i class="fa fa-fw fa-user mr-2"></i>Management</a></li>
      <li class="breadcrumb-item active" aria-current="page">Laporan</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-4 searchbar">
      <form action="<?= base_url('admin/laporan') ?>" method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Cari Nama atau NISN Siswa..." name="keyword" autocomplete="off" autofocus>
          <div class="input-group-append">
            <input class="btn btn-info" type="submit" name="submit">
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-3">
      <a href="<?= base_url(); ?>admin/refreshLP"><img class="refreshLaporan" src="<?= base_url(); ?>assets/img/refresh.png"></a>
    </div>
  </div>
  <h5 class="laporanbulan">Pencarian untuk <span>
      <?php if (!$this->session->keyword) : ?>
        semua siswa
      <?php else :  ?>
        <?= $this->session->keyword; ?>
      <?php endif; ?>
    </span></h5>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">NISN</th>
        <th scope="col">Nama Siswa</th>
        <th scope="col">Bulan Dibayar</th>
        <th scope="col">Tahun Dibayar</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; ?>
      <?php foreach ($siswa as $s) : ?>
        <tr>
          <th scope="row"><?= $i++ ?></th>
          <td><?= $s['nisn'] ?></td>
          <td><?= $s['nama'] ?></td>
          <td><?= $s['bulan'] ?></td>
          <td><?= $s['tahun'] ?></td>
          <td><?= $s['status'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
</div>