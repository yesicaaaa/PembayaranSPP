<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="javascript:void(0)"><i class="fa fa-fw fa-user mr-2"></i>Management</a></li>
      <li class="breadcrumb-item active" aria-current="page">History Pembayaran</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-4 searchbar">
      <form action="<?= base_url('admin/history_pembayaran') ?>" method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Cari..." name="keyword" autocomplete="off" autofocus>
          <div class="input-group-append">
            <input class="btn btn-info" type="submit" name="submit">
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-3">
      <a href="<?= base_url(); ?>admin/refreshHP"><img class="refresh" src="<?= base_url(); ?>assets/img/refresh.png"></a>
    </div>
  </div>
  <h5 class="laporanbulan">Pencarian untuk <span>
      <?php if (!$this->session->keyword) : ?>
        semua siswa
      <?php else : ?>
        <?= $this->session->keyword ?>
      <?php endif; ?>
    </span></h5>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">NISN</th>
        <th scope="col">Nama Siswa</th>
        <th scope="col">Bulan</th>
        <th scope="col">Tahun</th>
        <th scope="col">Jumlah Bayar</th>
        <th scope="col">Nama Petugas</th>
        <th scope="col">Tanggal Bayar</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($history)) : ?>
        <tr>
          <td colspan="3">
            <div class="alert alert-danger" role="alert">
              Data not found!
            </div>
          </td>
        </tr>
      <?php endif; ?>
      <?php $i = 1; ?>
      <?php foreach ($history as $ht) : ?>
        <tr>
          <th scope="row"><?= $i++ ?></th>
          <td><?= $ht['nisn'] ?></td>
          <td><?= $ht['nama'] ?></td>
          <td><?= $ht['bulan_dibayar'] ?></td>
          <td><?= $ht['tahun_dibayar'] ?></td>
          <td><?= $ht['jumlah_bayar'] ?></td>
          <td><?= $ht['nama_petugas'] ?></td>
          <td><?= $ht['tgl_bayar'] ?></td>
          <td><?= $ht['status'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
</div>