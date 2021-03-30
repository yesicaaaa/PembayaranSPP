<!-- Navbar -->
<nav class="navbar sticky-top bg-nav">
  <a class="navbar-brand">SMK BPI Bandung</a>
  <span class="user-name petugas-name"><?= $this->session->nama; ?></span>
  <img class="img-circle img-petugas" src="<?= base_url() ?>assets/img/<?= $this->session->gambar; ?>">
</nav>
<!-- end navbar -->
<!-- sidebar -->
<div class="sidenav">
  <div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('siswa/index'); ?>"><i class="fa fa-fw fa-users"></i><span>Profile Saya</span></a></li>
    </ul>
    <div class="divider"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('siswa/history_pembayaran'); ?>"><i class="fa fa-fw fa-users"></i><span>History Pembayaran</span></a></li>
    </ul>
    <div class="divider"></div>
    <div class="divider div-end-siswa"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('main/signout_siswa') ?>"><i class="fa fa-fw fa-chevron-circle-left"></i><span>Signout</span></a></li>
    </ul>
    <div class="divider"></div>
  </div>
</div>
<!-- end sidebar -->