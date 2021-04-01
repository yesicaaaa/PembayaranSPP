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
          <div class="form-group">
            <select name="keyword" class="form-control">
              <option>Cari Per Bulan</option>
              <?php
              $bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
              $jml_bulan = count($bulan);
              for ($i = 0; $i < $jml_bulan; $i++) : ?>
                <option value="<?= $bulan[$i]; ?>"><?= $bulan[$i]; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <div class="input-group-append">
            <input class="btn btn-info btn-laporan" name="submit" type="submit">
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-3">
      <a href="<?= base_url(); ?>admin/refreshLP"><img class="refreshLaporan" src="<?= base_url(); ?>assets/img/refresh.png"></a>
    </div>
  </div>
  <h5 class="laporanbulan">Laporan untuk <span>
    <?php if(!$this->session->keyword) : ?>
      semua bulan
    <?php else :  ?>
      bulan <?= $this->session->keyword; ?>
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
        <th scope="col">Tanggal Bayar</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($laporan)) : ?>
        <tr>
          <td colspan="3">
            <div class="alert alert-danger" role="alert">
              Data not found!
            </div>
          </td>
        </tr>
      <?php endif; ?>
      <?php foreach ($laporan as $lp) : ?>
        <tr>
          <th scope="row"><?= ++$start ?></th>
          <td><?= $lp['nisn'] ?></td>
          <td><?= $lp['nama'] ?></td>
          <td><?= $lp['bulan_dibayar'] ?></td>
          <td><?= $lp['tahun_dibayar'] ?></td>
          <td><?= $lp['tgl_bayar'] ?></td>
          <td><?= $lp['status'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?= $this->pagination->create_links(); ?>
</div>
</div>