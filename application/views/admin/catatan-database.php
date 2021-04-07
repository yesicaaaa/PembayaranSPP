<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="javascript:void(0)"><i class="fa fa-fw fa-user mr-2"></i>Management</a></li>
      <li class="breadcrumb-item active" aria-current="page">Catatan Database</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-4 searchbar">
      <form action="<?= base_url('admin/catatan_database') ?>" method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Cari..." name="keyword" autocomplete="off" autofocus>
          <div class="input-group-append">
            <input class="btn btn-info" type="submit" name="submit">
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-3">
      <a href="<?= base_url(); ?>admin/refreshLog"><img class="refresh" src="<?= base_url(); ?>assets/img/refresh.png"></a>
    </div>
  </div>
  <h5 class="laporanbulan">Pencarian untuk <span>
  <?php if(!$this->session->keyword) : ?>
  semua catatan
  <?php else : ?>
  <?= $this->session->keyword; ?>
  <?php endif; ?>
  </span></h5>
  <table class="table">
    <thead>
      <tr class="headcatatan">
        <th scope="col">#</th>
        <th scope="col">Nama Petugas</th>
        <th scope="col">Email Baru</th>
        <th scope="col">Email Lama</th>
        <th scope="col">Telepon Baru</th>
        <th scope="col">Telepon Lama</th>
        <th scope="col">Posisi Baru</th>
        <th scope="col">Posisi Lama</th>
        <th scope="col">Tanggal Diubah</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1 ?>
      <?php foreach ($catatan as $ct) : ?>
        <tr class="bodycatatan">
          <th scope="row"><?= $i++ ?></th>
          <td><?= $ct['nama_petugas_lama'] ?></td>
          <td><?= $ct['email_baru'] ?></td>
          <td><?= $ct['email_lama'] ?></td>
          <td><?= $ct['no_telp_baru'] ?></td>
          <td><?= $ct['no_telp_lama'] ?></td>
          <td><?= $ct['posisi_baru'] ?></td>
          <td><?= $ct['posisi_lama'] ?></td>
          <td><?= $ct['tgl_diubah'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
</div>